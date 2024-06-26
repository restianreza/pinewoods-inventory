@extends('layouts.master')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <h1>Page Categories</h1>
        </div>
    </div>
    <!-- BEGIN: Modal Content -->
    <div id="categorieAdd" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header" style="display: flex; justify-content: center;">
                    <h2 class="fw-medium fs-base">Tambah List Category</h2>
                </div>

                <!-- BEGIN: Modal Body -->
                <form action="{{ route('category.post') }}" method="POST">
                    <div class="modal-body grid columns-12 gap-4 gap-y-3">
                        @csrf
                        <div class="g-col-12 g-col-sm-6">
                            <input id="modal-form-nama" name="category_name" type="text" class="form-control"
                                placeholder="Nama Category">
                        </div>
                    </div>
                    <!-- END: Modal Body -->

                    <!-- BEGIN: Modal Footer -->
                    <div class="modal-footer text-end"> <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-danger w-20 me-1">Cancel</button> <button type="submit"
                            class="btn btn-outline-success w-20">Simpan</button>
                    </div>
                    <!-- END: Modal Footer -->
                </form>
            </div>
        </div>
    </div> <!-- END: Modal Content -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Categories</h6>
                <button data-bs-toggle="modal" data-bs-target="#categorieAdd" class="btn btn-primary btn-sm p-1 shadow-md">
                    <div class="d-flex justify-content-center align-items-center gap-1"><i data-feather="plus-square"></i>
                        <span>Add
                            Categories</span>
                    </div>
                </button>
            </div>

            <div>
                <table id="myTable" class="table table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <td class="text-start">No</td>
                            <td class="text-start">Category Name</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $item)
                            <tr>
                                <td class="text-start align-middle">{{ $loop->iteration }}</td>
                                <td class="text-start align-middle">{{ $item->category_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
