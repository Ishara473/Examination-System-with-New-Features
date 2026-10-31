<!-- resources/views/transcripts/index.blade.php -->
@extends('layouts.app')

@section('content')
<h1 class="mb-4">Transcripts</h1>

<a href="{{ route('transcripts.create') }}" class="btn btn-primary mb-3">Add New Transcript</a>

<table class="table table-hover">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($transcripts as $t)
        <tr>
            <td>{{ $t->id }}</td>
            <td>{{ $t->first_name }} {{ $t->last_name }}</td>
            <td>{{ $t->email }}</td>
            <td>{{ $t->created_at->format('Y-m-d') }}</td>
            <td>
                <a href="{{ route('transcripts.show', $t->id) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('transcripts.edit', $t->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('transcripts.destroy', $t->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this transcript?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center">No transcripts found.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $transcripts->links() }}
@endsection
