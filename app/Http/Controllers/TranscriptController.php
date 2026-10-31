<?php

namespace App\Http\Controllers;

use App\Transcript;
use App\TranscriptToken;
use App\VerificationAuditLog;
use Illuminate\Http\Request;

class TranscriptController extends Controller
{
    // Display a listing of transcripts
    public function index()
    {
        $transcripts = Transcript::with(['tokens', 'auditLogs'])->paginate(15);
        return view('transcripts.index', compact('transcripts'));
    }

    // Show the form for creating a new transcript
    public function create()
    {
        return view('transcripts.create');
    }

    // Store a newly created transcript
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:transcripts,email',
        ]);

        $transcript = Transcript::create($validated);
        return redirect()->route('transcripts.show', $transcript->id)
                         ->with('success', 'Transcript created.');
    }

    // Display a specific transcript
    public function show($id)
    {
        $transcript = Transcript::with(['tokens', 'auditLogs'])->findOrFail($id);
        return view('transcripts.show', compact('transcript'));
    }

    // Show the form for editing a transcript
    public function edit($id)
    {
        $transcript = Transcript::findOrFail($id);
        return view('transcripts.edit', compact('transcript'));
    }

    // Update the transcript
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name'  => 'sometimes|required|string|max:255',
            'email'      => 'sometimes|required|email|unique:transcripts,email,' . $id,
        ]);

        $transcript = Transcript::findOrFail($id);
        $transcript->update($validated);

        return redirect()->route('transcripts.show', $transcript->id)
                         ->with('success', 'Transcript updated.');
    }

    // Delete a transcript
    public function destroy($id)
    {
        $transcript = Transcript::findOrFail($id);
        $transcript->delete();

        return redirect()->route('transcripts.index')
                         ->with('info', 'Transcript removed.');
    }
}
?>
