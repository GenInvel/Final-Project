@extends('admin.layouts.dashboard')

@section('title', 'Edit Staff - TheSPARK Admin')
@section('page-title', 'Edit Staff Member')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/staff.css') }}">
@endpush

@section('content')

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<form class="add-staff-form" action="{{ route('admin.staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="staff-form-row">
        <div class="staff-form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="name" placeholder="Last Name, Given Names, Middle Initial" value="{{ old('name', $staff->name) }}" required>
            @error('name')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="staff-form-group">
            <label for="email">CSPC Email</label>
            <input type="email" id="email" name="email" placeholder="name@my.cspc.edu.ph" value="{{ old('email', $staff->email) }}" required>
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="staff-picture-upload">
            <label>Picture</label>
            <div class="picture-upload-area" id="pictureUploadArea" onclick="document.getElementById('pictureInput').click()">
                @if($staff->photo)
                    <img src="{{ $staff->photo_url }}" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 3px solid var(--primary-color);">
                    <p style="margin-top: 1rem; font-weight: 600; color: var(--primary-color);">Current Photo</p>
                    <button type="button" class="browse-btn" onclick="document.getElementById('pictureInput').click(); event.stopPropagation();">Change Image</button>
                @else
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="17 8 12 3 7 8"/>
                        <line x1="12" y1="3" x2="12" y2="15"/>
                    </svg>
                    <p>Choose a file or drag & drop here.</p>
                    <small>(jpeg, png, jpg, gif - up to 100mb)</small>
                    <button type="button" class="browse-btn">Browse Files</button>
                @endif
            </div>
            <input type="file" id="pictureInput" name="picture" accept="image/*" style="display: none;">
            @error('picture')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
    </div>
    
    <div class="staff-form-row">
        <div class="staff-form-group">
            <label for="position">Position</label>
            <select id="position" name="position" required>
                <option value="">Select Position</option>
                <optgroup label="Editorial Board">
                    <option value="Editor-in-Chief" {{ old('position', $staff->position) == 'Editor-in-Chief' ? 'selected' : '' }}>Editor-in-Chief</option>
                    <option value="Associate Editor for Internal" {{ old('position', $staff->position) == 'Associate Editor for Internal' ? 'selected' : '' }}>Associate Editor for Internal</option>
                    <option value="Associate Editor for External" {{ old('position', $staff->position) == 'Associate Editor for External' ? 'selected' : '' }}>Associate Editor for External</option>
                    <option value="Managing Editor" {{ old('position', $staff->position) == 'Managing Editor' ? 'selected' : '' }}>Managing Editor</option>
                    <option value="Assistant Managing Editor" {{ old('position', $staff->position) == 'Assistant Managing Editor' ? 'selected' : '' }}>Assistant Managing Editor</option>
                    <option value="Circulation Manager" {{ old('position', $staff->position) == 'Circulation Manager' ? 'selected' : '' }}>Circulation Manager</option>
                    <option value="Copy Editor" {{ old('position', $staff->position) == 'Copy Editor' ? 'selected' : '' }}>Copy Editor</option>
                    <option value="Art Editor" {{ old('position', $staff->position) == 'Art Editor' ? 'selected' : '' }}>Art Editor</option>
                    <option value="Layout Editor" {{ old('position', $staff->position) == 'Layout Editor' ? 'selected' : '' }}>Layout Editor</option>
                </optgroup>
                <optgroup label="Writers & Contributors">
                    <option value="News" {{ old('position', $staff->position) == 'News' ? 'selected' : '' }}>News</option>
                    <option value="Opinion" {{ old('position', $staff->position) == 'Opinion' ? 'selected' : '' }}>Opinion</option>
                    <option value="DevCom" {{ old('position', $staff->position) == 'DevCom' ? 'selected' : '' }}>DevCom</option>
                    <option value="Feature" {{ old('position', $staff->position) == 'Feature' ? 'selected' : '' }}>Feature</option>
                    <option value="Literary" {{ old('position', $staff->position) == 'Literary' ? 'selected' : '' }}>Literary</option>
                    <option value="Sci&Tech" {{ old('position', $staff->position) == 'Sci&Tech' ? 'selected' : '' }}>Sci&Tech</option>
                    <option value="Sports" {{ old('position', $staff->position) == 'Sports' ? 'selected' : '' }}>Sports</option>
                </optgroup>
                <optgroup label="Production & Design">
                    <option value="Copyreader" {{ old('position', $staff->position) == 'Copyreader' ? 'selected' : '' }}>Copyreader</option>
                    <option value="Layout Artist" {{ old('position', $staff->position) == 'Layout Artist' ? 'selected' : '' }}>Layout Artist</option>
                    <option value="Editorial Cartoonist" {{ old('position', $staff->position) == 'Editorial Cartoonist' ? 'selected' : '' }}>Editorial Cartoonist</option>
                    <option value="Graphic Artist" {{ old('position', $staff->position) == 'Graphic Artist' ? 'selected' : '' }}>Graphic Artist</option>
                </optgroup>
                <optgroup label="Photography & Video">
                    <option value="Photojournalist" {{ old('position', $staff->position) == 'Photojournalist' ? 'selected' : '' }}>Photojournalist</option>
                    <option value="News Presenter" {{ old('position', $staff->position) == 'News Presenter' ? 'selected' : '' }}>News Presenter</option>
                    <option value="Videographer" {{ old('position', $staff->position) == 'Videographer' ? 'selected' : '' }}>Videographer</option>
                    <option value="Video Editor" {{ old('position', $staff->position) == 'Video Editor' ? 'selected' : '' }}>Video Editor</option>
                    <option value="Technical Director" {{ old('position', $staff->position) == 'Technical Director' ? 'selected' : '' }}>Technical Director</option>
                </optgroup>
                <optgroup label="Other">
                    <option value="Editorial Assistant" {{ old('position', $staff->position) == 'Editorial Assistant' ? 'selected' : '' }}>Editorial Assistant</option>
                </optgroup>
            </select>
            @error('position')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="staff-form-group">
            <label for="program">Program</label>
            <input type="text" id="program" name="program" placeholder="e.g., BSIT, BSCS, BAJ, BMMA" value="{{ old('program', $staff->program) }}" required>
            @error('program')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="staff-form-group">
            <label for="year_section">Year & Section</label>
            <input type="text" id="year_section" name="year_section" placeholder="e.g., 3-C" value="{{ old('year_section', $staff->year_section) }}" required>
            @error('year_section')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
    </div>
    
    <div class="staff-form-actions">
        <a href="{{ route('admin.staff.index') }}" class="reset-data-btn">Cancel</a>
        <button type="submit" class="add-user-btn">
            Update Staff Member
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                <polyline points="17 21 17 13 7 13 7 21"/>
                <polyline points="7 3 7 8 15 8"/>
            </svg>
        </button>
    </div>
</form>

@push('scripts')
<script>
// Picture preview
document.getElementById('pictureInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Validate file size (100MB max)
        if (file.size > 100 * 1024 * 1024) {
            alert('File size must be less than 100MB');
            this.value = '';
            return;
        }

        // Validate file type
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        if (!validTypes.includes(file.type)) {
            alert('Please upload a valid image file (JPEG, PNG, JPG, GIF)');
            this.value = '';
            return;
        }

        const uploadArea = document.getElementById('pictureUploadArea');
        uploadArea.innerHTML = `
            <img src="${URL.createObjectURL(file)}" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 3px solid var(--primary-color);">
            <p style="margin-top: 1rem; font-weight: 600; color: var(--primary-color);">${file.name}</p>
            <button type="button" class="browse-btn" onclick="document.getElementById('pictureInput').click(); event.stopPropagation();">Change Image</button>
        `;
    }
});

// Drag and drop functionality
const uploadArea = document.getElementById('pictureUploadArea');

uploadArea.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.style.borderColor = 'var(--secondary-color)';
    this.style.background = '#e0f2fe';
});

uploadArea.addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.style.borderColor = 'var(--border-color)';
    this.style.background = '#f9fafb';
});

uploadArea.addEventListener('drop', function(e) {
    e.preventDefault();
    this.style.borderColor = 'var(--border-color)';
    this.style.background = '#f9fafb';
    
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        document.getElementById('pictureInput').files = e.dataTransfer.files;
        document.getElementById('pictureInput').dispatchEvent(new Event('change'));
    } else {
        alert('Please drop an image file');
    }
});
</script>
@endpush
@endsection
