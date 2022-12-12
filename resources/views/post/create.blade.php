@extends('templates.base')

@section('title', 'Tambah Postingan')

@section('content')
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none
        }
    </style>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Postingan baru</h1>
    </div>

    <div class="col-lg-8">

        <form action="{{ route('post.index') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" @class(['form-control', 'is-invalid' => $errors->has('title')]) id="title" name="title" placeholder="Judul Post"
                    value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" id="slug" @class(['form-control', 'is-invalid' => $errors->has('slug')]) value="{{ old('slug') }}" name="slug"
                    onfocus="getSlug(this)" placeholder="slug-post" readonly>
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    </div>
    @error('body')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    <div class="mb-3">
        <label for="slug" class="form-label">Isi</label>
        <input id="body" type="hidden" name="body" value="{{ old('body') }}">
        <trix-editor input="body"></trix-editor>
    </div>

    <div class="mb-3">
        <label for="formFile" class="form-label">Gambar</label>
        <input class="form-control @error('image') is-invalid @enderror" name="image" type="file" id="formFile">
        @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <button class="btn btn-primary">Tambah Postingan</button>
    <a class="btn btn-warning" href="{{ route('post.index') }}">Kembali</a>
    </form>
    </div>
@endsection
