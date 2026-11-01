@extends('layouts.admin')

@section('title')
Transcript Details
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('transcripts.index') }}">Transcripts</a></li>
<li class="breadcrumb-item">View</li>
@endsection

@section('controlButtons')
<a href="{{ route('transcripts.edit', $transcript->id) }}" class="btn btn-warning btn-icon-split mr-1">
    <span class="icon"><i class="fas fa-edit"></i></span>
    <span class="text">Edit</span>
</a>
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
                            {{ $transcript->student->name_with_initials ?? ($transcript->student->first_name . ' ' . $transcript->student->last_name) }}
                            ({{ $transcript->student->registration_no ?? '—' }})
                        @else —
                        @endif
                    </td></tr>
                    <tr><th>Degree</th><td>{{ $transcript->degree_name ?? '—' }}</td></tr>
                    <tr><th>FGPA</th><td>{{ $transcript->fgpa ?? '—' }}</td></tr>
                    <tr><th>Class</th><td>{{ $transcript->class_name ?? '—' }}</td></tr>
                    <tr><th>Effective Date</th><td>{{ $transcript->effective_date ? $transcript->effective_date->format('Y-m-d') : '—' }}</td></tr>
                    <tr><th>Status</th><td>
                        @if($transcript->status === 'active')
                            <span class="badge badge-success">Active</span>
                        @elseif($transcript->status === 'revoked')
                            <span class="badge badge-danger">Revoked</span>
                        @else
                            <span class="badge badge-secondary">{{ ucfirst($transcript->status) }}</span>
                        @endif
                    </td></tr>
                    <tr><th>Status Reason</th><td>{{ $transcript->status_reason ?? '—' }}</td></tr>
                    <tr><th>Issued At</th><td>{{ $transcript->issued_at ? $transcript->issued_at->format('Y-m-d H:i') : '—' }}</td></tr>
                    <tr><th>Created At</th><td>{{ $transcript->created_at->format('Y-m-d H:i') }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

@if($transcript->tokens->count())
<div class="card mb-3">
    <div class="card-body">
        <h5 class="text-secondary"><i data-feather="key" class="mr-1 pb-1"></i> Verification Tokens</h5>
        <table class="table table-bordered table-sm">
            <thead><tr><th>Token</th><th>Status</th><th>Expires At</th></tr></thead>
            <tbody>
                @foreach($transcript->tokens as $token)
                <tr>
                    <td><code>{{ $token->token }}</code></td>
                    <td>{{ $token->status ?? '—' }}</td>
                    <td>{{ $token->expires_at ?? '—' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@if($transcript->auditLogs->count())
<div class="card mb-3">
    <div class="card-body">
        <h5 class="text-secondary"><i data-feather="activity" class="mr-1 pb-1"></i> Audit Logs</h5>
        <table class="table table-bordered table-sm">
            <thead><tr><th>Action</th><th>IP Address</th><th>Date</th></tr></thead>
            <tbody>
                @foreach($transcript->auditLogs as $log)
                <tr>
                    <td>{{ $log->action ?? '—' }}</td>
                    <td>{{ $log->ip_address ?? '—' }}</td>
                    <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
