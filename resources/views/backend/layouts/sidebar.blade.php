<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <!-- Dashboard -->
        <li class="sidebar-item {{ request()->routeIs('dashboard.admin') ? 'active' : '' }}">
            <a href="{{ route('dashboard.admin') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Users -->
        <li class="sidebar-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
            <a href="{{ route('user.index') }}" class='sidebar-link'>
                <i class="bi bi-people-fill"></i>
                <span>Users</span>
            </a>
        </li>

        <!-- Category -->
        <li class="sidebar-item {{ request()->routeIs('category.*') ? 'active' : '' }}">
            <a href="{{ route('category.index') }}" class='sidebar-link'>
                <i class="bi bi-folder-fill"></i>
                <span>Category</span>
            </a>
        </li>

        <!-- Article -->
        <li class="sidebar-item {{ request()->routeIs('article.*') ? 'active' : '' }}">
            <a href="{{ route('article.index') }}" class='sidebar-link'>
                <i class="bi bi-folder-fill"></i>
                <span>Article</span>
            </a>
        </li>

        <!-- Logout -->
        <li class="sidebar-item">
            <a href="{{ route('logout') }}" class="sidebar-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>
