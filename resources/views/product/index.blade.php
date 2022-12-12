@extends('templates.base')

@section('title', 'Product List')

@section('content')
    @if (session('message'))
        <x-alert.success message="{{ session('message') }}" />
    @endif
    <h1 class="mb-4">Daftar Product</h1>
    <a class="btn btn-primary mb-4" href="{{ route('product.create') }}">
        Tambah Product
    </a>

    <table class="table table-responsive table-striped table-bordered table-hover">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Gambar</th>
                <th scope="col" class="text-center">Nama</th>
                <th scope="col" class="text-center">Deskripsi</th>
                <th scope="col" class="text-center">Harga</th>
                <th scope="col" class="text-center">Stok</th>
                <th scope="col" class="text-center">Opsi</th>

            </tr>
        </thead>
        <tbody class="text-center">

            @foreach ($products as $product)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        <img src="{{ asset('storage') . '/' . $product->image }}" alt="" class="img-thumbnail"
                            style="width: 80%; height:60px;object-fit:contain" />
                    </td>
                    <td>
                        {{ $product->name }}
                    </td>
                    <td>
                        {{ $product->description }}
                    </td>
                    <td>
                        {{ number_format($product->price) }}
                    </td>
                    <td>
                        {{ number_format($product->stock) }}
                    </td>
                    <td>
                        <a href="{{ route('product.edit', ['product' => $product]) }}"
                            class="btn badge text-bg-primary">Edit</a>

                        <form action="{{ route('product.destroy', ['product' => $product]) }}" method="post"
                            onsubmit="return confirm('Apakah kamu yakin?')">
                            @method('delete')
                            @csrf
                            <button class="badge btn text-bg-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
