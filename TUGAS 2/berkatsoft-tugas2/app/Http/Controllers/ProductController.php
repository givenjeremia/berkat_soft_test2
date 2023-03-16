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
        //
        $product = Product::all();
        return response()->json($product, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $new = new Product();
        $new->nama = $request->nama;
        $new->qty = $request->qty;
        $new->harga = $request->harga;
        $new->save();
        // dd($request->nama);
        return response()->json([
            'status'=>true,
            'msg'=>'Data Produk Berhasil Di Tambahkan',
            'data'=>$new
        ], 200);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        // dd($product);
        return response()->json($product, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
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
        //
        $product->nama = $request->get('nama');
        $product->qty = $request->get('qty');
        $product->harga = $request->get('harga');
        // dd($request->get('nama'));
        $product->save();
        return response()->json([
            'status'=>true,
            'msg'=>'Data Produk Berhasil Di Update',
            'data'=>$product
        ], 200);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        // dd($product);
        try {    
            $product->delete();
            return response()->json([
                'status'=>true,
                'msg'=>'Data Produk Delete Di Tambahkan',
                'data'=>$product
            ], 200);
        } catch (\Throwable $th) {
            $product->delete();
            return response()->json([
                'status'=>false,
                'msg'=>'Pastikan Data Child SUdah Hilang Atau Tidak Behubungan',
                'data'=>$product
            ], 200);
        }
    }
}
