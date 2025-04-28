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
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Grafik View Artikel per Bulan</h4> 
            </div>
            <div class="card-body" style="position: relative; min-height: 250px;">
                <div id="chart-container" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data grafik...</p>
                </div>
                <canvas id="viewChart" style="display: none; width: 100%; height: 300px;"></canvas>
            </div>
        </div>
    </div>
    
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Grafik View Artikel per Bulan</h4> 
            </div>
            <div class="card-body" style="position: relative; min-height: 250px;">
                <div id="chart-container" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data grafik...</p>
                </div>
                {{-- <canvas id="articleChart" style="display: none; width: 100%; height: 300px;"></canvas> --}}
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
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="articleBody">
                            @for($i = 0; $i < 13; $i++)
                            <tr>
                                <td><div class="placeholder-wave"><span class="placeholder col-8"></span></div></td>
                                <td><div class="placeholder-wave"><span class="placeholder col-4"></span></div></td>
                                <td><div class="placeholder-wave"><span class="placeholder col-6"></span></div></td>
                                <td><div class="placeholder-wave"><span class="placeholder col-3"></span></div></td>
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
                    @forelse ($users as $user)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $user->name }} - {{ $user->email }}</span>
                            <span class="badge bg-secondary">{{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}</span>
                        </li>
                    @empty
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
                    @endforelse
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
        fetch("{{ url('admin/dashboard/stats') }}")
            .then(response => response.json())
            .then(data => {
                document.getElementById('totalArtikel').innerHTML = data.totalArtikel;
                document.getElementById('totalPublished').innerHTML = data.totalPublished;
                document.getElementById('totalUser').innerHTML = data.totalUser;
                document.getElementById('totalKategori').innerHTML = data.totalKategori;
            })
            .catch(error => console.error('Error fetching dashboard stats:', error));
    }, 100);
});
    </script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    fetch("{{ route('chart.data') }}")
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('viewChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Jumlah View',
                        data: data.values,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        borderRadius: 5,
                        barThickness: 30,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            document.getElementById('chart-container').style.display = 'none'; // hide spinner
            document.getElementById('viewChart').style.display = 'block'; // show canvas
        })
        .catch(error => {
            console.error('Error fetching chart data:', error);
            document.getElementById('chart-container').innerHTML = '<p class="text-danger">Gagal memuat grafik.</p>';
        });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch("{{ route('chart.articles') }}") // Ganti dengan route kamu
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('articleChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels, // contoh: ["Januari", "Februari", "Maret", ...]
                        datasets: [{
                            label: 'Jumlah Artikel',
                            data: data.data, // contoh: [5, 8, 12, 7, ...]
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            borderRadius: 5,
                            barThickness: 30,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
    
                document.getElementById('chart-container').style.display = 'none'; 
                document.getElementById('articleChart').style.display = 'block';
            })
            .catch(error => {
                console.error('Error fetching chart data:', error);
                document.getElementById('chart-container').innerHTML = '<p class="text-danger">Gagal memuat grafik.</p>';
            });
    });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('articles/fetch')
            .then(response => response.json())
            .then(data => {
                let tbody = document.getElementById('articleBody');
                tbody.innerHTML = ''; // Hapus skeleton loader
    
                if (data.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="4" class="text-center">Tidak ada artikel.</td></tr>`;
                } else {
                    data.forEach(article => {
                        tbody.innerHTML += `
                            <tr>
                                <td>${article.title}</td>
                                <td>${article.publish_status}</td>
                                <td>${new Date(article.published_at).toLocaleDateString('id-ID')}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary">Detail</a>
                                </td>
                            </tr>
                        `;
                    });
                }
            })
            .catch(error => {
                console.error('Gagal mengambil data:', error);
                let tbody = document.getElementById('articleBody');
                tbody.innerHTML = `<tr><td colspan="4" class="text-center text-danger">Gagal memuat data.</td></tr>`;
            });
    });
    </script>
    

<script>
    $(document).ready(function() {
     $('#dataTable').DataTable();
 });
</script>

@endpush