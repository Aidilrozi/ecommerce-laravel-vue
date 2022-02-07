<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class OrderApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::where(['customer_id' => $request->user()->id])->get();
       
        return response()->json($orders, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function AddNewOrder(Request $request)
    {
        
        $user = $request->user();
        $datas = $request->all();
        $order_id = 0;
        foreach($datas as $k_data => $v_data){
            $or = [
                'customer_id' => $user->id,
                'order_status' => 'In Progress',
                'payment_method' => "COD",
                'created_at' => now(),
                'updated_at' => now()
            ];
            $order_id = DB::table('orders')->insertGetId($or);
            $or_p = [
                'order_id' => $order_id,
                'product_id' => $v_data['product_id'],
                'price' => $v_data['price'],
                'qty'=> $v_data['qty'],
                'created_at' => now(),
                'updated_at' => now()
            ];
            DB::table('order_products')->insert($or_p);
        }

        return response()->json(array("order_id"=>$order_id,"success"=>"true"), 200);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
