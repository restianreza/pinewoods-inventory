@extends('layouts.master')


@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <h1>History</h1>
        </div>
    </div>

    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">History</h6>
            </div>
            <div>
                <table id="myTable" class="table table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <td class="text-start">No</td>
                            <td class="text-start">Action Category</td>
                            <td class="text-start">User</td>
                            <td class="text-start">Deskripsi</td>
                            <td class="text-start">Tanggal</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($history as $item)
                            <tr>
                                <td class="text-start">{{ $loop->iteration }}</td>
                                <td class="text-start">{{ $item->action_category }}</td>
                                <td class="text-start">{{ $item->user }}</td>
                                <td class="text-start">{{ $item->description }}</td>
                                <td class="text-start">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
