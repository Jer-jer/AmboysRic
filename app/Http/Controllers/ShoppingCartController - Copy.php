<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $products = Products::all();
        return view('shopping_cart');
    }
    public function createOrder($requestProd, $requestRep){
        Orders::create([
            'product_id' => $requestProd->id,
            'receipt_id' => $requestRep->id,
            'quantity' => 1
        ]);
    }
    public function addToCart($id)
    {
        $product = Products::find($id);
        $shopping_cart = session()->get('shopping_cart');
        

        // if cart is empty then this the first product
        if(!$shopping_cart) {
            $receipt = Receipts::create([
                "status" => 'pending',
            ]);
            $this->createOrder($product, $receipt);
            $shopping_cart = [
                    $id => [
                        "id" =>$product->id,
                        "name" => $product->product_name,
                        "category" => $product->category,
                        "quantity" => 1,
                        "price" => $product->price,
                    ]
            ];
            session()->put('shopping_cart', $shopping_cart);
            return redirect()->route('shopping_cart');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($shopping_cart[$id])) {
            $order = Orders::where('product_id', $shopping_cart[$id]['id'])->first();
            $order->quantity++;
            $order->save();
            $shopping_cart[$id]['quantity'] = $order->quantity;
            session()->put('shopping_cart', $shopping_cart);
            return redirect()->route('shopping_cart');
        }

        // if item not exist in cart then add to cart with quantity = 1
        $order = Orders::where('product_id', $shopping_cart["707211"]["id"])->first();
        $receipt = Receipts::find($order->receipt_id);
        $order = Orders::firstOrCreate(
            ['product_id' => $product->id],
            ['receipt_id' => $receipt->id, 'quantity' => 1]
        );
        $shopping_cart[$id] = [
            "id" => $product->id,
            "name" => $product->product_name,
            "category" => $product->category,
            "quantity" => $order->quantity,
            "price" => $product->price,
        ];
        session()->put('shopping_cart', $shopping_cart);
        return redirect()->route('shopping_cart');
    }
    public function update(Request $request)
    {
        // $product = Products::find($request->id);
        $shopping_cart = session()->get('shopping_cart');
        $test = array($request);
        // end($request);
        // $key = key($request);
        // $i = 0;
        return response()->json($test);
        // for($i = 0; $i <= $key; $i++){
        //     $order = Orders::where('product_id', $request[$i][0]['id'])->first();
        //     $order->quantity = $request[$i][0]['quantity'];
        //     $order->save();
        //     $shopping_cart[$request[$i][0]['id']]["quantity"] = $request[$i][0]['quantity'];
        // }
        // session()->put('shopping_cart', $shopping_cart);
        // session()->flash('success', 'Cart updated successfully');

        // if ($product) {
        //     if (isset($cart[$request->id])) {
        //         $shopping_cart[$request->id]['quantity'] = $request->quantity;
        //     }
        //     session()->put('shopping_cart', $cart);
        //     session()->flash('success', 'Cart updated successfully');
        // }

        // return response()->json($request[0][0]['id']);
        // if($request->id and $request->quantity)
        // {
        //     $cart = session()->get('shopping_cart');
        //     $cart[$request->id]["quantity"] = $request->quantity;
        //     session()->put('shopping_cart', $cart);
        //     session()->flash('success', 'Cart updated successfully');
        // }
    }
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('shopping_cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('shopping_cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
