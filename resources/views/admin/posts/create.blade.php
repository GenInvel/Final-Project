@extends('admin.layouts.dashboard')

@section('title', 'New Post - TheSPARK Admin')

@section('page-title', 'New Post')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/posts.css') }}">
<style>
    .admin-main {
        padding: 2rem 1rem !important;
    }
</style>
@endpush

@section('content')
<form class="post-form" action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <!-- Title -->
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Start the headline here" value="{{ old('title') }}" required>
        @error('title')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <!-- Date and Time -->
    <div class="form-row">
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" value="{{ old('date', now()->setTimezone('Asia/Manila')->format('Y-m-d')) }}" required>
            @error('date')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="time">Time</label>
            <input type="time" id="time" name="time" value="{{ old('time', now()->setTimezone('Asia/Manila')->format('H:i')) }}" required>
            @error('time')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- Author and Category -->
    <div class="form-row">
        <div class="form-group">
            <label for="author">Author</label>
            <select id="author" name="author_id" required>
                <option value="">Select Author</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                        {{ $author->name }} - {{ $author->position }}
                    </option>
                @endforeach
            </select>
            @error('author_id')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- Contributor -->
    <div class="form-group">
        <label for="contributor">Select Contributor</label>
        <select id="contributor" name="photojournalist_id">
            <option value="">Select Contributor</option>
            @foreach($contributors as $contributor)
                <option value="{{ $contributor->id }}" {{ old('photojournalist_id') == $contributor->id ? 'selected' : '' }}>
                    {{ $contributor->name }} - {{ $contributor->position }}
                </option>
            @endforeach
        </select>
        @error('photojournalist_id')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <!-- Thumbnail -->
    <div class="form-group">
        <label>Thumbnail</label>
        <div class="thumbnail-upload" id="thumbnailUploadArea" onclick="document.getElementById('thumbnailInput').click()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
            </svg>
            <p>Choose a file or drag & drop here</p>
            <small>(jpeg, png - up to 500mb)</small>
            <button type="button" class="browse-btn" onclick="event.stopPropagation();">Browse Files</button>
        </div>
        <input type="file" id="thumbnailInput" name="thumbnail" accept="image/*" style="display: none;" required>
        <div id="thumbnailPreview" style="display: none; margin-top: 1rem; text-align: center;">
            <img id="thumbnailPreviewImage" src="" alt="Preview" style="max-width: 300px; border-radius: 8px; border: 3px solid var(--primary-color);">
            <p id="thumbnailFileName" style="margin-top: 0.5rem; font-size: 0.9rem; font-weight: 600; color: var(--primary-color);"></p>
        </div>
        @error('thumbnail')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <!-- Description/Content -->
    <div class="form-group">
        <label for="description">Description</label>
        <div class="editor-toolbar">
            <button type="button" class="editor-btn" onclick="formatText('bold')" title="Bold"><strong>B</strong></button>
            <button type="button" class="editor-btn" onclick="formatText('italic')" title="Italic"><em>I</em></button>
            <button type="button" class="editor-btn" onclick="formatText('underline')" title="Underline"><u>U</u></button>
            <button type="button" class="editor-btn" onclick="formatText('insertUnorderedList')" title="Bullet List">≡</button>
            <button type="button" class="editor-btn" onclick="formatText('insertOrderedList')" title="Numbered List">≣</button>
            <button type="button" class="editor-btn" onclick="formatText('undo')" title="Undo">↶</button>
            <button type="button" class="editor-btn" onclick="formatText('redo')" title="Redo">↷</button>
        </div>
        <div class="editor-content" id="editor" contenteditable="true" data-placeholder="Write your article content here...">{{ old('description') }}</div>
        <input type="hidden" name="description" id="description">
        @error('description')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <!-- Article Image (Single Upload) -->
    <div class="form-group">
        <label>Article Image (Optional)</label>
        <div class="article-image-upload" id="articleImageUploadArea" onclick="document.getElementById('articleImageInput').click()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
            </svg>
            <p>Choose a file or drag & drop here</p>
            <small>(jpeg, png - up to 500mb)</small>
            <button type="button" class="browse-btn" onclick="event.stopPropagation();">Browse Files</button>
        </div>
        <input type="file" id="articleImageInput" name="article_image" accept="image/*" style="display: none;">
        <div id="articleImagePreview" style="display: none; margin-top: 1rem; text-align: center;">
            <img id="articleImagePreviewImage" src="" alt="Preview" style="max-width: 300px; border-radius: 8px; border: 3px solid var(--primary-color);">
            <p id="articleImageFileName" style="margin-top: 0.5rem; font-size: 0.9rem; font-weight: 600; color: var(--primary-color);"></p>
        </div>
        @error('article_image')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <!-- Form Actions -->
    <div class="form-actions">
        <button type="button" class="reset-btn" onclick="resetForm()">Reset Data</button>
        <button type="submit" class="publish-btn">Publish Now →</button>
    </div>
</form>

@push('scripts')
<script>
// Auto-update time every second (Philippines timezone)
setInterval(function() {
    const now = new Date();
    const philippinesTime = new Date(now.toLocaleString('en-US', { timeZone: 'Asia/Manila' }));
    const hours = String(philippinesTime.getHours()).padStart(2, '0');
    const minutes = String(philippinesTime.getMinutes()).padStart(2, '0');
    document.getElementById('time').value = `${hours}:${minutes}`;
}, 1000);

// Format text in editor
function formatText(command) {
    document.execCommand(command, false, null);
    document.getElementById('editor').focus();
}

// Thumbnail preview
document.getElementById('thumbnailInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Validate file size (500MB max)
        if (file.size > 500 * 1024 * 1024) {
            alert('File size must be less than 500MB');
            this.value = '';
            return;
        }

        // Validate file type
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!validTypes.includes(file.type)) {
            alert('Please upload a valid image file (JPEG, PNG)');
            this.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('thumbnailPreviewImage').src = e.target.result;
            document.getElementById('thumbnailFileName').textContent = file.name;
            document.getElementById('thumbnailPreview').style.display = 'block';
            
            // Hide upload area content
            const uploadArea = document.getElementById('thumbnailUploadArea');
            uploadArea.style.padding = '1rem';
            uploadArea.querySelector('svg').style.display = 'none';
            uploadArea.querySelector('p').style.display = 'none';
            uploadArea.querySelector('small').style.display = 'none';
            uploadArea.querySelector('button').style.display = 'none';
        }
        reader.readAsDataURL(file);
    }
});

// Article image preview (Single image)
document.getElementById('articleImageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Validate file size (500MB max)
        if (file.size > 500 * 1024 * 1024) {
            alert('File size must be less than 500MB');
            this.value = '';
            return;
        }

        // Validate file type
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!validTypes.includes(file.type)) {
            alert('Please upload a valid image file (JPEG, PNG)');
            this.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('articleImagePreviewImage').src = e.target.result;
            document.getElementById('articleImageFileName').textContent = file.name;
            document.getElementById('articleImagePreview').style.display = 'block';
            
            // Hide upload area content
            const uploadArea = document.getElementById('articleImageUploadArea');
            uploadArea.style.padding = '1rem';
            uploadArea.querySelector('svg').style.display = 'none';
            uploadArea.querySelector('p').style.display = 'none';
            uploadArea.querySelector('small').style.display = 'none';
            uploadArea.querySelector('button').style.display = 'none';
        }
        reader.readAsDataURL(file);
    }
});

// Save editor content to hidden input before submit
document.querySelector('.post-form').addEventListener('submit', function(e) {
    const editorContent = document.getElementById('editor').innerHTML;
    document.getElementById('description').value = editorContent;
});

// Reset form
function resetForm() {
    if (confirm('Are you sure you want to reset all data?')) {
        document.querySelector('.post-form').reset();
        document.getElementById('editor').innerHTML = '';
        document.getElementById('thumbnailPreview').style.display = 'none';
        document.getElementById('articleImagePreview').style.display = 'none';
        
        // Reset upload areas
        const thumbnailArea = document.getElementById('thumbnailUploadArea');
        thumbnailArea.style.padding = '2.5rem';
        thumbnailArea.querySelector('svg').style.display = 'block';
        thumbnailArea.querySelector('p').style.display = 'block';
        thumbnailArea.querySelector('small').style.display = 'block';
        thumbnailArea.querySelector('button').style.display = 'inline-block';
        
        const articleArea = document.getElementById('articleImageUploadArea');
        articleArea.style.padding = '2.5rem';
        articleArea.querySelector('svg').style.display = 'block';
        articleArea.querySelector('p').style.display = 'block';
        articleArea.querySelector('small').style.display = 'block';
        articleArea.querySelector('button').style.display = 'inline-block';
    }
}

// Drag and drop for thumbnail
const thumbnailArea = document.getElementById('thumbnailUploadArea');
thumbnailArea.addEventListener('dragover', function(e) {
    e.preventDefault();
    e.stopPropagation();
    this.style.borderColor = 'var(--secondary-color)';
    this.style.background = 'rgba(26, 115, 232, 0.05)';
});

thumbnailArea.addEventListener('dragleave', function(e) {
    e.preventDefault();
    e.stopPropagation();
    this.style.borderColor = 'var(--border-color)';
    this.style.background = 'var(--bg-light)';
});

thumbnailArea.addEventListener('drop', function(e) {
    e.preventDefault();
    e.stopPropagation();
    this.style.borderColor = 'var(--border-color)';
    this.style.background = 'var(--bg-light)';
    
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        document.getElementById('thumbnailInput').files = dataTransfer.files;
        document.getElementById('thumbnailInput').dispatchEvent(new Event('change'));
    } else {
        alert('Please drop an image file');
    }
});

// Drag and drop for article image
const articleArea = document.getElementById('articleImageUploadArea');
articleArea.addEventListener('dragover', function(e) {
    e.preventDefault();
    e.stopPropagation();
    this.style.borderColor = 'var(--secondary-color)';
    this.style.background = 'rgba(26, 115, 232, 0.05)';
});

articleArea.addEventListener('dragleave', function(e) {
    e.preventDefault();
    e.stopPropagation();
    this.style.borderColor = 'var(--border-color)';
    this.style.background = 'var(--bg-light)';
});

articleArea.addEventListener('drop', function(e) {
    e.preventDefault();
    e.stopPropagation();
    this.style.borderColor = 'var(--border-color)';
    this.style.background = 'var(--bg-light)';
    
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        document.getElementById('articleImageInput').files = dataTransfer.files;
        document.getElementById('articleImageInput').dispatchEvent(new Event('change'));
    } else {
        alert('Please drop an image file');
    }
});
</script>
@endpush
@endsection
