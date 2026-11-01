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
                    <tr>
                        <th>#</th>
                        <th>Document ID</th>
                        <th>Student</th>
                        <th>Degree</th>
                        <th>FGPA</th>
                        <th>Class</th>
                        <th>Status</th>
                        <th>Issued At</th>
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
                            @if($t->status === 'active')
                                <span class="badge badge-success">Active</span>
                            @elseif($t->status === 'revoked')
                                <span class="badge badge-danger">Revoked</span>
                            @else
                                <span class="badge badge-secondary">{{ ucfirst($t->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $t->issued_at ? $t->issued_at->format('Y-m-d') : '—' }}</td>
                        <td class="text-center">
                            <a href="{{ route('transcripts.show', $t->id) }}" class="btn btn-sm btn-info btn-icon-split">
                                <span class="icon"><i class="fas fa-eye"></i></span><span class="text">View</span>
                            </a>
                            <a href="{{ route('transcripts.edit', $t->id) }}" class="btn btn-sm btn-warning btn-icon-split">
                                <span class="icon"><i class="fas fa-edit"></i></span><span class="text">Edit</span>
                            </a>
                            <form action="{{ route('transcripts.destroy', $t->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger btn-icon-split" onclick="return confirm('Delete this transcript?')">
                                    <span class="icon"><i class="fas fa-trash"></i></span><span class="text">Delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-muted py-3">No transcript records found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-2">{{ $transcripts->links() }}</div>
    </div>
</div>
@endsection
