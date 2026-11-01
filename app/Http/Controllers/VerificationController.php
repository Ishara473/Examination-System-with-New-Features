<?php

namespace App\Http\Controllers;

use App\Transcript;
use App\VerificationAuditLog;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /**
     * Display a public verification page for a transcript.
     *
     * @param string $documentId
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function show($documentId, Request $request)
    {
        // Find the transcript by its unique document ID (e.g., RUSL/FOA/2023/TR/15)
        $transcript = Transcript::where('document_id', $documentId)
                                 ->with('student')
                                 ->first();

        // Determine validity – a transcript is considered valid only when it exists and its status is "active"
        $isValid = $transcript && $transcript->status === 'active';

        // Record the verification attempt for audit purposes
        VerificationAuditLog::create([
            'document_id_searched' => $documentId,
            'registration_no_searched' => $transcript ? $transcript->student->registration_no : null,
            'verification_method' => 'public_url',
            'is_valid' => $isValid,
            'failure_reason' => $isValid ? null : ($transcript ? 'revoked' : 'not_found'),
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
        ]);

        return view('verification.show', compact('transcript', 'isValid'));
    }
}
