@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Manage Playlists</div>

                    <div class="card-body">
                        <a href="{{ route('admin.playlists.create') }}" class="btn btn-primary mb-3">Add New Playlist</a>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Videos</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($playlists as $playlist)
                                    <tr>
                                        <td>{{ $playlist->title }}</td>
                                        <td>{{ $playlist->description }}</td>
                                        <td>{{ $playlist->videos->count() }}</td>
                                        <td>
                                            <a href="{{ route('admin.playlists.edit', $playlist->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('admin.playlists.destroy', $playlist->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No playlists found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $playlists->links() }} <!-- Pagination links -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection