<div class="mobile-menu-overlay" id="mobileMenuOverlay" onclick="closeMobileMenu()"></div>

<div class="mobile-menu" id="mobileMenu">
    <button class="mobile-menu-close" onclick="closeMobileMenu()">&times;</button>
    
    <div class="mobile-menu-content">
        <ul class="mobile-menu-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('categories.index') }}">Categories</a></li>
            
            @auth
                @if(auth()->user()->isAdmin())
                    <li><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                @else
                    <li><a href="{{ route('profile') }}">My Profile</a></li>
                @endif
            @endauth
        </ul>

        @auth
            <!-- Logout Button for Authenticated Users -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="signin-btn" style="background: #dc3545; width: 100%;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Logout
                </button>
            </form>
        @else
            <!-- Sign In Button for Guests -->
            <button class="signin-btn" onclick="openAuthModal()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                Sign In
            </button>
        @endauth
    </div>
</div>

<script>
function openMobileMenu() {
    document.getElementById('mobileMenu').classList.add('active');
    document.getElementById('mobileMenuOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeMobileMenu() {
    document.getElementById('mobileMenu').classList.remove('active');
    document.getElementById('mobileMenuOverlay').classList.remove('active');
    document.body.style.overflow = 'auto';
}
</script>
