@extends('templates.base')

@section('title', 'Post List')

@section('content')
    @if (session('message'))
        <x-alert.success message="{{ session('message') }}" />
    @endif

    <a class="btn btn-primary mb-4" href="{{ route('post.create') }}">
        Tambah Post
    </a>

    <table class="table table-responsive table-striped table-bordered table-hover">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Gambar</th>
                <th scope="col" class="text-center">Judul</th>
                <th scope="col" class="text-center">Excerpt</th>
                <th scope="col" class="text-center">Tanggal Posting</th>
                <th scope="col" class="text-center">Opsi</th>

            </tr>
        </thead>
        <tbody class="text-center">

            @foreach ($posts as $post)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        <img src="{{ asset('storage') . '/' . $post->image }}" alt="" class="img-thumbnail"
                            style="width: 80%; height:60px; object-fit: contain" />
                    </td>
                    <td>
                        {{ $post->title }}
                    </td>
                    <td class="col-md-5">
                        {{ $post->excerpt }}
                    </td>
                    <td>
                        {{ date('M d, Y', strtotime($post->created_at)) }}
                    </td>
                    <td>
                        <a href="{{ route('post.edit', ['post' => $post]) }}" class="btn badge text-bg-primary">Edit</a>

                        <form action="{{ route('post.destroy', ['post' => $post]) }}" method="post"
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
