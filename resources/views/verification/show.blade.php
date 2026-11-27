<?php
/**
 * resources/views/verification/show.blade.php
 * Public transcript verification page – no auth required.
 */
?>
@extends('layouts.admin')

@section('title', 'Transcript Verification')

@section('content')
<div class="container-fluid">
    @if($transcript)
        @if($isValid)
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                VALID TRANSCRIPT</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $transcript->document_id }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-6">
                    <h5>Student Details</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Registration No:</strong> {{ $transcript->student->registration_no ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Index No:</strong> {{ $transcript->student->index_no ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Name:</strong> {{ $transcript->student->full_name ?? 'N/A' }}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5>Transcript Details</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Degree:</strong> {{ $transcript->degree_name ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>GPA:</strong> {{ $transcript->fgpa ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Class:</strong> {{ $transcript->class_name ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Issued At:</strong> {{ $transcript->issued_at ? $transcript->issued_at->format('Y-m-d') : 'N/A' }}</li>
                    </ul>
                </div>
            </div>
        @else
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">TRANSCRIPT REVOKED</h4>
                <p>This transcript exists but has a status of <strong>{{ $transcript->status }}</strong>.</p>
                @if(!empty($transcript->status_reason))
                    <hr>
                    <p class="mb-0"><strong>Reason:</strong> {{ $transcript->status_reason }}</p>
                @endif
            </div>
        @endif
    @else
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">TRANSCRIPT NOT FOUND</h4>
            <p>No transcript record matches the identifier you provided.</p>
        </div>
    @endif
</div>
@endsection
