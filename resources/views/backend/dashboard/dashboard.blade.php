@extends('backend.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Statistik Ringkas -->
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-journal-text" style="font-size: 3rem;"></i>
                <h5 class="mt-3 mb-1" style="font-size: 1.2rem;">Total Artikel</h5>
                <h2 class="font-weight-bold" id="totalArtikel">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </h2>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3 col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-file-earmark-check" style="font-size: 3rem;"></i>
                <h5 class="mt-3 mb-1" style="font-size: 1.2rem;">Published</h5>
                <h2 class="font-weight-bold" id="totalPublished">
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </h2>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3 col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-people" style="font-size: 3rem;"></i>
                <h5 class="mt-3 mb-1" style="font-size: 1.2rem;">User/Admin</h5>
                <h2 class="font-weight-bold" id="totalUser">
                    <div class="spinner-border text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </h2>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3 col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-tags" style="font-size: 3rem;"></i>
                <h5 class="mt-3 mb-1" style="font-size: 1.2rem;">Kategori</h5>
                <h2 class="font-weight-bold" id="totalKategori">
                    <div class="spinner-border text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Chart/Graph Section -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Grafik Artikel per Bulan</h4>
            </div>
            <div class="card-body">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data grafik...</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Grafik Artikel per Bulan</h4>
            </div>
            <div class="card-body">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data grafik...</p>
                </div>
            </div>
        </div>
    </div>

   
  
</div>

<div class="row">
    <!-- Quick Actions -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Quick Actions</h4>
            </div>
            <div class="card-body">
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Artikel Baru
                    </a>
                    <a href="#" class="btn btn-success">
                        <i class="bi bi-collection"></i> Kelola Kategori
                    </a>
                    <a href="#" class="btn btn-info">
                        <i class="bi bi-people"></i> Kelola User
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Artikel Terbaru -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>Artikel Terbaru</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 1; $i <= 13; $i++)
                            <tr>
                                <td>
                                    <div class="placeholder-wave">
                                        <span class="placeholder col-8"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="placeholder-wave">
                                        <span class="placeholder col-4"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="placeholder-wave">
                                        <span class="placeholder col-6"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="placeholder-wave">
                                        <span class="placeholder col-3"></span>
                                    </div>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- User Terakhir Login -->
    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-header">
                <h4>User Terakhir Login</h4>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @for($i = 1; $i <= 3; $i++)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="placeholder-wave">
                            <span class="placeholder col-5"></span>
                        </div>
                        <div class="spinner-grow spinner-grow-sm text-secondary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </li>
                    @endfor
                </ul>
            </div>
        </div>

        <!-- Aktivitas Terkini -->
        <div class="card">
            <div class="card-header">
                <h4>Aktivitas Terkini</h4>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @for($i = 1; $i <= 5; $i++)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="placeholder-wave w-100">
                            <span class="placeholder col-8 mb-1"></span>
                            <span class="placeholder col-4"></span>
                        </div>
                    </li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                document.getElementById('totalArtikel').innerHTML = "{{ $totalArtikel }}"
                document.getElementById('totalPublished').innerHTML = "{{ $totalPublished }}"
                document.getElementById('totalUser').innerHTML = "{{ $totalUser }}"
                document.getElementById('totalKategori').innerHTML = "{{ $totalKategori }}"
            })
        });
    </script>
@endpush