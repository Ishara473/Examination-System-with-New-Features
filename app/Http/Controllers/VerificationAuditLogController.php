<?php

namespace App\Http\Controllers;

use App\VerificationAuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationAuditLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    public function index(Request $request)
    {
        $user = Auth::guard('users')->user();

        abort_unless(
            $user->hasRole('Admin') || $user->hasPermissionTo('transcript:print'),
            403
        );

        $query = VerificationAuditLog::with('transcript.student')->latest();

        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($searchQuery) use ($search) {
                $searchQuery->where('document_id_searched', 'like', '%' . $search . '%')
                    ->orWhere('registration_no_searched', 'like', '%' . $search . '%')
                    ->orWhere('ip_address', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('method') && in_array($request->input('method'), ['qr_code', 'manual'], true)) {
            $query->where('verification_method', $request->input('method'));
        }

        if ($request->filled('result') && in_array($request->input('result'), ['valid', 'invalid'], true)) {
            $query->where('is_valid', $request->input('result') === 'valid');
        }

        if ($request->filled('failure_reason')) {
            $query->where('failure_reason', $request->input('failure_reason'));
        }

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->input('from'));
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->input('to'));
        }

        $logs = $query->paginate(25)->withQueryString();

        $summaryQuery = VerificationAuditLog::query();
        $this->applyDateFilters($summaryQuery, $request);

        $summary = [
            'total' => (clone $summaryQuery)->count(),
            'valid' => (clone $summaryQuery)->where('is_valid', true)->count(),
            'invalid' => (clone $summaryQuery)->where('is_valid', false)->count(),
            'qr_code' => (clone $summaryQuery)->where('verification_method', 'qr_code')->count(),
            'manual' => (clone $summaryQuery)->where('verification_method', 'manual')->count(),
        ];

        $failureReasons = VerificationAuditLog::query()
            ->whereNotNull('failure_reason')
            ->distinct()
            ->orderBy('failure_reason')
            ->pluck('failure_reason');

        return view('verification-audit-logs.index', compact('logs', 'summary', 'failureReasons'));
    }

    private function applyDateFilters($query, Request $request): void
    {
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->input('from'));
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->input('to'));
        }
    }
}
