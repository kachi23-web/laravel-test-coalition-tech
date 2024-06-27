<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;



class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('viewProduct', compact('products'));
    }



    public function create()
    {
        return view('product');
    }

    public function store(Request $request)
    {
        // $data = $request->validate([
        $validator = Validator::make($request->all(), [
            'productname' => 'required|string|max:255',
            'qty' => 'required|string|',
            'price' => 'required|string|',
        ]);

        if ($validator->fails()) {
            return redirect('product/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        Product::create([
            'productname' => $request->productname,
            'qty' => $request->qty,
            'price' => $request->price
        ]);


         

        return redirect()->route('product.create')->with('success', 'Product Added created successfully.');
    }
    



    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'productname' => 'required|string|max:255',
            'qty' => 'required|string',
            'price' => 'required|string',
        ]);

    

        $products = Product::findOrFail($id);
        $products->update($request->all());


       
        return redirect()->route('viewProduct.create')->with('error', 'Product not found successfully.');

        }
    

}