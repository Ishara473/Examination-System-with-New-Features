<?php

namespace App\Http\Controllers;

use App\Transcript;
use Illuminate\Http\Request;

class TranscriptController extends Controller
{
    public function index()
    {
        $transcripts = Transcript::with(['student', 'tokens'])->paginate(15);
        return view('transcripts.index', compact('transcripts'));
    }

    public function show($id)
    {
        $transcript = Transcript::with(['student', 'tokens', 'auditLogs'])->findOrFail($id);
        return view('transcripts.show', compact('transcript'));
    }

    public function edit($id)
    {
        $transcript = Transcript::findOrFail($id);
        return view('transcripts.edit', compact('transcript'));
    }

    public function update(Request $request, $id)
    {
        $transcript = Transcript::findOrFail($id);

        $validated = $request->validate([
            'document_id' => 'required|string|max:50|unique:transcripts,document_id,' . $id,
            'student_id'  => 'required|integer',
            'degree_name' => 'nullable|string|max:255',
            'fgpa'        => 'nullable|numeric|min:0|max:4',
            'class_name'  => 'nullable|string|max:100',
            'effective_date' => 'nullable|date',
            'status'      => 'required|in:active,revoked,superseded',
            'status_reason' => 'nullable|string',
            'issued_at'   => 'nullable|date',
        ]);

        $transcript->update($validated);
        return redirect()->route('transcripts.show', $transcript->id)
                         ->with('success', 'Transcript updated successfully.');
    }

    public function destroy($id)
    {
        $transcript = Transcript::findOrFail($id);
        $transcript->delete();
        return redirect()->route('transcripts.index')
                         ->with('success', 'Transcript removed.');
    }
}
