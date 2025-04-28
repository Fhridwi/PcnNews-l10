@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Main Content Area -->
        <div class="col-lg-8">
          <!-- Article Header -->
            <article class="article-detail mb-5">
                <h1 class="article-title mb-3">{{ $article->title }}</h1>
                
                <div class="article-meta d-flex align-items-center mb-4">
                    <img src="{{ asset($article->profile->avatar_url ?? 'assets/compiled/jpg/2.jpg') }}" class="rounded-circle me-2" width="40" height="40" alt="Author">
                    <div>
                        <span class="fw-bold">{{ $article->author->name }}</span>
                        <div class="text-muted small">
                            <span>{{ \Carbon\Carbon::parse($article->published_at)->diffForHumans() }}</span> • 
                            @foreach ($article->categories as $c)
                            <span class="badge category-badge ">{{ $c->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="ms-auto">
                        <button class="btn btn-sm btn-outline-secondary me-1"><i class="far fa-bookmark"></i></button>
                        <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-share-alt"></i></button>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="article-featured-img mb-4">
                    <img src="{{ asset($article->cover_image_url) }}" class="img-fluid rounded" alt="Featured Image">
                </div>

                <!-- Article Content -->
                <div class="article-content">
                   {!! $article->content !!}
                </div>

                <!-- Article Footer -->
                <div class="article-footer mt-5 pt-4 border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="tags">
                            @foreach ($article->tags as $item)
                                <span class="badge bg-secondary me-1">#{{ $item->name }}</span>
                            @endforeach
                        </div>
                        <div class="social-share">
                            <button class="btn btn-sm btn-outline-primary me-1"><i class="fab fa-facebook-f"></i></button>
                            <button class="btn btn-sm btn-outline-info me-1"><i class="fab fa-twitter"></i></button>
                            <button class="btn btn-sm btn-outline-danger me-1"><i class="fab fa-instagram"></i></button>
                            <button class="btn btn-sm btn-outline-dark"><i class="fab fa-linkedin-in"></i></button>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Author Bio -->
            <div class="author-bio p-4 bg-light rounded mb-5">
                <div class="row">
                    <div class="col-md-2 text-center">
                        <img src="{{ asset($article->profile->avatar_url ?? 'assets/compiled/jpg/2.jpg') }}" class="rounded-circle mb-3 mb-md-0" width="80" height="80" alt="Author">
                    </div>
                    <div class="col-md-10">
                        <h4>{{ $article->author->name }}</h4>
                        <p>{{ $article->profile ? $article->profile->bio : 'Bio penulis tidak tersedia.' }}</p>
                        <a href="#" class="btn btn-sm btn-outline-success">View all articles</a>
                    </div>
                </div>
            </div>

            <!-- Related Articles -->
            <div class="related-articles mb-5">
                <h3 class="mb-4 pb-2 border-bottom">Artikel Terkait</h3>
                <div class="row">
                    @foreach ($relatedArticles as $item)
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('home.detail', $item->slug) }}" class="text-decoration-none">
                            <div class="card h-100">
                                <img src="{{ asset($item->cover_image_url) }}" class="card-img-top" alt="Related article">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->title }}</h5>
                                    <p class="card-text small text-muted">
                                        {{ $item->author->name }} • {{ \Carbon\Carbon::parse($item->published_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                </div>
            </div>

            <!-- Comments Section -->
            <div class="comments-section">
                <h3 class="mb-4 pb-2 border-bottom">Comments (3)</h3>
                
                <div class="comment-form mb-5">
                    <form>
                        <div class="mb-3">
                            <textarea class="form-control" rows="3" placeholder="Join the discussion..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Post Comment</button>
                    </form>
                </div>
                
                <div class="comment-list">
                    <div class="comment mb-4">
                        <div class="d-flex">
                            <img src="https://source.unsplash.com/random/50x50/?man" class="rounded-circle me-3" width="50" height="50" alt="User">
                            <div>
                                <h5 class="mb-1">Michael Chen</h5>
                                <div class="small text-muted mb-2">Posted 1 day ago</div>
                                <p>This is fascinating technology, but I worry about how companies might use this emotional data. Will there be regulations to prevent misuse?</p>
                                <button class="btn btn-sm btn-outline-secondary">Reply</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Newsletter Widget -->
            <div class="sidebar-widget mb-4 p-4 bg-light rounded">
                <h4 class="widget-title mb-3">Subscribe to Newsletter</h4>
                <p>Get the latest tech news delivered to your inbox</p>
                <form>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email Address">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Subscribe Now</button>
                </form>
            </div>

            <!-- Trending Now Widget -->
            <div class="sidebar-widget mb-4">
                <h4 class="widget-title mb-3">Trending Now</h4>
                <div class="list-group">
                    @foreach ($relatedArticles as $item)
                    <a href="{{ route('home.detail', $item->slug) }}" class="list-group-item list-group-item-action d-flex align-items-center">
                        <img src="{{ asset($item->cover_image_url) }}" class="me-3" width="60" height="45" alt="Trending">
                        <div>
                            <h6 class="mb-1">{{ $item->title }}</h6>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($item->published_at)->diffForHumans() }}</small>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Categories Widget -->
            <div class="sidebar-widget mb-4">
                <h4 class="widget-title mb-3">Categories</h4>
                <div class="list-group">
                    @foreach ($topCategories as $category)
                        <a href="" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            {{ $category->name }}
                            <span class="badge bg-success rounded-pill">
                                {{ $category->articles_count }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Popular Tags Widget -->
            <div class="sidebar-widget mb-4">
                <h4 class="widget-title mb-3">Popular Tags</h4>
                <div class="tags">
                   @foreach ($popularTags as $item)
                        <a href="{{ $item->slug }}" class="btn btn-sm btn-outline-secondary mb-2">#{{ $item->name }}</a>
                   @endforeach
                </div>
            </div>

            <!-- Ad Space -->
            <div class="sidebar-widget mb-4 text-center p-3 bg-light rounded">
                <h5 class="mb-3">Advertisement</h5>
                <img src="https://via.placeholder.com/300x250" class="img-fluid" alt="Advertisement">
                <p class="small mt-2 mb-0">Your Ad Could Be Here</p>
            </div>

            <!-- Follow Us Widget -->
            <div class="sidebar-widget">
                <h4 class="widget-title mb-3">Follow Us</h4>
                <div class="social-links">
                    <a href="#" class="btn btn-sm btn-outline-primary mb-2 w-100 text-start"><i class="fab fa-facebook-f me-2"></i> Facebook</a>
                    <a href="#" class="btn btn-sm btn-outline-info mb-2 w-100 text-start"><i class="fab fa-twitter me-2"></i> Twitter</a>
                    <a href="#" class="btn btn-sm btn-outline-danger mb-2 w-100 text-start"><i class="fab fa-instagram me-2"></i> Instagram</a>
                    <a href="#" class="btn btn-sm btn-outline-dark mb-2 w-100 text-start"><i class="fab fa-linkedin-in me-2"></i> LinkedIn</a>
                    <a href="#" class="btn btn-sm btn-outline-secondary w-100 text-start"><i class="fab fa-youtube me-2"></i> YouTube</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection