@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Manage Videos</div>

                    <div class="card-body">
                        <a href="{{ route('admin.videos.create') }}" class="btn btn-primary mb-3">Add New Video</a>

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
                                    <th>Video URL</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($videos as $video)
                                    <tr>
                                        <td>{{ $video->title }}</td>
                                        <td>{{ $video->description }}</td>
                                        <td><a href="{{ $video->video_url }}" target="_blank">View Video</a></td>
                                        <td>
                                            <a href="{{ route('admin.videos.edit', $video->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('admin.videos.destroy', $video->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No videos found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $videos->links() }} <!-- Pagination links -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection