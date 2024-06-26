@extends('auth.layouts.master')

@section('content')
    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="d-flex align-items-center justify-content-between mb-3">
                <a href="" class="">
                    <h6 class="text-primary"><i class="fa fa-hashtag me-2"></i>INVENTARIS PINEWOODS</h6>
                </a>
                <h6>Send Reset Email</h6>
            </div>
            @if (session('status'))
                <div class="alert alert-success mb-3">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                <label for="email">Email address</label>
            </div>

            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Send Password Reset Link</button>
            <a href="{{ route('login') }}" class="btn btn-primary py-3 w-100 mb-4">Login</a>
        </form>
    </div>
@endsection
