@extends('admin.layouts.dashboard')

@section('title', 'Drafts - TheSPARK Admin')
@section('page-title', 'Manage Drafts')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/posts.css') }}">
@endpush

@section('content')

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

@if($drafts->count() > 0)
    <div class="posts-grid">
        @foreach($drafts as $draft)
        <div class="post-card">
            <div class="post-card-header">
                <div>
                    <h3 class="post-card-title">{{ $draft->title }}</h3>
                    <div class="post-meta">
                        <span class="post-card-date">{{ \Carbon\Carbon::parse($draft->date)->format('M d, Y') }} • {{ \Carbon\Carbon::parse($draft->time)->format('g:i A') }}</span>
                        <span class="category-badge {{ strtolower(str_replace(['&', ' '], ['and', '-'], $draft->category->name)) }}">
                            {{ $draft->category->name }}
                        </span>
                        <span class="draft-badge">DRAFT</span>
                    </div>
                </div>
            </div>
            
            @if($draft->thumbnail)
                <div class="post-thumbnail">
                    <img src="{{ asset('storage/' . $draft->thumbnail) }}" alt="{{ $draft->title }}">
                </div>
            @endif
            
            <p class="post-card-excerpt">{{ Str::limit(strip_tags($draft->description), 150) }}</p>
            
            <div class="post-stats">
                <span class="reading-time">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        ircle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    {{ $draft->reading_time }} min read
                </span>
            </div>
            
            <div class="post-card-footer">
                <div class="post-author">
                    <img src="{{ $draft->author->photo_url }}" alt="{{ $draft->author->name }}">
                    <div class="author-details">
                        <h5>{{ $draft->author->name }}</h5>
                        <p>{{ $draft->author->email }}</p>
                    </div>
                </div>
                
                <div class="post-actions">
                    <form action="{{ route('admin.drafts.destroy', $draft->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this draft?');">
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
                    <form action="{{ route('admin.drafts.publish', $draft->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to publish this draft?');">
                        @csrf
                        <button type="submit" class="publish-now-btn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            Publish
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper">
        {{ $drafts->links() }}
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
        <h3>No Drafts Yet</h3>
        <p>Your saved drafts will appear here.</p>
    </div>
@endif

@endsection
