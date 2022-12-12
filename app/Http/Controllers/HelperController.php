<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class HelperController extends Controller
{
    public function getSlug(Request $request)
    {
        if (is_null($request->query('title'))) return response()->json([
            'status_code' => 400,
            'status' => false,
            'message' => 'Bad request!. No argument specified!',
        ], 400);


        return response()->json([
            'status_code' => 200,
            'status' => true,
            'message' => 'Slug successfully fetched!',
            'slug' => SlugService::createSlug(Post::class, 'slug', $request->query('title'))
        ]);
    }
}
