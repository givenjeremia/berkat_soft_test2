<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Sales_Order;
use Illuminate\Http\Request;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sales_Order = Sales_Order::all();
        // Get Pivot data
        $with_pivot = [];
        foreach ($sales_Order as  $value) {
            # code...
            $tanggal = $value->tanggal;
            $total_harga = $value->total_harga;
            $customer_id = $value->customers->id;
            $customer_nama = $value->customers->nama;
            $products = [];
            foreach ($value->products as $value2) {
                array_push($products,[
                    'id'=> $value2->id,
                    'nama'=>$value2->nama,
                    'qty'=> $value2->pivot->qty
                ]);
            }
            array_push($with_pivot,[
                'tanggal'=>$tanggal,
                'total_harga'=>$total_harga,
                'customer_id'=>$customer_id ,
                'customer_nama' => $customer_nama,
                'products' => $products

            ]);
            // dd($value->products());
        }
        return response()->json($with_pivot, 200);
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
        if($request->get('customer_id') != "Pilih Customer" && count($request->get('products')) > 0 ){
            $new = new Sales_Order();
            $new->tanggal = Carbon::now()->toDatetimeString();
            $customer_new = Customer::find($request->get('customer_id'));
            $customer_new->sales_orders()->save($new);
            $id = $new->id;
            $total_harga = 0;
            // Lopping Data Product
            foreach ($request->get('products') as $details) {
                # code...
                // dd($value['id']);
                $sub_total = $details['qty'] * $details['harga'];
                $total_harga += $sub_total; 
                $new->products()->attach($details['id'],['qty' =>$details['qty'],'sub_total' =>$sub_total]);
            }
            $new->total_harga = $total_harga;
            $new->save();
            return response()->json([
                'status'=>true,
                'msg'=>'Sales Order berhasil Di Input',
                'data'=>$new
            ], 200);;
        }
        else{
            return response()->json([
                'status'=>false,
                'msg'=>'Sales Order Gagal Di Input',
            ], 200);;
        }
       


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sales_Order  $sales_Order
     * @return \Illuminate\Http\Response
     */
    public function show(Sales_Order $sales_Order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sales_Order  $sales_Order
     * @return \Illuminate\Http\Response
     */
    public function edit(Sales_Order $sales_Order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sales_Order  $sales_Order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sales_Order $sales_Order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sales_Order  $sales_Order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sales_Order $sales_Order)
    {
        //
    }
}
