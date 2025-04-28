@extends('backend.layouts.app')

@section('content')
<div class="row" id="table-striped">
    <div class="col-12">
        <div class="card">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">EDIT ARTICLE</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $article->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="summary" class="form-label">Ringkasan</label>
                        <textarea name="summary" class="form-control" id="summary" rows="3" required>{{ old('summary', $article->summary) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Konten</label>
                        <textarea name="content" class="form-control" id="content" rows="6" required>{{ old('content', $article->content) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="cover_image_url" class="form-label">Cover Image</label>
                        <input type="file" name="cover_image_url" class="form-control" id="cover_image_url">
                        @if($article->cover_image_url)
                            <div class="mt-2">
                                <img src="{{ asset($article->cover_image_url) }}" alt="Cover Image" width="150">
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="publish_status" class="form-label">Status Publikasi</label>
                        <select name="publish_status" id="publish_status" class="form-select" required>
                            <option value="draft" {{ old('publish_status', $article->publish_status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('publish_status', $article->publish_status) == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('publish_status', $article->publish_status) == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="published_at" class="form-label">Tanggal Publikasi</label>
                        <input type="datetime-local" name="published_at" class="form-control" id="published_at"
                            value="{{ old('published_at', $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}">
                    </div>

                    <div class="mb-3">
                        <label for="categories" class="form-label">Kategori</label>
                        <div class="d-flex flex-wrap">
                            @foreach ($categories as $category)
                                <div class="form-check me-3">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                                        id="category_{{ $category->id }}" class="form-check-input" 
                                        {{ $article->categories->contains($category->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="category_{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">Tag</label>
                        <div class="d-flex flex-wrap">
                            @foreach ($tags as $tag)
                                <div class="form-check me-3">
                                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                                        id="tag_{{ $tag->id }}" class="form-check-input" 
                                        {{ $article->tags->contains($tag->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tag_{{ $tag->id }}">
                                        {{ $tag->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan Artikel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- CKEditor for Content --}}
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>

{{-- Optional: Select2 for better tag/category UX --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#tags').select2({ placeholder: "Pilih tag", allowClear: true });
    $('#categories').select2({ placeholder: "Pilih kategori", allowClear: true });
</script>
@endsection
