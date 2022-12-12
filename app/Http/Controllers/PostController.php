<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('post.index', [
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:posts',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ]);
        // add default post image
        $validated['image'] = 'images/no_image.png';
        $validated['has_image'] = false;
        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('post-images', 'public');
            $validated['has_image'] = true;
        }
        // trim product name and convert it to title case
        $validated['title'] = Str::of($request->input('title'))->trim()->title();
        // make excerpt from post body
        $validated['excerpt'] = Str::limit(strip_tags($request->body), 150);

        Post::create($validated);
        return redirect()->route('post.index')->with('message', 'post berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return view('post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        return view('post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];


        if ($request->slug != $post->slug) $rules['slug'] = 'required|max:255|unique:posts';
        $validated = $request->validate($rules);
        /* Check wheter user uploaded  new image and if post already has an image. If both
        are true, it will update the image. */
        if ($request->file('image')) {
            if ($post->has_image) Storage::delete($post->image, 'public');
            $validated['image'] = $request->file('image')->store('post-images', 'public');
        }
        $validated['excerpt'] = Str::limit(strip_tags($request->body), 200);
        Post::find($post->id)->update($validated);
        return redirect()->route('post.index')->with('message', 'Postingan telah diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        if ($post->has_image) {
            Storage::disk('public')->delete($post->image);
        }
        return redirect()->route('post.index')->with('message', 'postingan dihapus!');
    }
}
