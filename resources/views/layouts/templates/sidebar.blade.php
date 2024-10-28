<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
    <li class="nav-item dropdown">
        <!-- <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a> -->
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    @if ($user->profile_image)
        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Picture" class="rounded-circle" style="width: 50px; height: 50px;">
    @else
    <img src="{{ asset('assets/auth/assets/img/icon.webp') }}" alt="Default Profile Picture" class="rounded-circle" width="60px" height="50px">      
    @endif
</a>

        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('user.show', auth()->user()->id) }}">Profile</a></li>
            <li><a class="dropdown-item" href="">Settings</a></li>
            <li><a class="dropdown-item" href="#!">Activity Log</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{route('logout')}}"><button class="btn btn-info" type="submit">Logout</button></a>
                </form>
</li>
        </ul>
    </li>
</ul>

