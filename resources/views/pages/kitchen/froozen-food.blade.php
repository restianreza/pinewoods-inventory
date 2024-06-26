@extends('layouts.master')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <h1>Froozen Food</h1>
            @if (session('success'))
                <div id="success-alert" class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div id="error-alert" class="alert alert-warning" role="alert">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>



    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Froozen Food</h6>
                <div>
                    <button data-bs-toggle="modal" data-bs-target="#create" class="btn btn-success btn-sm p-1 shadow-md">
                        <div class="d-flex justify-content-center align-items-center gap-1"><i
                                data-feather="plus-square"></i>
                        </div>
                    </button>
                </div>
            </div>

            <div id="create" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header" style="display: flex; justify-content: center;">
                            <h2 class="fw-medium fs-base">Tambah List Froozen Food</h2>
                        </div>

                        <!-- BEGIN: Modal Body -->
                        <form action="{{ route('create.froozen-food') }}" method="POST">
                            @csrf
                            <div class="modal-body row g-3">
                                <div class="col-12 col-sm-6">
                                    <label for="category" class="form-label">Kategori</label>
                                    <select id="category" name="category_id" class="form-select">
                                        <option disabled selected value="">Pilih Kategori</option>
                                        @foreach ($categories as $category)
                                            @php
                                                $isFroozenFoodRoute = Route::is('froozen-food');
                                                $isFroozenFoodCategory =
                                                    strtolower($category->category_name) === 'froozen food';
                                            @endphp
                                            @if (($isFroozenFoodRoute && $isFroozenFoodCategory) || (!$isFroozenFoodRoute && !$isFroozenFoodCategory))
                                                <option value="{{ $category->id }}" selected>{{ $category->category_name }}
                                                </option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="modalName" class="form-label">Nama Item</label>
                                    <input id="modalName" name="name" type="text" class="form-control"
                                        placeholder="....">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="modalDesc" class="form-label">Deskripsi</label>
                                    <input id="modalDesc" name="description" type="text" class="form-control"
                                        placeholder="....">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="modalQty" class="form-label">Jumlah</label>
                                    <input id="modalQty" name="quantity" type="number" class="form-control"
                                        placeholder="....">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="modalPrice" class="form-label">Harga (satuan)</label>
                                    <input id="modalPrice" name="price" type="number" class="form-control"
                                        placeholder="....">
                                </div>

                            </div>
                            <!-- END: Modal Body -->

                            <!-- BEGIN: Modal Footer -->
                            <div class="modal-footer text-end">
                                <button type="button" class="btn btn-outline-danger w-20 me-1"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-outline-success w-20">Simpan</button>
                            </div>
                            <!-- END: Modal Footer -->
                        </form>
                    </div>
                </div>
            </div>

            <div>
                <table id="myTable" class="table table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <td class="text-start">No</td>
                            <td class="text-start">Nama Barang</td>
                            <td class="text-start">Deskripsi</td>
                            <td class="text-start">Stok</td>
                            <td class="text-start">Harga(satuan)</td>
                            <td class="text-start">Tanggal Masuk</td>
                            <td class="text-start">More</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td class="text-start align-middle">{{ $loop->iteration }}</td>
                                <td class="text-start align-middle">{{ $item->name }}</td>
                                <td class="text-start align-middle">{{ $item->description }}</td>
                                <td class="text-start align-middle">{{ $item->quantity }}</td>
                                <td class="text-start align-middle">
                                    {{ 'Rp.' . number_format($item->price, 0, ',', '.') . ',-' }}</td>
                                <td class="text-start align-middle">
                                    {{ \Carbon\Carbon::parse($item->date_in)->translatedFormat('d F Y') }}</td>
                                <td class="text-start align-middle">
                                    <a class="btn btn-link" href="javascript:;" aria-expanded="false"
                                        data-bs-toggle="dropdown">
                                        <div class="d-flex justify-content-center align-items-center gap-1">
                                            <i data-feather="info"></i>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu p-2">
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <button data-toggle="tooltip" data-placement="top" title="Tambah Stok"
                                                data-bs-toggle="modal" data-bs-target="#itemIn-{{ $item->id }}"
                                                class="btn btn-success btn-sm p-1 shadow-md">
                                                <div class="d-flex justify-content-center align-items-center gap-1">
                                                    <i data-feather="plus-square"></i>
                                                </div>
                                            </button>
                                            <button data-toggle="tooltip" data-placement="top" title="Kurangi Stok"
                                                data-bs-toggle="modal" data-bs-target="#itemOut-{{ $item->id }}"
                                                class="btn btn-danger btn-sm p-1 shadow-md">
                                                <div class="d-flex justify-content-center align-items-center gap-1">
                                                    <i data-feather="minus-square"></i>
                                                </div>
                                            </button>
                                            <button data-toggle="tooltip" data-placement="top" title="Edit"
                                                data-bs-toggle="modal" data-bs-target="#edit-{{ $item->id }}"
                                                class="btn btn-primary btn-sm p-1 shadow-md">
                                                <div class="d-flex justify-content-center align-items-center gap-1">
                                                    <i data-feather="edit-3"></i>
                                                </div>
                                            </button>
                                            <button data-toggle="tooltip" data-placement="top" title="Hapus"
                                                data-bs-toggle="modal" data-bs-target="#delete-{{ $item->id }}"
                                                class="btn btn-danger btn-sm p-1 shadow-md">
                                                <div class="d-flex justify-content-center align-items-center gap-1">
                                                    <i data-feather="trash"></i>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            {{-- Modal for Edit --}}
                            <div id="edit-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header" style="display: flex; justify-content: center;">
                                            <h2 class="fw-medium fs-base">Edit {{ $item->name }}</h2>
                                        </div>
                                        <form action="{{ route('update.froozen-food', ['id' => $item->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('patch')
                                            <div class="modal-body d-flex justify-content-center align-items-center gap-2">
                                                <div class="col-12 col-sm-6">
                                                    <label for="modalName" class="form-label">Nama Item</label>
                                                    <input id="modalName" name="name"
                                                        value="{{ old('name', $item->name) }}" type="text"
                                                        class="form-control" placeholder="....">
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <label for="modalDesc" class="form-label">Deskripsi</label>
                                                    <input id="modalDesc" name="description"
                                                        value="{{ old('description', $item->description) }}"
                                                        type="text" class="form-control" placeholder="....">
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center align-items-center">
                                                <button type="button" class="btn btn-outline-danger w-20 me-1"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit"
                                                    class="btn btn-outline-success w-20">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal for itemIn -->
                            <div id="itemIn-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header" style="display: flex; justify-content: center;">
                                            <h2 class="fw-medium fs-base">{{ $item->name }}</h2>
                                        </div>
                                        <form action="{{ route('itemIn.froozen-food', ['id' => $item->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('patch')
                                            <div class="modal-body d-flex justify-content-center align-items-center">
                                                <div class="input-group">
                                                    <button type="button" class="btn btn-outline-danger"
                                                        id="minusBtnIn--{{ $item->id }}"
                                                        data-item-id="{{ $item->id }}" data-type="in">-</button>
                                                    <input id="modalQtyIn--{{ $item->id }}" name="quantity"
                                                        type="number" class="form-control" placeholder="input jumlah"
                                                        value="0">
                                                    <button type="button" class="btn btn-outline-success"
                                                        id="plusBtnIn--{{ $item->id }}"
                                                        data-item-id="{{ $item->id }}" data-type="in">+</button>
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center align-items-center">
                                                <button type="button" class="btn btn-outline-danger w-20 me-1"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit"
                                                    class="btn btn-outline-success w-20">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal for itemOut -->
                            <div id="itemOut-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header" style="display: flex; justify-content: center;">
                                            <h2 class="fw-medium fs-base">{{ $item->name }}</h2>
                                        </div>
                                        <form action="{{ route('itemOut.froozen-food', ['id' => $item->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('patch')
                                            <div class="modal-body d-flex justify-content-center align-items-center">
                                                <div class="input-group">
                                                    <button type="button" class="btn btn-outline-danger"
                                                        id="minusBtnOut--{{ $item->id }}"
                                                        data-item-id="{{ $item->id }}" data-type="out">-</button>
                                                    <input id="modalQtyOut--{{ $item->id }}" name="quantity"
                                                        type="number" class="form-control" placeholder="input jumlah"
                                                        value="0">
                                                    <button type="button" class="btn btn-outline-success"
                                                        id="plusBtnOut--{{ $item->id }}"
                                                        data-item-id="{{ $item->id }}" data-type="out">+</button>
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center align-items-center">
                                                <button type="button" class="btn btn-outline-danger w-20 me-1"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit"
                                                    class="btn btn-outline-success w-20">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- modal delete --}}
                            <div id="delete-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content">
                                        <form action="{{ route('destroy.showcase', ['id' => $item->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <div class="modal-body d-flex justify-content-center align-items-center">
                                                <div class="p-5 text-center">
                                                    <i
                                                        data-feather="x-circle"class="w-25 h-25 text-danger mx-auto mt-3"></i>
                                                    <div class="text-gray-600 mt-2">Apakah Anda benar ingin menghapus item
                                                        <strong>{{ $item->name }}</strong> ?
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <button type="button" data-bs-dismiss="modal"
                                                    class="btn btn-outline-secondary w-24 me-1">Batal</button> <button
                                                    type="submit" class="btn btn-danger w-24">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Sales Chart Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light text-center rounded p-4 h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Statistik Stok Perhari</h6>
                        <button id="showMonthlyButton"
                            class="btn btn-primary d-flex justify-content-center align-items-center">Perbulan <i
                                data-feather="chevrons-right"></i></button>
                    </div>
                    <canvas height="250" id="froozenFoodChart"></canvas>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6 hidden" id="monthlyContainer">
                <div class="bg-light text-center rounded p-4 h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Statistik Stok Perbulan</h6>
                        <button id="showDailyButton"
                            class="btn btn-primary d-flex justify-content-center align-items-center">Perhari <i
                                data-feather="chevrons-right"></i></button>
                    </div>
                    <canvas height="250" id="monthFroozenFoodChart"></canvas>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light text-center rounded p-4 h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Jumlah Stok</h6>
                    </div>
                    <canvas height="250" id="froozenFoodStok"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Sales Chart End -->

    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayat as $item)
                            <tr>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->user }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('jsPage')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function handleMinusClick(itemId, type) {
                const quantityInput = document.getElementById('modalQty' + type + '--' + itemId);
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 0) {
                    quantityInput.value = currentValue - 1;
                }
            }

            function handlePlusClick(itemId, type) {
                const quantityInput = document.getElementById('modalQty' + type + '--' + itemId);
                let currentValue = parseInt(quantityInput.value);
                quantityInput.value = currentValue + 1;
            }

            // Attach event listeners to all minus buttons
            document.querySelectorAll('[id^="minusBtnIn--"], [id^="minusBtnOut--"]').forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.dataset.itemId;
                    const type = this.dataset.type.charAt(0).toUpperCase() + this.dataset.type
                        .slice(1);
                    handleMinusClick(itemId, type);
                });
            });

            // Attach event listeners to all plus buttons
            document.querySelectorAll('[id^="plusBtnIn--"], [id^="plusBtnOut--"]').forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.dataset.itemId;
                    const type = this.dataset.type.charAt(0).toUpperCase() + this.dataset.type
                        .slice(1);
                    handlePlusClick(itemId, type);
                });
            });
        });

        $(document).ready(function() {
            var ctx1 = $("#froozenFoodChart").get(0).getContext("2d");

            // Pass PHP variables to JavaScript
            var labels = @json($histories->pluck('item_name'));
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
            var ctx1 = $("#monthFroozenFoodChart").get(0).getContext("2d");

            // Pass PHP variables to JavaScript
            var labels = @json($monthHistories->pluck('item_name'));
            var dataMasuk = @json($monthHistories->pluck('total_masuk'));
            var dataKeluar = @json($monthHistories->pluck('total_keluar'));

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

        document.addEventListener("DOMContentLoaded", function() {
            var ctx1 = document.getElementById("froozenFoodStok").getContext("2d");

            // Pass PHP variables to JavaScript
            var labels = @json($itemNames);
            var dataStok = @json($itemQuantities);

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

        document.getElementById('showMonthlyButton').addEventListener('click', function() {
            document.getElementById('monthlyContainer').classList.remove('hidden');
            document.getElementById('froozenFoodChart').parentElement.parentElement.classList.add('hidden');
        });

        document.getElementById('showDailyButton').addEventListener('click', function() {
            document.getElementById('monthlyContainer').classList.add('hidden');
            document.getElementById('froozenFoodChart').parentElement.parentElement.classList.remove('hidden');
        });
    </script>
@endsection
