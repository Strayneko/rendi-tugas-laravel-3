<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index', [
            'products' => Product::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
       * ==========================================
       * TODO: store user input to database
       * 1. Validate user input
       * 2. Tidy up validated user input before
       *    store the data to database
       * 3. Check wheter user upload a file or no
       * 4. If user upload a file, store file
       *    name to the database
       * 5. if no, use default image as product
       *    image
       * 6. Store all data to database
       * 7. Redirect user and give feedback message
       * ==========================================
       */

        $validated = $request->validate([
            'name' => 'required|min:5|max:50',
            'price' => 'required|min:100|numeric',
            'stock' => 'required|min:1|numeric',
            'image' => 'file|image|mimes:jpg,png,jpeg',
        ]);
        $validated['has_image'] = false;

        // trim product name and convert it to title case
        $validated['name'] = Str::of($request->input('name'))->trim()->title();

        // give default product description if user has no specified the product description
        // and trim the product description if user specified it
        $validated['description'] = is_null($request->input('description')) ? 'This product has no description' : Str::of($request->input('description'))->trim();

        // add default product image
        $validated['image'] = 'images/no_image.png';

        if (!is_null($request->file('image'))) {
            $validated['image'] = $request->file('image')->store('images', 'public');
            $validated['has_image'] = true;
        }
        Product::create($validated);
        return redirect()->route('product.list')->with('message', 'Product has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        /*
        * =================================
        * TODO: update product
        * 1. Validate user input
        * 2. Tidy up validated user input before
        *    store the data to database
        * 3. Check wheter user upload a file or no
        * 4. Replace image name in database if
        *    user uploaded new image and delete
        *    the old image from public storage
        * =================================
        */
        $validated = $request->validate([
            'name' => 'required|min:5|max:50',
            'price' => 'required|min:100|numeric',
            'stock' => 'required|min:1|numeric',
            'image' => 'file|image|mimes:jpg,png,jpeg',
        ]);
        // trim product name and convert it to title case
        $validated['name'] = Str::of($request->input('name'))->trim()->title();

        // give default product description if user has no specified the product description
        // and trim the product description if user specified it
        $validated['description'] = is_null($request->input('description')) ? 'Produk ini tidak memiliki deskripsi' : Str::of($request->input('description'))->trim();

        if (!is_null($request->file('image'))) {

            if ($product->has_image) Storage::disk('public')->delete($product->image);
            $validated['image'] = $request->file('image')->store('images', 'public');
            $validated['has_image'] = true;
        }
        $product->update($validated);
        return redirect()->route('product.list')->with('message', 'Product sudah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        /*
        * =================================
        * TODO: delete product from database
        * =================================
        */

        // check if product has image
        // if yes delete product image
        if ($product->has_image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('product.list')->with('message', 'product berhasil dihapus!');
    }
}
