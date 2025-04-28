@extends('backend.layouts.app')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <div class="avatar avatar-5xl">
                            <img src="{{ asset('assets/compiled/jpg/2.jpg') }}" alt="Avatar">
                        </div>
                        <h3 class="mt-3">{{ Auth::user()->name }}</h3>
                        <p class="text-small">{{ Auth::user()->role }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profil.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Menampilkan pesan error jika ada -->
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea name="bio" id="bio" class="form-control" placeholder="Tulis bio Anda">{{ old('bio') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">Telepon</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Nomor Telepon Anda" value="{{ old('phone') }}">
                        </div>
                        <div class="form-group">
                            <label for="social_links" class="form-label">Tautan Sosial</label>
                            <textarea name="social_links" id="social_links" class="form-control" placeholder="Tautan Sosial Anda">{{ old('social_links') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="avatar" class="form-label">Avatar</label>
                            <input type="file" name="avatar" id="avatar" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
