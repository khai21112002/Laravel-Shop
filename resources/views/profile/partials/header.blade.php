<header class="d-flex justify-content-end align-items-center p-3 header-main">
    <div class="admin-info d-flex align-items-center">
        <span class="admin-name me-2">
            {{ Auth::user()->name ?? 'admin' }}
        </span>
        <img src="https://via.placeholder.com/50" alt="Admin Image" class="admin-img">
    </div>
</header>
