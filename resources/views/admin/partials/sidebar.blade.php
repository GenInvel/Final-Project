<aside class="admin-sidebar">
    <div class="admin-logo">
        <img src="{{ asset('images/sparklogo.png') }}" alt="TheSPARK Logo">
        <div class="logo-text">
            <h2>TheSPARK</h2>
            <p>Truth knows no limits</p>
        </div>
    </div>
    
    <nav>
        <ul class="sidebar-nav">
            <li>
                <a href="#" class="nav-item has-subnav {{ request()->is('admin/posts*') ? 'active expanded' : '' }}">
                    <div class="nav-item-content">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                            <line x1="9" y1="9" x2="15" y2="9"/>
                            <line x1="9" y1="13" x2="15" y2="13"/>
                            <line x1="9" y1="17" x2="13" y2="17"/>
                        </svg>
                        <span>Posts</span>
                    </div>
                    <svg class="nav-arrow" width="12" height="8" viewBox="0 0 12 8" fill="none">
                        <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </a>
                <ul class="subnav {{ request()->is('admin/posts*') ? 'active' : '' }}">
                    <li><a href="{{ route('admin.posts.create') }}" class="subnav-item {{ request()->is('admin/posts/create') ? 'active' : '' }}">Write New</a></li>
                    <li><a href="{{ route('admin.posts.index') }}" class="subnav-item {{ request()->is('admin/posts') && !request()->is('admin/posts/*') ? 'active' : '' }}">All Posts</a></li>
                </ul>
            </li>
            
            <li>
                <a href="#" class="nav-item has-subnav {{ request()->is('admin/staff*') ? 'active expanded' : '' }}">
                    <div class="nav-item-content">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        <span>Users</span>
                    </div>
                    <svg class="nav-arrow" width="12" height="8" viewBox="0 0 12 8" fill="none">
                        <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </a>
                <ul class="subnav {{ request()->is('admin/staff*') ? 'active' : '' }}">
                    <li><a href="{{ route('admin.staff.create') }}" class="subnav-item {{ request()->is('admin/staff/create') ? 'active' : '' }}">Add New</a></li>
                    <li><a href="{{ route('admin.staff.index') }}" class="subnav-item {{ request()->is('admin/staff') && !request()->is('admin/staff/*') ? 'active' : '' }}">Manage Staff</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    
    <div class="user-profile">
        <div class="user-info">
            <img src="{{ asset('images/sparklogo.png') }}" alt="User" class="user-avatar">
            <div class="user-details">
                <h4>Current User</h4>
                <p>{{ auth()->user()->email ?? 'usernameof@email.com' }}</p>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Log Out
            </button>
        </form>
    </div>
</aside>
