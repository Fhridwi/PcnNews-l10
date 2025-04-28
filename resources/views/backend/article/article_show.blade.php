@extends('backend.layouts.app')

@section('content')
<div class="row" id="table-striped">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Detail Artikel</h4>
                <a href="{{ route('article.index') }}" class="btn btn-sm btn-primary">← Kembali ke Daftar Artikel</a>
            </div>
            <div class="card-body">
                <div class="row">

                    <!-- Kolom Kiri -->
                    <div class="col-md-8">
                        <!-- Judul Artikel -->
                        <h2 class="fw-bold">{{ $article->title }}</h2>

                        <!-- Info Artikel -->
                        <div class="d-flex align-items-center text-muted mb-3">
                            <small>Ditulis oleh: {{ $article->author->name ?? 'Admin' }}</small>
                            <span class="mx-2">•</span>
                            <small>{{ $article->updated_at->format('d M Y') }}</small>
                        </div>

                        <!-- Article Image -->
                        <div class="mb-4">
                            <img 
                                src="{{ $article->cover_image_url ? asset($article->cover_image_url) : asset('images/default-cover.jpg') }}" 
                                alt="{{ $article->cover_image_url ? 'Cover Image' : 'Default Cover' }}" 
                                class="img-fluid rounded"
                            >
                        </div>

                        <!-- Konten Artikel -->
                        <div class="article-content">
                            {!! $article->content !!}
                        </div>

                        <!-- Edit and Delete Buttons -->
                        <div class="mt-4">
                            <a href="{{ route('article.edit', $article->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('article.destroy', $article->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this article?')">Delete</button>
                            </form>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-4">
                        <!-- Status Publish -->
                        <div class="mb-3">
                            <span class="badge 
                                @if($article->publish_status == 'published') bg-success
                                @elseif($article->publish_status == 'draft') bg-warning
                                @elseif($article->publish_status == 'archived') bg-secondary
                                @else bg-dark
                                @endif
                            ">
                                {{ ucfirst($article->publish_status) }}
                            </span>
                        </div>

                        <!-- Kategori (Jika Ada) -->
                        @if($article->categories && count($article->categories))
                        <div class="mb-4">
                            <h5><i class="fas fa-folder-open"></i> Kategori</h5>
                            @foreach($article->categories as $category)
                                <span class="badge bg-primary mb-1">{{ $category->name }}</span>
                            @endforeach
                        </div>
                        @endif

                        <!-- Tag (Jika Ada) -->
                        @if($article->tags && count($article->tags))
                        <div class="mb-4">
                            <h5><i class="fas fa-tags"></i> Tag</h5>
                            @foreach($article->tags as $tag)
                                <span class="badge bg-info mb-1">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                        @endif

                        <!-- Statistik -->
                        <div class="mb-4">
                            <h5><i class="fas fa-chart-bar"></i> Statistik</h5>
                            <p><i class="fas fa-eye"></i> {{ $article->view_count }} Views</p>
                        </div>

                        <!-- Tanggal Publish -->
                        @if($article->published_at)
                        <div class="mb-4">
                            <h5><i class="fas fa-calendar-alt"></i> Dipublikasikan</h5>
                            <p>{{ \Carbon\Carbon::parse($article->published_at)->format('d-m-Y H:i') }}</p>
                        </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
