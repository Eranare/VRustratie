<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Panel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adminNavbar"
        aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="adminNavbar">
        <ul class="navbar-nav mr-auto">
            {{-- Users Management --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.index') }}">Manage Users</a>
            </li>

            {{-- Playlists Management --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.playlists.index') }}">Manage Playlists</a>
            </li>

            {{-- Access Codes Management --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.codes.index') }}">Manage Access Codes</a>
            </li>

            {{-- VR Videos Management --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.videos.index') }}">Manage VR Videos</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            {{-- Logout --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>
