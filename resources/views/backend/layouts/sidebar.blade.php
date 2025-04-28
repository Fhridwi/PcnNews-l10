<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu Utama</li>

        <li class="sidebar-item {{ request()->routeIs('dashboard.admin') ? 'active' : '' }}">
            <a href="{{ route('dashboard.admin') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-title">Manajemen Pengguna</li>

        <li class="sidebar-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
            <a href="{{ route('user.index') }}" class='sidebar-link'>
                <i class="bi bi-people-fill"></i>
                <span>Users</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->routeIs('profil.*') ? 'active' : '' }}">
            <a href="{{ route('profil.index') }}" class='sidebar-link'>
                <i class="bi bi-person-circle"></i>
                <span>Profil</span>
            </a>
        </li>

        <li class="sidebar-title">Manajemen Artikel</li>

        <li class="sidebar-item {{ request()->routeIs('article.*') ? 'active' : '' }}">
            <a href="{{ route('article.index') }}" class='sidebar-link'>
                <i class="bi bi-file-earmark-text"></i>
                <span>Artikel</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-tags-fill"></i>
                <span>Tags</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-images"></i>
                <span>Media</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->routeIs('category.*') ? 'active' : '' }}">
            <a href="{{ route('category.index') }}" class='sidebar-link'>
                <i class="bi bi-folder-fill"></i>
                <span>Kategori</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-chat-left-text-fill"></i>
                <span>Komentar</span>
            </a>
        </li>

        <li class="sidebar-title">Lainnya</li>

        <li class="sidebar-item">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-sliders"></i>
                <span>Site Settings</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-emoji-smile-fill"></i>
                <span>Reaksi</span>
            </a>
        </li>

        <li class="sidebar-title">Sistem</li>

        <li class="sidebar-item">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-box-seam"></i>
                <span>Migrasi</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-lock-fill"></i>
                <span>Password Reset</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-x-circle-fill"></i>
                <span>Failed Jobs</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-key-fill"></i>
                <span>Tokens</span>
            </a>
        </li>

        <li class="sidebar-title">Keluar</li>

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
