@extends('frontend.layouts.app')

@section('content')
        {{-- <!-- Breaking News Section -->
        <div class="breaking-news">
            <div class="container d-flex align-items-center">
                <span class="breaking-news-label">BREAKING</span>
                <div class="marquee" style="animation: marquee 20s linear infinite;">
                    <span>• Global climate summit reaches historic agreement • Tech giant announces revolutionary AI assistant • National team advances to world cup finals • Stock market hits record high amid economic recovery • Scientists discover potential cure for rare disease</span>
                </div>
            </div>
        </div> --}}

        @php
        if (!function_exists('formatViews')) {
            function formatViews($views) {
                if ($views >= 1000000) {
                    return round($views / 1000000, 1) . 'M';
                } elseif ($views >= 1000) {
                    return round($views / 1000, 1) . 'K';
                } else {
                    return $views;
                }
            }
        }
        @endphp

    
        <!-- Hero Section -->
        <section class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mb-4 mb-lg-0">
                        <div class="hero-article">
                            <img src="{{ $latest_post->cover_image_url }}" class="hero-img w-100" alt="Featured article">
                            <div class="hero-overlay">
                                @foreach ($latest_post->categories as $c)
                                <span class="badge category-badge mb-2">{{ $c->name }}</span>
                                @endforeach
                                <h2 class="hero-title">{{ $latest_post->title }}</h2>
                                <p class="d-none d-md-block">{{ \Illuminate\Support\Str::limit($latest_post->summary, 118) }}</p>
                                <a href="{{ route('home.detail', $latest_post->slug) }}" class="btn btn-sm btn-success mt-2">Read More <i class="fas fa-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="sidebar-widget">
                            <h3 class="widget-title"><i class="fas fa-fire me-2"></i>Trending Now</h3>
                            @foreach ( $trending_articles as $item)
                            <div class="trending-item d-flex">
                                <img src="{{ $item->cover_image_url }}" class="trending-img me-3" alt="Trending article">
                                <div>
                                    <a href="{{ route('home.detail', $item->slug) }}" class="popular-post-title">{{ $item->title }}</a>
                                    <div class="popular-post-meta">
                                        {{ \Carbon\Carbon::parse($item->published_at)->diffForHumans() }}
                                        • {{ formatViews($item->view_count) }} views
                                    </div>
                                    
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
        <!-- Main Content -->
        <section class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Articles by Category -->
                        <div class="mb-5">
                            <h2 class="mb-4 d-flex align-items-center">
                                <span class="me-3">Latest News</span>
                                <span class="badge bg-success">Today</span>
                            </h2>
                            
                            @foreach ($recent_articles as $item)
                            <div class="article-item d-flex flex-column flex-md-row mb-4">
                                <img src="{{ $item->cover_image_url }}" class="article-img me-md-3 mb-2 mb-md-0" alt="{{ $item->title }}">
                                <div>
                                    <a href="{{ route('home.detail', $item->slug) }}" class="article-title">{{ $item->title }}</a>
                                    <div class="article-meta text-muted small mb-2">
                                        <span>By {{ $item->author->name ?? 'Unknown Author' }}</span> •
                                        <span>{{ \Carbon\Carbon::parse($item->published_at)->diffForHumans() }}</span> • 
                                        @if($item->categories->isNotEmpty())
                                            <span class="badge bg-success">{{ $item->categories->first()->name }}</span>
                                        @endif
                                    </div>
                        
                                    @if($item->tags && count($item->tags))
                                        <div class="tag-badges mb-2">
                                            @foreach($item->tags as $tag)
                                                <span class="badge bg-light text-dark border">{{ $tag->name }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                        
                                    <p class="article-excerpt">{{ \Illuminate\Support\Str::limit($item->summary, 150) }}</p>
                                    
                                    <a href="{{ route('article.show', $item->slug) }}" class="btn btn-sm btn-outline-success">Read More</a>
                                </div>
                            </div>
                        @endforeach     
                        </div>
                        <div class="pagination-wrapper">
                            {{ $recent_articles->links() }} 
                        </div>
                    </div>
                    
                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Search Widget -->
                        <div class="sidebar-widget mb-4">
                            <h3 class="widget-title"><i class="fas fa-search me-2"></i>Search</h3>
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search news...">
                                    <button class="btn btn-success" type="submit">Go</button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Popular Posts -->
                        <div class="sidebar-widget mb-4">
                            <h3 class="widget-title"><i class="fas fa-chart-line me-2"></i>Popular Posts</h3>
                            @foreach ($trending_articles as $post)
                                <div class="popular-post d-flex mb-3">
                                    <img src="{{ $post->cover_image_url }}" class="popular-post-img me-3" alt="Popular post">
                                    <div>
                                        <a href="{{ route('home.detail', $post->slug) }}" class="popular-post-title">{{ $post->title }}</a>
                                        <div class="popular-post-meta">
                                            <!-- Gunakan Carbon untuk format tanggal dengan format yang lebih spesifik -->
                                            <span>{{ \Carbon\Carbon::parse($post->published_at)->diffForHumans() }}</span> • 
                                            <span>{{ number_format($post->view_count) }} views</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        
                        <!-- Newsletter -->
                        <div class="sidebar-widget">
                            <h3 class="widget-title"><i class="fas fa-envelope me-2"></i>Newsletter</h3>
                            <p>Stay updated with our latest news and articles. Subscribe to our newsletter!</p>
                            <form>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Your Name">
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Your Email">
                                </div>
                                <button type="submit" class="btn btn-success w-100">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection