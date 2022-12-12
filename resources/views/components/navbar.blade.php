<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home.product') }}">Home Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('home.post') }}">Home Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('product.list') }}">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('post.index') }}">Post</a>
                </li>
                @if (session()->has('logged'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.logout') }}">Logout</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.login') }}">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
