@extends('layouts.admin')

@section('title')
Verification Audit Log
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('transcripts.index') }}">Transcripts</a></li>
<li class="breadcrumb-item">Verification Audit</li>
@endsection

@section('content')
<div class="row">
    @foreach([
        ['label' => 'Total Attempts', 'value' => $summary['total'], 'class' => 'primary'],
        ['label' => 'Valid', 'value' => $summary['valid'], 'class' => 'success'],
        ['label' => 'Invalid', 'value' => $summary['invalid'], 'class' => 'danger'],
        ['label' => 'QR Scans', 'value' => $summary['qr_code'], 'class' => 'info'],
        ['label' => 'Manual Searches', 'value' => $summary['manual'], 'class' => 'secondary'],
    ] as $card)
    <div class="col-xl col-md-6 mb-3">
        <div class="card border-left-{{ $card['class'] }} shadow h-100 py-2">
            <div class="card-body py-2">
                <div class="text-xs font-weight-bold text-{{ $card['class'] }} text-uppercase mb-1">{{ $card['label'] }}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $card['value'] }}</div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="card shadow mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.verification-audit-logs.index') }}">
            <div class="form-row align-items-end">
                <div class="form-group col-md-3">
                    <label for="search">Search</label>
                    <input id="search" type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Document, registration, IP">
                </div>
                <div class="form-group col-md-2">
                    <label for="method">Method</label>
                    <select id="method" name="method" class="form-control">
                        <option value="">All methods</option>
                        <option value="qr_code" {{ request('method') === 'qr_code' ? 'selected' : '' }}>QR code</option>
                        <option value="manual" {{ request('method') === 'manual' ? 'selected' : '' }}>Manual</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="result">Result</label>
                    <select id="result" name="result" class="form-control">
                        <option value="">All results</option>
                        <option value="valid" {{ request('result') === 'valid' ? 'selected' : '' }}>Valid</option>
                        <option value="invalid" {{ request('result') === 'invalid' ? 'selected' : '' }}>Invalid</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="from">From</label>
                    <input id="from" type="date" name="from" class="form-control" value="{{ request('from') }}">
                </div>
                <div class="form-group col-md-2">
                    <label for="to">To</label>
                    <input id="to" type="date" name="to" class="form-control" value="{{ request('to') }}">
                </div>
                <div class="form-group col-md-1">
                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3 mb-0">
                    <label for="failure_reason">Failure reason</label>
                    <select id="failure_reason" name="failure_reason" class="form-control">
                        <option value="">All failure reasons</option>
                        @foreach($failureReasons as $reason)
                        <option value="{{ $reason }}" {{ request('failure_reason') === $reason ? 'selected' : '' }}>{{ $reason }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead>
                    <tr>
                        <th>Date/time</th>
                        <th>Document ID</th>
                        <th>Registration No.</th>
                        <th>Method</th>
                        <th>Result</th>
                        <th>Failure reason</th>
                        <th>IP address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            @if($log->transcript)
                            <a href="{{ route('transcripts.show', $log->transcript->id) }}"><code>{{ $log->document_id_searched }}</code></a>
                            @else
                            <code>{{ $log->document_id_searched ?: '—' }}</code>
                            @endif
                        </td>
                        <td>{{ $log->registration_no_searched ?: '—' }}</td>
                        <td>{{ $log->verification_method === 'qr_code' ? 'QR code' : 'Manual' }}</td>
                        <td>
                            @if($log->is_valid)
                            <span class="badge badge-success">Valid</span>
                            @else
                            <span class="badge badge-danger">Invalid</span>
                            @endif
                        </td>
                        <td>{{ $log->failure_reason ?: '—' }}</td>
                        <td>{{ $log->ip_address ?: '—' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center">No verification attempts found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $logs->links() }}</div>
    </div>
</div>
@endsection
