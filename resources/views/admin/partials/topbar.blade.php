<div class="admin-topbar">
    <h1>@yield('page-title', 'Dashboard')</h1>
    
    <div class="topbar-actions">
        <form action="{{ request()->url() }}" method="GET" class="search-form">
            <div class="search-bar">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <circle cx="9" cy="9" r="7" stroke="currentColor" stroke-width="2"/>
                    <path d="M14 14L18 18" stroke="currentColor" stroke-width="2"/>
                </svg>
                <input type="text" name="search" placeholder="Search by title..." id="adminSearch" value="{{ request('search') }}">
                @if(request('search'))
                    <button type="button" class="clear-search" onclick="clearSearch()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </button>
                @endif
            </div>
        </form>
        
        <a href="{{ url('/') }}" class="view-site-btn" target="_blank">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <circle cx="12" cy="12" r="10"/>
                <line x1="2" y1="12" x2="22" y2="12"/>
                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
            </svg>
            View Site
        </a>
    </div>
</div>

@push('scripts')
<script>
// Auto-submit search form on input
document.getElementById('adminSearch').addEventListener('input', function() {
    clearTimeout(window.searchTimeout);
    window.searchTimeout = setTimeout(() => {
        this.form.submit();
    }, 500); // Wait 500ms after user stops typing
});

// Clear search function
function clearSearch() {
    document.getElementById('adminSearch').value = '';
    document.querySelector('.search-form').submit();
}
</script>
@endpush

<style>
.search-form {
    position: relative;
}

.clear-search {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
    transition: color 0.2s;
}

.clear-search:hover {
    color: #000;
}
</style>
