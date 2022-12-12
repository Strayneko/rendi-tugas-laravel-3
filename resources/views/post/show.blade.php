@extends('templates.base')
@section('title', $post->title)
@section('content')
    <article>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 mb-5 ">
                    <h2> {{ $post->title }} </h2>
                    <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid">
                    <article class="my-3 fs-5">
                        <p> {!! $post->body !!} </p>
                    </article>

                    <a href="{{ route('home.post') }}">Back</a>
                </div>
            </div>
        </div>

    </article>
@endsection
