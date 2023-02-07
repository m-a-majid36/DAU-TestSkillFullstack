<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::latest()->filter(request(['keyword']))->paginate(10)->withQueryString();
        
        return view('product.index', compact('product'));
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
        $validatedData = $request->validate([
            'name'          => 'required',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric',
            'description'   => 'required',
        ]);

        Product::create($validatedData);
        
        return redirect()->route('product.index')->with('success', 'Data produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        $product = Product::findOrFail($product);
        
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {

        $validatedData = $request->validate([
            'name'          => 'required',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric',
            'description'   => 'required',
        ]);

        Product::findOrFail($product)->update($validatedData);
        
        return redirect()->route('product.index')->with('success', 'Data produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $product = Product::findOrFail($product);

        $hasil = $product->delete();

        if ($hasil) {
            return redirect()->route('product.index')->with('success', 'Data produk berhasil dihapus!');
        }
        return redirect()->route('product.index')->with('error', 'Data produk gagal dihapus!');
    }
}
