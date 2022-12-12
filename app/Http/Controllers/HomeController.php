<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;



class HomeController extends Controller
{
    public function product()
    {
        return view('home.product', ['products' => \App\Models\Product::all()]);
    }
    public function post()
    {
        return view(
            'home.post',
            [
                'posts' => \App\Models\Post::latest()
                    ->filter(request(['search']))->get()

            ]
        );
    }

    public function postAjax()
    {
        return view(
            'ajax.post',
            [
                'posts' => \App\Models\Post::latest()
                    ->filter(request(['search']))->get()
            ]
        );
    }
}
