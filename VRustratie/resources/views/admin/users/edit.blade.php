@extends('layouts.admin')
@section('title', 'Assign Playlist to User')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Assign Playlist to {{ $user->name }}</div>

                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="playlists">Assign Playlist</label>
                                <select name="playlists[]" class="form-control" multiple>
                                    @foreach($playlists as $playlist)
                                        <option value="{{ $playlist->id }}" 
                                            {{ in_array($playlist->id, $user->playlists->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $playlist->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">You can select multiple playlists.</small>
                            </div>

                            <button type="submit" class="btn btn-primary">Assign Playlist(s)</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection