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
                <h4 class="card-title mb-0">CREATE ARTICLE</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="summary" class="form-label">Ringkasan</label>
                        <textarea name="summary" class="form-control" id="summary" rows="3" required>{{ old('summary') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Konten</label>
                        <textarea name="content" class="form-control"  id="editor" rows="6" >{{ old('content') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="cover_image_url" class="form-label">Cover Image</label>
                        <input type="file" name="cover_image_url" class="form-control" id="cover_image_url">
                    </div>

                    <div class="mb-3">
                        <label for="publish_status" class="form-label">Status Publikasi</label>
                        <select name="publish_status" id="publish_status" class="form-select" required>
                            <option value="draft" {{ old('publish_status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('publish_status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('publish_status') == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="published_at" class="form-label">Tanggal Publikasi</label>
                        <input type="datetime-local" name="published_at" class="form-control" id="published_at"
                            value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}">
                    </div>

                    <div class="mb-3">
                        <label for="categories" class="form-label">Kategori</label>
                        <div class="d-flex flex-wrap">
                            @foreach ($categories as $category)
                                <div class="form-check me-3">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                                        id="category_{{ $category->id }}" class="form-check-input" 
                                        {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
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
                                        {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
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

