<?php

namespace App\Http\Controllers;

use App\Transcript;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TranscriptController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    private function authorizeAccess(): void
    {
        $user = Auth::guard('users')->user();
        abort_unless(
            $user && ($user->hasRole('Admin') || $user->hasPermissionTo('transcript:print')),
            403,
            'Unauthorized action.'
        );
    }

    public function index(Request $request)
    {
        $this->authorizeAccess();

        $allowedSorts = [
            'id'          => 'transcripts.id',
            'document_id' => 'transcripts.document_id',
            'degree_name' => 'transcripts.degree_name',
            'fgpa'        => 'transcripts.fgpa',
            'class_name'  => 'transcripts.class_name',
            'issued_at'   => 'transcripts.issued_at',
        ];

        $sort = $request->input('sort', 'id');
        if (!array_key_exists($sort, $allowedSorts)) {
            $sort = 'id';
        }

        $direction = strtolower($request->input('direction', 'desc')) === 'asc' ? 'asc' : 'desc';

        $transcripts = Transcript::with('student')
            ->orderBy($allowedSorts[$sort], $direction)
            ->paginate(15)
            ->withQueryString();

        return view('transcripts.index', compact('transcripts', 'sort', 'direction'));
    }

    public function show($id)
    {
        $this->authorizeAccess();

        $transcript = Transcript::with('student')->findOrFail($id);
        return view('transcripts.show', compact('transcript'));
    }
}
