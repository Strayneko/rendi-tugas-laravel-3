@extends('templates.base')

@section('title', 'Tambah Product')
@section('content')
    <div class="row">
        <h2 class="mb-4">Tambah Produk Baru</h2>
        <form class="col-md-4" action="{{ route('product.list') }}" enctype="multipart/form-data" method="post">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Product <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" required
                    name="name" value="{{ old('name') }}">
                <div class="form-text float-end" id="name_count"><span id="count">0</span>/50</div>
                <div class="clearfix"></div>

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea type="text" class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                <div class="form-text float-end" id="desc_count"><span id="count">0</span></div>

            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" required
                    name="price" required value="{{ old('price') }}">
                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" required
                    name="stock" required value="{{ old('stock') }}">
                @error('stock')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                    name="image">

                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="{{ route('product.list') }}" class="btn btn-danger">Kembali</a>
        </form>

    </div>
@endsection
