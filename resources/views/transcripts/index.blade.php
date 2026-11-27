@extends('layouts.admin')

@section('title')
Transcript Records
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Transcripts</a></li>
<li class="breadcrumb-item">All Records</li>
@endsection



@section('content')
<div class="card mb-3">
    <div class="card-body">
        <h4 class="text-secondary mb-3 mt-1"><i data-feather="layers" class="mr-1 pb-1"></i> Issued Transcript Records</h4>
        <div class="table-responsive">
            <table class="table table-striped table-bordered compact">
                <thead>
                    @php
                        $sortLink = function ($col, $label) use ($sort, $direction) {
                            $isCurrent = ($sort ?? 'id') === $col;
                            $nextDir = ($isCurrent && ($direction ?? 'desc') === 'asc') ? 'desc' : 'asc';
                            $icon = $isCurrent
                                ? (($direction ?? 'desc') === 'asc' ? 'fa-sort-up' : 'fa-sort-down')
                                : 'fa-sort text-muted';
                            $url = route('transcripts.index', ['sort' => $col, 'direction' => $nextDir]);
                            return '<a href="' . $url . '" class="text-dark d-flex justify-content-between align-items-center text-decoration-none"><span>' . e($label) . '</span><i class="fas ' . $icon . ' ml-1"></i></a>';
                        };
                    @endphp
                    <tr>
                        <th>{!! $sortLink('id', '#') !!}</th>
                        <th>{!! $sortLink('document_id', 'Document ID') !!}</th>
                        <th>Student</th>
                        <th>{!! $sortLink('degree_name', 'Degree') !!}</th>
                        <th>{!! $sortLink('fgpa', 'FGPA') !!}</th>
                        <th>{!! $sortLink('class_name', 'Class') !!}</th>
                        <th>Status</th>
                        <th>{!! $sortLink('issued_at', 'Issued At') !!}</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transcripts as $t)
                    <tr>
                        <td>{{ $t->id }}</td>
                        <td><code>{{ $t->document_id }}</code></td>
                        <td>
                            @if($t->student)
                                {{ $t->student->name_with_initials ?? ($t->student->first_name . ' ' . $t->student->last_name) }}
                                <br><small class="text-muted">{{ $t->student->registration_no ?? '' }}</small>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>{{ $t->degree_name ?? '—' }}</td>
                        <td>{{ $t->fgpa ?? '—' }}</td>
                        <td>{{ $t->class_name ?? '—' }}</td>
                        <td>
                            <span class="badge badge-success">Active</span>
                        </td>
                        <td>{{ $t->issued_at ? $t->issued_at->format('Y-m-d') : '—' }}</td>
                        <td class="text-center">
                            <a href="{{ route('transcripts.show', $t->id) }}" class="btn btn-sm btn-info btn-icon-split">
                                <span class="icon"><i class="fas fa-eye"></i></span><span class="text">View</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-muted py-3">No transcript records found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-2">{{ $transcripts->links('pagination::bootstrap-4') }}</div>
    </div>
</div>
@endsection
