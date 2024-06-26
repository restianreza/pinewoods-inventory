@extends('auth.layouts.master')

@section('content')
    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="d-flex align-items-center justify-content-between mb-3">
                <a href="" class="">
                    <h6 class="text-primary"><i class="fa fa-hashtag me-2"></i>INVENTARIS PINEWOODS</h6>
                </a>
                <h6>Sign In</h6>
            </div>
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
            <div class="form-floating mb-4">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                <label for="password">Password</label>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="{{ route('password.request') }}">Forgot Password ?</a>
            </div>
            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
        </form>
    </div>
@endsection
