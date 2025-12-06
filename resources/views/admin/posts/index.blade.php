@extends('admin.layouts.dashboard')

@section('title', 'Manage Posts - TheSPARK Admin')
@section('page-title', 'Manage Posts')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/posts.css') }}">
@endpush

@section('content')

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

@if($posts->count() > 0)
    <div class="posts-grid">
        @foreach($posts as $post)
        <div class="post-card">
            <div class="post-card-header">
                <div>
                    <h3 class="post-card-title">{{ $post->title }}</h3>
                    <div class="post-meta">
                        <span class="post-card-date">{{ \Carbon\Carbon::parse($post->date)->format('M d, Y') }} • {{ \Carbon\Carbon::parse($post->time)->format('g:i A') }}</span>
                        <span class="category-badge {{ strtolower(str_replace(['&', ' '], ['and', '-'], $post->category->name)) }}">
                            {{ $post->category->name }}
                        </span>
                    </div>
                </div>
            </div>
            
            @if($post->thumbnail)
                <div class="post-thumbnail">
                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}">
                </div>
            @endif
            
            <p class="post-card-excerpt">{{ Str::limit(strip_tags($post->description), 150) }}</p>
            
            <div class="post-stats">
                <span class="reading-time">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        ircle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    {{ $post->reading_time }} min read
                </span>
            </div>
            
            <div class="post-card-footer">
                <div class="post-author">
                    <img src="{{ $post->author->photo_url }}" alt="{{ $post->author->name }}">
                    <div class="author-details">
                        <h5>{{ $post->author->name }}</h5>
                        <p>{{ $post->author->email }}</p>
                    </div>
                </div>
                
                <div class="post-actions">
                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to move this post to trash?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"/>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                            </svg>
                            Delete
                        </button>
                    </form>
                    <a href="{{ route('admin.posts.edit', $post) }}" class="edit-btn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        Edit Post
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper">
        {{ $posts->links() }}
    </div>
@else
    <div class="empty-state">
        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
            <polyline points="14 2 14 8 20 8"/>
            <line x1="16" y1="13" x2="8" y2="13"/>
            <line x1="16" y1="17" x2="8" y2="17"/>
            <polyline points="10 9 9 9 8 9"/>
        </svg>
        <h3>No Posts Yet</h3>
        <p>Start creating your first post to see it here.</p>
        <a href="{{ route('admin.posts.create') }}" class="create-first-btn">Create Your First Post</a>
    </div>
@endif

@endsection
