<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-logo">
            <img src="{{ asset('images/sparklogo.png') }}" alt="TheSPARK Logo">
            <div class="logo-text">
                <h1>TheSPARK</h1>
                <p>Truth knows no limits</p>
            </div>
        </div>

        <div class="navbar-menu">
            <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>

            <div class="nav-dropdown">
                <a href="#" class="nav-link {{ request()->is('categories*') ? 'active' : '' }}">
                    Categories
                    <svg width="12" height="8" viewBox="0 0 12 8" fill="none">
                        <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="2" />
                    </svg>
                </a>
                <div class="dropdown-content">
                    <a href="{{ url('/categories/news') }}">News</a>
                    <a href="{{ url('/categories/opinion') }}">Opinion</a>
                    <a href="{{ url('/categories/devcom') }}">DevCom</a>
                    <a href="{{ url('/categories/feature') }}">Feature</a>
                    <a href="{{ url('/categories/literary') }}">Literary</a>
                    <a href="{{ url('/categories/scitech') }}">Sci&Tech</a>
                    <a href="{{ url('/categories/sports') }}">Sports</a>
                </div>
            </div>

            <a href="{{ url('/articles') }}"
                class="nav-link {{ request()->is('articles*') ? 'active' : '' }}">Articles</a>
        </div>

        <div class="navbar-actions">
            <button class="search-btn" onclick="toggleSearch()">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <circle cx="9" cy="9" r="7" stroke="currentColor" stroke-width="2" />
                    <path d="M14 14L18 18" stroke="currentColor" stroke-width="2" />
                </svg>
            </button>


            <button class="hamburger-btn" onclick="toggleMobileMenu()">
                <span></span>
                <span></span>
                <span></span>
            </button>


            @auth
            <div class="profile-dropdown">
                <button class="profile-btn">
                    <img src="https://img.icons8.com/?size=100&id=14736&format=png&color=000000" alt="Profile">
                </button>
                <div class="profile-dropdown-content">
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    @else
                    <a href="{{ route('profile') }}">Profile</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit"
                            style="width: 100%; text-align: left; background: none; border: none; padding: 0.75rem 1.5rem; color: var(--text-dark); cursor: pointer; font-size: 1rem;">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
            @endauth

        </div>
    </div>

    <div class="search-overlay" id="searchOverlay">
        <div class="search-container">
            <input type="text" placeholder="Search articles..." class="search-input">
            <button class="search-close" onclick="toggleSearch()">×</button>
        </div>
    </div>
</nav>