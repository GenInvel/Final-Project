// ==========================================
// TheSPARK - Main JavaScript File
// ==========================================


// Navbar scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        if (window.scrollY > 50) {
            navbar.style.boxShadow = '0 4px 20px rgba(0,0,0,0.1)';
        } else {
            navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.05)';
        }
    }
});


// Toggle search overlay
function toggleSearch() {
    const searchOverlay = document.getElementById('searchOverlay');
    if (searchOverlay) {
        searchOverlay.classList.toggle('active');
        if (searchOverlay.classList.contains('active')) {
            document.querySelector('.search-input').focus();
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = 'auto';
        }
    }
}


// Toggle mobile menu
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    if (mobileMenu && mobileMenuOverlay) {
        mobileMenu.classList.toggle('active');
        mobileMenuOverlay.classList.toggle('active');
        document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : 'auto';
    }
}


// Open auth modal
function openAuthModal() {
    const authModal = document.getElementById('authModal');
    const authModalOverlay = document.getElementById('authModalOverlay');
    if (authModal && authModalOverlay) {
        authModal.classList.add('active');
        authModalOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}


// Close auth modal
function closeAuthModal() {
    const authModal = document.getElementById('authModal');
    const authModalOverlay = document.getElementById('authModalOverlay');
    if (authModal && authModalOverlay) {
        authModal.classList.remove('active');
        authModalOverlay.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
}


// Switch auth tabs
function switchAuthTab(tab) {
    const loginTab = document.getElementById('loginTab');
    const signupTab = document.getElementById('signupTab');
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');
    
    if (!loginTab || !signupTab || !loginForm || !signupForm) return;
    
    if (tab === 'login') {
        loginTab.classList.add('active');
        signupTab.classList.remove('active');
        loginForm.style.display = 'flex';
        signupForm.style.display = 'none';
    } else if (tab === 'signup') {
        loginTab.classList.remove('active');
        signupTab.classList.add('active');
        loginForm.style.display = 'none';
        signupForm.style.display = 'flex';
    }
}


// ==========================================
// ADMIN SIDEBAR DROPDOWN TOGGLE
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    // Get all navigation items with subnavs
    const navItems = document.querySelectorAll('.nav-item.has-subnav');
    
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get the parent <li> element
            const parentLi = this.parentElement;
            
            // Toggle expanded class on the nav-item
            this.classList.toggle('expanded');
            
            // Toggle the subnav inside the parent <li>
            const subnav = parentLi.querySelector('.subnav');
            if (subnav) {
                subnav.classList.toggle('active');
            }
            
            // Optional: Close other expanded menus
            navItems.forEach(otherItem => {
                if (otherItem !== this) {
                    otherItem.classList.remove('expanded');
                    const otherSubnav = otherItem.parentElement.querySelector('.subnav');
                    if (otherSubnav) {
                        otherSubnav.classList.remove('active');
                    }
                }
            });
        });
    });
    
    // Prevent subnav links from closing the menu when clicked
    document.querySelectorAll('.subnav-item').forEach(link => {
        link.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
});


// Close modals on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const searchOverlay = document.getElementById('searchOverlay');
        const mobileMenu = document.getElementById('mobileMenu');
        const authModal = document.getElementById('authModal');
        
        if (searchOverlay && searchOverlay.classList.contains('active')) {
            toggleSearch();
        }
        if (mobileMenu && mobileMenu.classList.contains('active')) {
            toggleMobileMenu();
        }
        if (authModal && authModal.classList.contains('active')) {
            closeAuthModal();
        }
    }
});
