@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Admin Dashboard</div>

                    <div class="card-body">
                        <div class="row">
                            {{-- Users Management --}}
                            <div class="col-md-4">
                                <h5>Users Management</h5>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Manage Users</a>
                            </div>

                            {{-- Playlists Management --}}
                            <div class="col-md-4">
                                <h5>Playlists Management</h5>
                                <a href="{{ route('admin.playlists.index') }}" class="btn btn-primary">Manage Playlists</a>
                            </div>

                            {{-- Access Codes Management --}}
                            <div class="col-md-4">
                                <h5>Access Codes</h5>
                                <a href="{{ route('admin.codes.index') }}" class="btn btn-primary">Manage Access Codes</a>
                            </div>
                            <div class="col-md-4">
                                <h5>VR Videos</h5>
                                <a href="{{ route('admin.videos.index') }}" class="btn btn-primary">Manage VR Videos</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection