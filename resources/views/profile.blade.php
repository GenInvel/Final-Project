@extends('layouts.app')

@section('title', 'Profile - TheSPARK')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')
<div class="profile-page">
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-avatar">
                <img src="{{ asset('images/default-avatar.png') }}" alt="Profile Picture">
                <button class="avatar-edit-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M12 5v14M5 12h14" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
            
            <div class="profile-info">
                <h1 class="profile-username">Username</h1>
                <p class="profile-email">user@example.com</p>
                <button class="edit-profile-btn" onclick="toggleEditMode()">Edit Profile</button>
            </div>
        </div>
        
        <div class="profile-edit-form" id="editForm" style="display: none;">
            <form action="{{ url('/profile/update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="Username" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="user@example.com" readonly>
                    <small>Email cannot be changed</small>
                </div>
                
                <div class="form-actions">
                    <button type="button" class="cancel-btn" onclick="toggleEditMode()">Cancel</button>
                    <button type="submit" class="save-btn">Save Changes</button>
                </div>
            </form>
        </div>
        
        <div class="profile-content">
            <div class="profile-section">
                <h2>Favorite Articles</h2>
                
                <div class="favorites-grid">
                    @for($i = 0; $i < 6; $i++)
                    <article class="article-card">
                        <div class="article-image">
                            <span class="article-category">News</span>
                            <img src="{{ asset('images/placeholder-article.jpg') }}" alt="Article">
                            <button class="remove-favorite">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="article-content">
                            <h3>The Headline</h3>
                            <p>The body of the article should open with small, captivating story or a personal anecdote.</p>
                            <div class="article-meta">
                                <span class="article-date">September 13, 2025</span>
                                <a href="{{ url('/articles/1') }}" class="read-more">Read More</a>
                            </div>
                        </div>
                    </article>
                    @endfor
                </div>
            </div>
        </div>
        
        <div class="profile-actions">
            <form action="{{ url('/logout') }}" method="POST">
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
    </div>
</div>

@push('scripts')
<script>
function toggleEditMode() {
    const editForm = document.getElementById('editForm');
    if (editForm.style.display === 'none') {
        editForm.style.display = 'block';
    } else {
        editForm.style.display = 'none';
    }
}
</script>
@endpush
@endsection