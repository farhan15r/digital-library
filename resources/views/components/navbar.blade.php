<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">My Library App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    @auth
                        {{-- logout --}}
                        <form action="{{ route('logout') }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="nav-link btn btn-danger" type="submit">Logout</button>
                        </form>
                    @else
                        {{-- login --}}
                        <a class="nav-link sbtn btn-primary" href="{{ route('login') }}">Login</a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
