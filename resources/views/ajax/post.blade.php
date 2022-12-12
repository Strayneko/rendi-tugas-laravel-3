 @if ($posts->count())
     <div @class(['card', 'mb-3', 'col-md-6', 'mx-auto'])>
         <img src="{{ asset('storage/' . $posts[0]->image) }}" @class(['card-img-top', 'mx-auto'])
             style="height: 300px;object-fit:contain">
         <div @class(['card-body', 'text-center'])>
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
                 @foreach ($posts as $post)
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
                                 <a href="/post/{{ $post->slug }}" class="btn btn-primary">Red More</a>
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
