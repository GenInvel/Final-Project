@extends('admin.layouts.dashboard')

@section('title', 'Trash - TheSPARK Admin')
@section('page-title', 'Trash')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/posts.css') }}">
@endpush

@section('content')

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

@if($trashedPosts->count() > 0)
    <div class="posts-grid">
        @foreach($trashedPosts as $trash)
        <div class="post-card">
            <div class="post-card-header">
                <div>
                    <h3 class="post-card-title">{{ $trash->title }}</h3>
                    <div class="post-meta">
                        <span class="post-card-date">{{ \Carbon\Carbon::parse($trash->date)->format('M d, Y') }} • {{ \Carbon\Carbon::parse($trash->time)->format('g:i A') }}</span>
                        <span class="category-badge {{ strtolower(str_replace(['&', ' '], ['and', '-'], $trash->category->name)) }}">
                            {{ $trash->category->name }}
                        </span>
                    </div>
                </div>
            </div>
            
            @if($trash->thumbnail)
                <div class="post-thumbnail">
                    <img src="{{ asset('storage/' . $trash->thumbnail) }}" alt="{{ $trash->title }}">
                </div>
            @endif
            
            <p class="post-card-excerpt">{{ Str::limit(strip_tags($trash->description), 150) }}</p>
            
            <div class="post-stats">
                <span class="reading-time">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    {{ $trash->reading_time }} min read
                </span>
            </div>
            
            <div class="post-card-footer">
                <div class="post-author">
                    <img src="{{ $trash->author->photo_url }}" alt="{{ $trash->author->name }}">
                    <div class="author-details">
                        <h5>{{ $trash->author->name }}</h5>
                        <p>{{ $trash->author->email }}</p>
                    </div>
                </div>
                
                <div class="post-actions">
                    <form action="{{ route('admin.trash.destroy', $trash->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to permanently delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"/>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                            </svg>
                            Delete Forever
                        </button>
                    </form>
                    <form action="{{ route('admin.trash.restore', $trash->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="edit-btn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="1 4 1 10 7 10"/>
                                <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/>
                            </svg>
                            Restore
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper">
        {{ $trashedPosts->links() }}
    </div>
@else
    <div class="empty-state">
        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="3 6 5 6 21 6"/>
            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
        </svg>
        <h3>Trash is Empty</h3>
        <p>No deleted posts in trash.</p>
    </div>
@endif

@endsection
