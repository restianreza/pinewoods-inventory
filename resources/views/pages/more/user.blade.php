@extends('layouts.master')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <h1>user-management</h1>
        </div>
    </div>

    {{-- Modal for add user --}}
    <div id="userAdd" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header" style="display: flex; justify-content: center;">
                    <h2 class="fw-medium fs-base">Tambah User</h2>
                </div>

                <!-- BEGIN: Modal Body -->
                <form action="{{ route('user.create') }}" method="POST">
                    <div class="modal-body grid g-3">
                        @csrf
                        <div>
                            <label class="form-label" for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div>
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div>
                            <label class="form-label" for="role">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
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
    </div>


    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-end mb-2">
                <button data-bs-toggle="modal" data-bs-target="#userAdd" class="btn btn-primary btn-sm p-1 shadow-md">
                    <div class="d-flex justify-content-center align-items-center gap-1"><i data-feather="plus-square"></i>
                        <span>Add
                            User</span>
                    </div>
                </button>
            </div>

            <div>
                <table id="myTable" class="table table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <th class="text-start">No</th>
                            <th class="text-start">Username</th>
                            <th class="text-start">Email</th>
                            <th class="text-start">Role</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                            <tr>
                                <td class="text-start align-middle">{{ $loop->iteration }}</td>
                                <td class="text-start align-middle">{{ $item->name }}</td>
                                <td class="text-start align-middle">{{ $item->email }}</td>
                                <td class="text-start align-middle">{{ $item->role }}</td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-link" href="javascript:;" aria-expanded="false"
                                        data-bs-toggle="dropdown">
                                        <div class="d-flex justify-content-center align-items-center gap-1">
                                            <i data-feather="info"></i>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu p-1">
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <button data-toggle="tooltip" data-placement="top" title="Edit"
                                                data-bs-toggle="modal" data-bs-target="#edit-{{ $item->id }}"
                                                class="btn btn-success btn-sm p-1 shadow-md">
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

                            {{-- modal edit --}}
                            <div id="edit-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header" style="display: flex; justify-content: center;">
                                            <h2 class="fw-medium fs-base">Edit {{ $item->name }}</h2>
                                        </div>
                                        <form action="{{ route('user.update', ['id' => $item->id]) }}" method="POST">
                                            <div class="modal-body row gap-3">
                                                @csrf
                                                @method('patch')
                                                <div>
                                                    <label for="modal-edit-name" class="form-label">Nama</label>
                                                    <input id="modal-edit-name" name="name"
                                                        value="{{ old('name', $item->name) }}" type="text"
                                                        class="form-control" placeholder="....">
                                                </div>

                                                <div>
                                                    <label for="modal-edit-email" class="form-label">Deskripsi</label>
                                                    <input id="modal-edit-email" name="email"
                                                        value="{{ old('email', $item->email) }}" type="text"
                                                        class="form-control" placeholder="....">
                                                </div>

                                                <div>
                                                    <label class="form-label" for="role">Role</label>
                                                    <select class="form-control" id="role" name="role" required>
                                                        <option value="">Pilih Role</option>
                                                        <option value="admin"
                                                            {{ old('role', $item->role) == 'admin' ? 'selected' : '' }}>
                                                            Admin</option>
                                                        <option value="user"
                                                            {{ old('role', $item->role) == 'user' ? 'selected' : '' }}>
                                                            User</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
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
                                        <form action="{{ route('user.delete', ['id' => $item->id]) }}" method="POST">
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
@endsection
