@extends('layouts.master')

@section('content')
    <!-- Sales Chart Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Statistik Stok Perhari</h6>
                    </div>
                    <canvas height="250" id="statistikStok"></canvas>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Jumlah Stok</h6>
                    </div>
                    <canvas height="250" id="jumlahStok"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Sales Chart End -->


    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h6 class="mb-0">Riwayat</h6>
                </div>
                <div>
                    <select id="kategoriHistory" class="form-select" onchange="filterKategori()">
                        <option disabled selected value="">Pilih Kategori History</option>
                        <option value="all" selected>Tampilkan Semua</option>
                        @foreach ($kategori as $category)
                            <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">admin</th>
                        </tr>
                    </thead>
                    <tbody id="data-table">
                        @foreach ($tabHis as $history)
                            <tr>
                                <td>{{ $history->description }}</td>
                                <td>{{ $history->action_category }}</td>
                                <td>{{ $history->date }}</td>
                                <td>{{ $history->user }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->


    <!-- Widgets Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex justify-content-center align-items-center">
            <div class="col-sm-12 col-md-12 col-xl-12">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Kalender</h6>
                    </div>
                    <div id="calender"></div>
                </div>
            </div>

        </div>
    </div>
    <!-- Widgets End -->


@section('jsPage')
    <script>
        $(document).ready(function() {
            var ctx1 = $("#statistikStok").get(0).getContext("2d");
            var labels = @json($histories->pluck('action_category'));
            var dataMasuk = @json($histories->pluck('total_masuk'));
            var dataKeluar = @json($histories->pluck('total_keluar'));

            var myChart1 = new Chart(ctx1, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                            label: "Jumlah Item Masuk",
                            data: dataMasuk,
                            backgroundColor: "rgba(60, 179, 113, 0.6)"
                        },
                        {
                            label: "Jumlah Item Keluar",
                            data: dataKeluar,
                            backgroundColor: "rgba(255, 0, 0, 0.6)"
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        $(document).ready(function() {
            var ctx1 = $("#jumlahStok").get(0).getContext("2d");
            var labels = @json($items->pluck('category_name'));
            var dataStok = @json($items->pluck('total_stok'));

            var myChart1 = new Chart(ctx1, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Jumlah Stok",
                        data: dataStok,
                        backgroundColor: "rgba(60, 179, 113, 0.6)"
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        function filterKategori() {
            var kategori = document.getElementById('kategoriHistory').value;
            var tbody = document.getElementById('data-table');
            var rows = tbody.getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
                var row = rows[i];
                var kategoryHistory = row.getElementsByTagName('td')[1]
                    .innerText; // Ubah indeks menjadi 1 jika `action_category` ada pada kolom kedua

                console.log('Selected category:', kategori);
                console.log('Row category:', kategoryHistory);

                if (kategori === 'all' || kategoryHistory === kategori) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }
    </script>
@endsection
@endsection
