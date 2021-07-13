<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use App\Models\Receipts;
use App\Models\Orders;

class ShoppingCartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Orders::all();
        $receipts = Receipts::all();
        $shopping_orders = array();

        if (!$orders->isEmpty()) {
            $length = count($orders);

            for ($i = 0, $counter = 0; $i < $length; $i++) {
                $product = Products::where('id', $orders[$i]->product_id)->first();
                $shopping_orders[$counter++] = ([
                    'product_id' => $product->id,
                    'product_name' => $product->product_name,
                    'category' => $product->category,
                    'quantity' => $orders[$i]->quantity,
                    'price' => $product->price,

                ]);
            }
        }
        return view('shopping_cart', ['products' => $shopping_orders], ['receipts' => $receipts]);
    }
    public function createOrder($requestProd, $requestRep)
    {
        Orders::create([
            'product_id' => $requestProd->id,
            'receipt_id' => $requestRep->id,
            'quantity' => 1
        ]);
    }
    public function addToCart($id)
    {
        $product = Products::find($id);
        $orders = Orders::all();

        if ($orders->isEmpty()) { // if order table is empty then this the first product
            $receipt = Receipts::create([
                "status" => 'pending',
            ]);
            $this->createOrder($product, $receipt);
        } else {
            if (Orders::where('product_id', $id)->first()) { //check if item is already added
                $order_checked = Orders::where('product_id', $id)->first();
                DB::table('orders')
                    ->where('product_id', $id)
                    ->update(['quantity' => $order_checked->quantity + 1]);
            } else {
                $order_receipt = Orders::first();
                $receipt = Receipts::find($order_receipt->receipt_id);
                $this->createOrder($product, $receipt);
            }
        }
        return redirect()->route('shopping_cart');
    }
    public function update(Request $request)
    {
        $request_data = $request->all();
        $order_checked = Orders::where('product_id', $request_data['id'])->first();
        DB::table('orders')
            ->where('product_id', $request_data['id'])
            ->update(['quantity' => $request_data['quantity']]);
        return $request_data;
    }
    public function makePurchase(){
        $order = Orders::first();
        $receipt = Receipts::find($order->receipt_id);
        
        $receipt->status = "sold";
        $receipt->save();
        Orders::truncate();

        return redirect()->route('shopping_cart');
    }
    public function remove($id)
    {
        Orders::where('product_id', $id)->delete();
        return redirect()->route('shopping_cart');
    }
    public function showReceipt(){
        $receipts = Receipts::all();
        return response()->json($receipts);
    }
}
