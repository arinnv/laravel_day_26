<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Datatables;

class ProductsController extends Controller
{
    public function index() {

        if(request()->ajax()) {
            return datatables()->of(Product::select('*'))
            ->addColumn('action', 'products.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('products.index');
    }
 
    public function create() {
        return view('products.create');
    }
    
    public function store(Request $request) {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
        ]);

        $product = new Product;

        $product->product_name = $request->product_name;
        $product->price = $request->price;

        $product->save();

        return redirect()->route('products.index')
                        ->with('success','Product has been created successfully.');
    }

    public function show(Product $product) {
        return view('products.show',compact('product'));
    } 

    public function edit(Product $product) {
        return view('products.edit',compact('product'));
    }
    
    public function update(Request $request, $id) {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
        ]);
        
        $product = Product::find($id);

        $product->product_name = $request->product_name;
        $product->price = $request->price;
        
        $product->save();
    
        return redirect()->route('products.index')
                        ->with('success','Product Has Been updated successfully');
    }

    public function destroy(Request $request) {
    
        $com = Product::where('id',$request->id)->delete();

        return Response()->json($com);
    }
}
