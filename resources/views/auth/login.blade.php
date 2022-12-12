@extends('templates.base')
@section('title', 'User Login')

@section('content')
    @if (session()->has('error'))
        <x-alert.error message="{{ session('error') }}" />
    @enderror
    @if (session()->has('message'))
        <x-alert.success message="{{ session('message') }}" />
    @enderror

    <h2 class="mt-4 text-center mb-4">User Login</h2>

    <form action="{{ route('auth.do_login') }}" method="post" class="col-md-5 mx-auto">
        @csrf
        <div class="mb-3 row">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" autofocus>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword" name="password">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>


@endsection
