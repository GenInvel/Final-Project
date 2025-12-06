@extends('admin.layouts.dashboard')

@section('title', 'Add New Staff - TheSPARK Admin')
@section('page-title', 'Add New Staff')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/staff.css') }}">
@endpush

@section('content')

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<form class="add-staff-form" action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="staff-form-row">
        <div class="staff-form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="name" placeholder="Last Name, Given Names, Middle Initial" value="{{ old('name') }}" required>
            @error('name')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="staff-form-group">
            <label for="email">CSPC Email</label>
            <input type="email" id="email" name="email" placeholder="name@my.cspc.edu.ph" value="{{ old('email') }}" required>
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="staff-picture-upload">
            <label>Picture</label>
            <div class="picture-upload-area" id="pictureUploadArea" onclick="document.getElementById('pictureInput').click()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="17 8 12 3 7 8"/>
                    <line x1="12" y1="3" x2="12" y2="15"/>
                </svg>
                <p>Choose a file or drag & drop here.</p>
                <small>(jpeg, png, jpg, gif - up to 100mb)</small>
                <button type="button" class="browse-btn">Browse Files</button>
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
                    <option value="Editor-in-Chief" {{ old('position') == 'Editor-in-Chief' ? 'selected' : '' }}>Editor-in-Chief</option>
                    <option value="Associate Editor for Internal" {{ old('position') == 'Associate Editor for Internal' ? 'selected' : '' }}>Associate Editor for Internal</option>
                    <option value="Associate Editor for External" {{ old('position') == 'Associate Editor for External' ? 'selected' : '' }}>Associate Editor for External</option>
                    <option value="Managing Editor" {{ old('position') == 'Managing Editor' ? 'selected' : '' }}>Managing Editor</option>
                    <option value="Assistant Managing Editor" {{ old('position') == 'Assistant Managing Editor' ? 'selected' : '' }}>Assistant Managing Editor</option>
                    <option value="Circulation Manager" {{ old('position') == 'Circulation Manager' ? 'selected' : '' }}>Circulation Manager</option>
                    <option value="Copy Editor" {{ old('position') == 'Copy Editor' ? 'selected' : '' }}>Copy Editor</option>
                    <option value="Art Editor" {{ old('position') == 'Art Editor' ? 'selected' : '' }}>Art Editor</option>
                    <option value="Layout Editor" {{ old('position') == 'Layout Editor' ? 'selected' : '' }}>Layout Editor</option>
                </optgroup>
                <optgroup label="Writers & Contributors">
                    <option value="News" {{ old('position') == 'News' ? 'selected' : '' }}>News</option>
                    <option value="Opinion" {{ old('position') == 'Opinion' ? 'selected' : '' }}>Opinion</option>
                    <option value="DevCom" {{ old('position') == 'DevCom' ? 'selected' : '' }}>DevCom</option>
                    <option value="Feature" {{ old('position') == 'Feature' ? 'selected' : '' }}>Feature</option>
                    <option value="Literary" {{ old('position') == 'Literary' ? 'selected' : '' }}>Literary</option>
                    <option value="Sci&Tech" {{ old('position') == 'Sci&Tech' ? 'selected' : '' }}>Sci&Tech</option>
                    <option value="Sports" {{ old('position') == 'Sports' ? 'selected' : '' }}>Sports</option>
                </optgroup>
                <optgroup label="Production & Design">
                    <option value="Copyreader" {{ old('position') == 'Copyreader' ? 'selected' : '' }}>Copyreader</option>
                    <option value="Layout Artist" {{ old('position') == 'Layout Artist' ? 'selected' : '' }}>Layout Artist</option>
                    <option value="Editorial Cartoonist" {{ old('position') == 'Editorial Cartoonist' ? 'selected' : '' }}>Editorial Cartoonist</option>
                    <option value="Graphic Artist" {{ old('position') == 'Graphic Artist' ? 'selected' : '' }}>Graphic Artist</option>
                </optgroup>
                <optgroup label="Photography & Video">
                    <option value="Photojournalist" {{ old('position') == 'Photojournalist' ? 'selected' : '' }}>Photojournalist</option>
                    <option value="News Presenter" {{ old('position') == 'News Presenter' ? 'selected' : '' }}>News Presenter</option>
                    <option value="Videographer" {{ old('position') == 'Videographer' ? 'selected' : '' }}>Videographer</option>
                    <option value="Video Editor" {{ old('position') == 'Video Editor' ? 'selected' : '' }}>Video Editor</option>
                    <option value="Technical Director" {{ old('position') == 'Technical Director' ? 'selected' : '' }}>Technical Director</option>
                </optgroup>
                <optgroup label="Other">
                    <option value="Editorial Assistant" {{ old('position') == 'Editorial Assistant' ? 'selected' : '' }}>Editorial Assistant</option>
                </optgroup>
            </select>
            @error('position')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="staff-form-group">
            <label for="program">Program</label>
            <input type="text" id="program" name="program" placeholder="e.g., BSIT, BSCS, BAJ, BMMA" value="{{ old('program') }}" required>
            @error('program')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="staff-form-group">
            <label for="year_section">Year & Section</label>
            <input type="text" id="year_section" name="year_section" placeholder="e.g., 3-C" value="{{ old('year_section') }}" required>
            @error('year_section')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
    </div>
    
    <div class="staff-form-actions">
        <button type="button" class="reset-data-btn" onclick="resetStaffForm()">Reset Data</button>
        <button type="submit" class="add-user-btn">
            Add Staff Member
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"/>
                <polyline points="12 5 19 12 12 19"/>
            </svg>
        </button>
    </div>
</form>

<div class="recently-added">
    <h3>Recently Added</h3>
    
    @if($recentStaff->count() > 0)
        <table class="recently-added-table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>CSPC Email</th>
                    <th>Position</th>
                    <th>Program</th>
                    <th>Year/Section</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentStaff as $staff)
                <tr>
                    <td>
                        <div class="staff-member">
                            <img src="{{ $staff->picture ? asset('storage/' . $staff->picture) : asset('images/avatar.jpg') }}" alt="{{ $staff->name }}" class="staff-avatar">
                            <span class="staff-name">{{ $staff->name }}</span>
                        </div>
                    </td>
                    <td>{{ $staff->email }}</td>
                    <td><span class="position-badge {{ strtolower(str_replace([' ', '&'], ['-', 'and'], $staff->position)) }}">{{ $staff->position }}</span></td>
                    <td>{{ $staff->program }}</td>
                    <td>{{ $staff->year_section }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center; color: #999; padding: 2rem;">No staff members added yet.</p>
    @endif
</div>

@push('scripts')
<script>
function resetStaffForm() {
    if (confirm('Are you sure you want to reset all data?')) {
        document.querySelector('.add-staff-form').reset();
        const uploadArea = document.getElementById('pictureUploadArea');
        uploadArea.innerHTML = `
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                <polyline points="17 8 12 3 7 8"/>
                <line x1="12" y1="3" x2="12" y2="15"/>
            </svg>
            <p>Choose a file or drag & drop here.</p>
            <small>(jpeg, png, jpg, gif - up to 100mb)</small>
            <button type="button" class="browse-btn">Browse Files</button>
        `;
    }
}

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
