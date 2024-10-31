<nav class="vertical-nav">
    <a class="navbar-brand text-white ms-3 mb-4 mt-5" href="{{route('dashboard')}}">Admin Dashboard</a>
    <div class="seperation-line mb-3 mt-3 pe-3 ps-3"></div>
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="{{route('users.index')}}">Users</a></li>

        <li class="nav-item"><a class="nav-link" href="{{route('ProductImage.index')}}">Products album</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('categories.index')}}">Categories</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('orders.index')}}">Orders</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('products.index')}}">Products</a></li>

        <li class="nav-item"><form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
             this.closest('form').submit();">
                {{ __('Log Out') }}
            </a>
        </form></li>
    </ul>
</nav>
