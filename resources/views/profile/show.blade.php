@extends('layouts.app')

@section('title', 'Profile - TheSPARK')

@push('styles')
<style>
    .profile-page {
        max-width: 800px;
        margin: 3rem auto;
        padding: 0 1rem;
    }

    .profile-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .profile-header h1 {
        font-size: 2rem;
        color: #1a1a1a;
        margin-bottom: 0.5rem;
    }

    .profile-card {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }

    .profile-avatar {
        text-align: center;
        margin-bottom: 2rem;
    }

    .avatar-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto;
        background: linear-gradient(135deg, #d32f2f, #b71c1c);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-icon svg {
        width: 60px;
        height: 60px;
        color: white;
    }

    .profile-info {
        text-align: center;
        margin-bottom: 2rem;
    }

    .profile-info h2 {
        font-size: 1.5rem;
        color: #1a1a1a;
        margin-bottom: 0.5rem;
    }

    .profile-info p {
        color: #666;
        font-size: 1rem;
    }

    .profile-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.75rem 2rem;
        border-radius: 8px;
        border: none;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary {
        background: #d32f2f;
        color: white;
    }

    .btn-primary:hover {
        background: #b71c1c;
    }

    .btn-danger {
        background: #fff;
        color: #d32f2f;
        border: 2px solid #d32f2f;
    }

    .btn-danger:hover {
        background: #d32f2f;
        color: white;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: #333;
        font-weight: 600;
    }

    .form-group input {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 1rem;
    }

    .form-group input:focus {
        outline: none;
        border-color: #d32f2f;
    }

    .alert {
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .error-message {
        color: #d32f2f;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        display: block;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        align-items: center;
        justify-content: center;
    }

    .modal.active {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-header {
        margin-bottom: 1.5rem;
    }

    .modal-header h2 {
        font-size: 1.5rem;
        color: #1a1a1a;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 2rem;
        cursor: pointer;
        float: right;
        color: #999;
    }

    .modal-footer {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
        justify-content: flex-end;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #5a6268;
    }
</style>
@endpush

@section('content')
<div class="profile-page">
    <div class="profile-header">
        <h1>My Profile</h1>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="profile-card">
        <div class="profile-avatar">
            <div class="avatar-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
        </div>

        <div class="profile-info">
            <h2>{{ $user->username }}</h2>
            <p>{{ $user->email }}</p>
            <p style="color: #d32f2f; font-weight: 600; margin-top: 0.5rem;">
                {{ $user->isAdmin() ? 'Administrator' : 'Visitor' }}
            </p>
        </div>

        <div class="profile-actions">
            <button onclick="openEditModal()" class="btn btn-primary">Edit Profile</button>
            <button onclick="openDeleteModal()" class="btn btn-danger">Delete Account</button>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeEditModal()">×</button>
        <div class="modal-header">
            <h2>Edit Profile</h2>
        </div>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                @error('username')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <hr style="margin: 2rem 0; border: none; border-top: 1px solid #e0e0e0;">

            <p style="color: #666; margin-bottom: 1rem; font-size: 0.9rem;">Leave password fields empty if you don't want to change your password.</p>

            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password">
                @error('current_password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" minlength="8">
                @error('new_password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="new_password_confirmation">Confirm New Password</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" minlength="8">
            </div>

            <div class="modal-footer">
                <button type="button" onclick="closeEditModal()" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal" id="deleteModal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeDeleteModal()">×</button>
        <div class="modal-header">
            <h2>Delete Account</h2>
        </div>

        <p style="color: #d32f2f; margin-bottom: 1.5rem;">
            ⚠️ Warning: This action cannot be undone. Your account and all associated data will be permanently deleted.
        </p>

        <form action="{{ route('profile.destroy') }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="form-group">
                <label for="delete_password">Enter your password to confirm</label>
                <input type="password" id="delete_password" name="password" required>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="modal-footer">
                <button type="button" onclick="closeDeleteModal()" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete My Account</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openEditModal() {
    document.getElementById('editModal').classList.add('active');
}

function closeEditModal() {
    document.getElementById('editModal').classList.remove('active');
}

function openDeleteModal() {
    document.getElementById('deleteModal').classList.add('active');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('active');
}

// Close modals with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeEditModal();
        closeDeleteModal();
    }
});

// Open edit modal if there are validation errors
@if($errors->any() && !$errors->has('password'))
    openEditModal();
@endif

// Open delete modal if there's a password error
@if($errors->has('password'))
    openDeleteModal();
@endif
</script>
@endpush
@endsection
