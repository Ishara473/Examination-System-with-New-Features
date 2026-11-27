@extends('layouts.admin')

@section('title')
Transcript Details
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('transcripts.index') }}">Transcripts</a></li>
<li class="breadcrumb-item">View</li>
@endsection

@section('controlButtons')
<a href="{{ route('transcripts.index') }}" class="btn btn-secondary btn-icon-split">
    <span class="icon"><i class="fas fa-arrow-left"></i></span>
    <span class="text">Back</span>
</a>
@endsection

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <h4 class="text-secondary mb-3 mt-1"><i data-feather="file-text" class="mr-1 pb-1"></i> Transcript Details</h4>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr><th width="35%">Document ID</th><td><code>{{ $transcript->document_id }}</code></td></tr>
                    <tr><th>Student</th><td>
                        @if($transcript->student)
                            {{ $transcript->student->full_name ?? $transcript->student->name_with_initials ?? ($transcript->student->first_name . ' ' . $transcript->student->last_name) }}
                            ({{ $transcript->student->registration_no ?? '—' }})
                        @else —
                        @endif
                    </td></tr>
                    <tr><th>Index No</th><td>{{ $transcript->student->index_no ?? '—' }}</td></tr>
                    <tr><th>Degree</th><td>{{ $transcript->degree_name ?? '—' }}</td></tr>
                    <tr><th>FGPA</th><td>{{ $transcript->fgpa ?? '—' }}</td></tr>
                    <tr><th>Class</th><td>{{ $transcript->class_name ?? '—' }}</td></tr>
                    <tr><th>Effective Date</th><td>{{ $transcript->effective_date ? $transcript->effective_date->format('Y-m-d') : '—' }}</td></tr>
                    <tr><th>Status</th><td><span class="badge badge-success">Active</span></td></tr>
                    <tr><th>Issued At</th><td>{{ $transcript->issued_at ? $transcript->issued_at->format('Y-m-d H:i') : '—' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
