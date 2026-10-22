@extends('layouts.admin')

@section('hide_alerts', '1')

@section('title')
Studentship Letter
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/admin/student">Student management</a></li>
<li class="breadcrumb-item">Studentship Letter</li>
@endsection

@section('content')
<div class="card mb-2">
  <div class="card-body">
    <h4 class="text-secondary mb-3 mt-3"><i data-feather="file-text" class="mr-0 pb-1"></i> Generate Studentship Letter</h4>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ url('/admin/student/generate-student-ship-letter') }}">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="registration_no">Registration Number</label>
                    <input type="text" class="form-control" id="registration_no" name="registration_no" placeholder="e.g., AG/2025/111" required value="{{ old('registration_no') }}">
                    @if($errors->has('registration_no'))
                        <span class="text-danger">{{ $errors->first('registration_no') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <select class="form-control" id="semester" name="semester" required>
                        <option value="1st Semester" {{ old('semester', '1st Semester') == '1st Semester' ? 'selected' : '' }}>1st Semester</option>
                        <option value="2nd Semester" {{ old('semester') == '2nd Semester' ? 'selected' : '' }}>2nd Semester</option>
                    </select>
                    @if($errors->has('semester'))
                        <span class="text-danger">{{ $errors->first('semester') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="BtnSubmit" class="d-block">&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-grey-overlay btn-icon-split" id="BtnSubmit">
                        <span class="icon"><i class="fa fa-download"></i></span>
                        <span class="text">Download Letter</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection

@section('custom-js')
<script>
$(document).ready(function() {
    feather.replace();
});
</script>
@endsection
