<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Products;

class ProductsController extends Controller
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
        $data = Products::all();
        return view('inventory', ['products' => $data]);
    }
    public function addProduct(Request $array)
    {
        $data = $array;
        $this->create($data);

        return redirect()->route('inventory');
    }
    public function create(Request $data)
    {
        return Products::create([
            'id' => $data['product_id'],
            'product_name' => $data['product_name'],
            'status' => 'available',
            'price' => $data['price'],
            'category' => $data['category'],
        ]);
        
    }
    public function showProd(Request $request) 
    {
        $request_data = $request->all();
        $prod_id = $request_data['id'];
        $prod_data = Products::where('id', $prod_id)->first();

        return response()->json($prod_data);
    }
    public function updateProduct(Request $request)
    {
        $data = Products::find($request->id);
        
        $data->product_name = $request->product_name;
        $data->status = $request->status;
        $data->category = $request->category;
        $data->price = $request->price;
        $data->save();

        return redirect()->route('inventory');
    }
    public function deleteProduct($id)
    {
        $data = Products::find($id);
        $data->delete();

        return redirect()->route('inventory');
    }
}
