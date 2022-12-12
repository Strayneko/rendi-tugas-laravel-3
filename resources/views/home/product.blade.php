@extends('templates.base')

@section('title', 'Product List')

@section('content')
    <h1 class="mb-4">Daftar Product</h1>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3">
                <x-product.card :product="$product" />
            </div>
        @endforeach
    </div>
@endsection
