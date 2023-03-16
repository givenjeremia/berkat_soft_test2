<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = Customer::all();
        return response()->json($customers, 200);
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
        $new = new Customer();
        $new->nama = $request->get('nama');
        $new->alamat = $request->get('alamat');
        $new->save();
        return response()->json([
            'status'=>true,
            'msg'=>'Data Customer Berhasil Di Tambahkan',
            'data'=>$new
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
        // dd($customer);
        return response()->json($customer, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
        $customer->nama = $request->get('nama');
        $customer->alamat = $request->get('alamat');
        $customer->save();
        return response()->json([
            'status'=>true,
            'msg'=>'Data Customer Berhasil Di Update',
            'data'=>$customer
        ], 200);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
        try {    
            $customer->delete();
            return response()->json([
                'status'=>true,
                'msg'=>'Data Produk Delete Di Tambahkan',
                'data'=>$customer
            ], 200);
        } catch (\Throwable $th) {
            $customer->delete();
            return response()->json([
                'status'=>false,
                'msg'=>'Pastikan Data Child Sudah Hilang Atau Tidak Behubungan',
                'data'=>$customer
            ], 200); 
        }
    }
}
