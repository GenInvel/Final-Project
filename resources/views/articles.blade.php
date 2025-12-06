@extends('layouts.app')

@section('title', 'Article - TheSPARK')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/articles.css') }}">
@endpush

@section('content')
<div class="article-page">
    <div class="article-container">
        <div class="article-main">
            <div class="article-header">
                <span class="article-category">News</span>
                <span class="article-date">September 13, 2025</span>
            </div>
            
            <h1 class="article-title">The Headline of the Article should go here</h1>
            
            <div class="article-share">
                <span>Share</span>
                <div class="share-buttons">
                    <button class="share-btn facebook" title="Share on Facebook">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </button>
                    <button class="share-btn threads" title="Share on Threads">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 14.586c-.37 1.516-1.754 2.656-3.294 2.656-1.54 0-2.924-1.14-3.294-2.656h6.588z"/>
                        </svg>
                    </button>
                    <button class="share-btn twitter" title="Share on Twitter">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </button>
                    <button class="share-btn email" title="Share via Email">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            @auth
            <button class="favorite-btn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
                Add to Favorites
            </button>
            @endauth
            
            <div class="article-featured-image">
                <img src="{{ asset('images/placeholder-article.jpg') }}" alt="Article">
            </div>
            <p class="image-credit"><i>photos by Johnrey Frongoso/TheSPARK</i></p>

            <div class="article-body">
                <p>The description here should open with a clear and engaging introduction. This part is meant to spark interest and give readers an immediate sense of what the article is about, without revealing everything right away. It can set the tone, hint at the subject, or provide context that draws readers in further.</p>
                
                <p>This section should expand on the idea introduced above. Add more background, context, or key details that help establish the importance of the topic. Think of this as the space to build momentum, provide a little depth, and connect the reader to the subject at hand. Keep it engaging and relevant to the article's central message.</p>
                
                <p>The closing preview should leave a strong impression. You may emphasize the relevance of the story, highlight what readers can gain, or suggest what awaits them in the full version. The goal here is to maintain interest and encourage them to continue reading beyond the preview itself.</p>
            </div>
            
            <div class="article-author">
                <h3>Written by:</h3>
                <div class="author-card">
                    <img src="{{ asset('images/default-avatar.png') }}" alt="Author" class="author-avatar">
                    <div class="author-info">
                        <h4>Writer's Full Name</h4>
                        <p class="author-position">Position</p>
                        <p class="author-email">writer@thesparkpub.cspc.edu.ph</p>
                    </div>
                </div>
            </div>
            
            <div class="article-comments">
                <h3>Comments</h3>
                @auth
                <form class="comment-form">
                    <input type="text" placeholder="Share your insights..." class="comment-input">
                    <button type="submit" class="comment-btn">Comment</button>
                </form>
                @else
                <p class="comment-login-prompt">Please <a href="#" onclick="openAuthModal()">log in</a> to comment.</p>
                @endauth
            </div>
            
            <section class="related-posts">
                <h2>Related Posts</h2>
                <p class="section-subtitle">You might like to read these posts</p>
                
                <div class="related-grid">
                    @for($i = 0; $i < 3; $i++)
                    <article class="article-card">
                        <div class="article-image">
                            <span class="article-category">News</span>
                            <img src="{{ asset('images/placeholder-article.jpg') }}" alt="Article">
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
            </section>
        </div>
        
        <aside class="article-sidebar">
            <div class="sidebar-section">
                <h3>Top Stories</h3>
                <p class="sidebar-subtitle">You might like to read these posts</p>
                
                <div class="top-stories">
                    @for($i = 1; $i <= 3; $i++)
                    <article class="top-story">
                        <div class="top-story-image">
                            <span class="article-category">Opinion</span>
                            <img src="{{ asset('images/placeholder-article.jpg') }}" alt="Article">
                        </div>
                        <div class="top-story-content">
                            <span class="story-number">0{{ $i }}</span>
                            <h4>The Headline</h4>
                            <p>The body of the article should open with small, captivating story or a personal anecdote.</p>
                            <div class="story-meta">
                                <span class="story-date">September 13, 2025</span>
                                <a href="{{ url('/articles/1') }}" class="read-more">Read More</a>
                            </div>
                        </div>
                    </article>
                    @endfor
                </div>
            </div>
            
            <div class="sidebar-section">
                <h3>Categories</h3>
                <div class="category-tags">
                    <a href="{{ url('/categories/news') }}" class="category-tag">News</a>
                    <a href="{{ url('/categories/opinion') }}" class="category-tag">Opinion</a>
                    <a href="{{ url('/categories/sports') }}" class="category-tag">Sports</a>
                    <a href="{{ url('/categories/feature') }}" class="category-tag">Feature</a>
                    <a href="{{ url('/categories/scitech') }}" class="category-tag">Sci&Tech</a>
                    <a href="{{ url('/categories/literary') }}" class="category-tag">Literary</a>
                    <a href="{{ url('/categories/devcom') }}" class="category-tag">DevCom</a>
                </div>
            </div>
        </aside>
    </div>
    
    <button class="back-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
        Back to Top →
    </button>
</div>
@endsection