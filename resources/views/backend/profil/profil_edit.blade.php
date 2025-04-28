@extends('backend.layouts.app')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <div class="w-12">
                            <img src="{{ $profile->avatar_url ? asset('storage/' . $profile->avatar_url) : asset('default-avatar.jpg') }}"
                                 alt="Avatar"
                                 style="max-width: 150px; max-height: 150px; object-fit: cover;">
                        </div>
                        <h3 class="mt-3">{{ Auth::user()->name }}</h3>
                        <p class="text-small">{{ Auth::user()->profile->bio }}</p>
                    </div>
                    
                </div>
            </div>
                        <!-- New Security Card for Password Confirmation -->
<div class="card mt-4">
    <div class="card-body">
        <h4 class="card-title">Konfirmasi Password</h4>
        <form action="{{ route('profil.update', $profile->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Pesan Kesalahan untuk Password Lama -->
            @if ($errors->has('current_password'))
                <div class="alert alert-danger">{{ $errors->first('current_password') }}</div>
            @endif

            <div class="form-group">
                <label for="current_password" class="form-label">Password Lama</label>
                <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Masukkan Password Lama" required>
            </div>

            <!-- Pesan Kesalahan untuk Password Baru -->
            @if ($errors->has('new_password'))
                <div class="alert alert-danger">{{ $errors->first('new_password') }}</div>
            @endif

            <div class="form-group">
                <label for="new_password" class="form-label">Password Baru</label>
                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Masukkan Password Baru" required>
            </div>

            <!-- Pesan Kesalahan untuk Konfirmasi Password -->
            @if ($errors->has('new_password_confirmation'))
                <div class="alert alert-danger">{{ $errors->first('new_password_confirmation') }}</div>
            @endif

            <div class="form-group">
                <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="Konfirmasi Password Baru" required>
            </div>

            <div class="form-group d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-danger">Ganti Password</button>
                <a href="https://wa.me/6285792336956?text=Lupa%20Password%20Lama%20Santri%20Saya%20Nama:%20{{ urlencode(Auth::user()->name) }}%20Role:%20{{ urlencode(Auth::user()->role) }}">Lupa Password Lama?</a>
            </div>
        </form>
    </div>
</div>

        </div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profil.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea name="bio" id="bio" class="form-control" placeholder="Write your bio">{{ $profile->bio }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone" value="{{ $profile->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="social_links" class="form-label">Social Links</label>
                            <textarea name="social_links" id="social_links" class="form-control" placeholder="Your Social Links">{{ $profile->social_links }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="avatar" class="form-label">Avatar</label>
                            <input type="file" name="avatar" id="avatar" class="form-control">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
