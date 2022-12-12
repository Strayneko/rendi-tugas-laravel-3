@extends('templates.base')
@section('title', 'Semua Postingan')
@section('content')

    <h3 class="text-center mb-3">Semua Postingan</h3>
    <div class="row justify-content-center">
        <div class="col-md-6 ">
            <form action="">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search something...." name="search"
                        value="{{ request('search') }}" id="search_query">

                </div>
            </form>

        </div>
    </div>
    <div id="search_content">

        @if ($posts->count())
            <div class="card mb-3 col-md-6 mx-auto">
                <img src="{{ asset('storage/' . $posts[0]->image) }}" class="card-img-top mx-auto"
                    style="height: 300px; object-fit: contain">
                <div class="card-body text-center">
                    <h4 class="card-title">{{ $posts[0]->title }}</h4>
                    <p>
                        <small class="text-muted">
                            {{ $posts[0]->created_at->diffForHumans() }}
                    </p>
                    </small>
                    <p class="card-text">{!! $posts[0]->excerpt !!}</p>

                    <a href="/post/{{ $posts[0]->slug }}" class="btn btn-primary">Red More</a>
                </div>
            </div>

            <section>
                <div class="container">
                    <div class="row">
                        @foreach ($posts->skip(1) as $post)
                            <div class="col-md-4 mb-3">
                                <div class="card">

                                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top"
                                        style="height: 150px; object-fit: contain">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <small class="text-muted">
                                            {{ $post->created_at->diffForHumans() }}</p>
                                        </small>
                                        <p class="card-text">{!! $post->excerpt !!}</p>
                                        <a href="{{ route('post.index', ['post' => $post]) }}" class="btn btn-primary">Red
                                            More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>


            </section>
        @else
            <p class="text-center fs-4">No post found!</p>
        @endif
    </div>


    <script>
        // debounce
        const debounce = (callback, duration) => {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    callback.apply(this, args);
                }, duration);
            }
        }
        // live search
        document.addEventListener('DOMContentLoaded', () => {
            const searchQuery = document.querySelector('#search_query');
            searchQuery.addEventListener('input', debounce(async () => {
                const search = await fetch(`/home/ajax/post?search=${searchQuery.value}`).then(
                        res =>
                        res
                        .text())
                    .then(res =>
                        res)
                document.querySelector('#search_content').innerHTML = search
            }, 500));
        });
    </script>
@endsection
