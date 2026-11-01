@extends('layouts.admin')

@section('title')
Issue New Transcript
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('transcripts.index') }}">Transcripts</a></li>
<li class="breadcrumb-item">Issue New</li>
@endsection

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <h4 class="text-secondary mb-3 mt-1"><i data-feather="plus-circle" class="mr-1 pb-1"></i> Issue New Transcript</h4>
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif
        <form action="{{ route('transcripts.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="document_id">Document ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="document_id" name="document_id" value="{{ old('document_id') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="student_id">Student ID <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="student_id" name="student_id" value="{{ old('student_id') }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="degree_name">Degree Name</label>
                        <input type="text" class="form-control" id="degree_name" name="degree_name" value="{{ old('degree_name') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="fgpa">Final GPA</label>
                        <input type="number" step="0.01" class="form-control" id="fgpa" name="fgpa" value="{{ old('fgpa') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="class_name">Class</label>
                        <input type="text" class="form-control" id="class_name" name="class_name" value="{{ old('class_name') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="effective_date">Effective Date</label>
                        <input type="date" class="form-control" id="effective_date" name="effective_date" value="{{ old('effective_date') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="active" {{ old('status')=='active'?'selected':'' }}>Active</option>
                            <option value="revoked" {{ old('status')=='revoked'?'selected':'' }}>Revoked</option>
                            <option value="superseded" {{ old('status')=='superseded'?'selected':'' }}>Superseded</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="issued_at">Issued At</label>
                        <input type="datetime-local" class="form-control" id="issued_at" name="issued_at" value="{{ old('issued_at') }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="status_reason">Status Reason</label>
                <textarea class="form-control" id="status_reason" name="status_reason" rows="2">{{ old('status_reason') }}</textarea>
            </div>
            <a href="{{ route('transcripts.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-success btn-icon-split">
                <span class="icon"><i class="fas fa-save"></i></span>
                <span class="text">Issue Transcript</span>
            </button>
        </form>
    </div>
</div>
@endsection
