<?php

namespace App\Http\Controllers;

use App\Transcript;
use App\VerificationAuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Barryvdh\DomPDF\Facade\Pdf;

class VerificationController extends Controller
{
    /**
     * Show the public verification landing page with a search form.
     * No authentication required.
     */
    public function index()
    {
        return view('verification.index');
    }

    /**
     * Handle the form submission: look up a document ID and show the result.
     * Also used directly by QR code links (GET with documentId in URL).
     *
     * @param string|null $documentId
     * @param \Illuminate\Http\Request $request
     */
    public function show(Request $request, $documentId = null)
    {
        if (!$documentId) {
            // Form POST — validate both fields
            $request->validate([
                'document_id' => 'required|string|max:100',
                'index_no'    => 'required|string|max:50',
            ]);
            $documentId = trim($request->input('document_id'));
            $indexNo    = trim($request->input('index_no'));
            $method     = $request->input('verification_method') === 'qr_code' ? 'qr_code' : 'manual';
        } else {
            // QR code direct link — index_no comes as query string (?index_no=...)
            $indexNo = trim($request->query('index_no', ''));
            $method  = 'qr_code';
        }

        // Look up transcript — must match BOTH document_id AND student's index_no
        $transcript = Transcript::where('document_id', $documentId)
                                 ->with('student')
                                 ->first();

        // Both fields must match the same record
        $indexMatches = $transcript
            && $transcript->student
            && strtoupper(str_replace(' ', '', $transcript->student->index_no))
               === strtoupper(str_replace(' ', '', $indexNo));

        $isValid = (bool) ($transcript && $indexMatches);

        // Determine failure reason for the audit log
        if (!$transcript) {
            $failureReason = 'not_found';
        } elseif (!$indexMatches) {
            $failureReason = 'index_no_mismatch';
        } else {
            $failureReason = null;
        }

        // Log the verification attempt
        VerificationAuditLog::create([
            'transcript_id'            => $transcript ? $transcript->id : null,
            'document_id_searched'     => $documentId,
            'registration_no_searched' => $transcript ? optional($transcript->student)->registration_no : null,
            'verification_method'      => $method,
            'is_valid'                 => $isValid,
            'failure_reason'           => $failureReason,
            'ip_address'               => $request->ip(),
            'user_agent'               => $request->header('User-Agent'),
        ]);

        // If index_no doesn't match, treat it as "not found" to avoid leaking info
        $resultTranscript = ($transcript && $indexMatches) ? $transcript : null;

        $applicationFormUrl = null;
        if ($isValid) {
            $applicationFormUrl = URL::temporarySignedRoute(
                'verification.application-form',
                now()->addMinutes(10),
                ['transcript' => $transcript->id]
            );
        }

        return view('verification.result', [
            'transcript' => $resultTranscript,
            'isValid'    => $isValid,
            'documentId' => $documentId,
            'applicationFormUrl' => $applicationFormUrl,
        ]);
    }

    public function downloadApplicationForm(Transcript $transcript)
    {
        $transcript->load('student');

        return Pdf::loadView('verification.pdf.application-form', [
            'transcript' => $transcript,
            'student' => $transcript->student,
        ])->setPaper('a4', 'portrait')->download(
            'transcript-verification-application-' . $transcript->id . '.pdf'
        );
    }
}
