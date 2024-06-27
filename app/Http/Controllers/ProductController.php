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


         // Save data to JSON file
         $jsonFilePath = storage_path('app/products.json');
         $jsonData = $this->getJsonData($jsonFilePath);
         $jsonData[] = $validator;
         File::put($jsonFilePath, json_encode($jsonData, JSON_PRETTY_PRINT));
 
         // Save data to XML file
         $xmlFilePath = storage_path('app/products.xml');
         $xmlData = $this->getXmlData($xmlFilePath);
         $xmlData->addChild('product', $this->arrayToXml($validator));
         File::put($xmlFilePath, $xmlData->asXML());
 

        return redirect()->route('product.create')->with('success', 'Product Added created successfully.');
    }
    

    private function getJsonData($filePath)
    {
        if (File::exists($filePath)) {
            return json_decode(File::get($filePath), true);
        }
        return [];
    }

    private function getXmlData($filePath)
    {
        if (File::exists($filePath)) {
            return simplexml_load_file($filePath);
        }
        return new \SimpleXMLElement('<products/>');
    }

    private function arrayToXml($array, &$xmlData = null)
    {
        if ($xmlData === null) {
            $xmlData = new \SimpleXMLElement('<product/>');
        }

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $subNode = $xmlData->addChild("$key");
                $this->arrayToXml($value, $subNode);
            } else {
                $xmlData->addChild("$key", htmlspecialchars("$value"));
            }
        }
        return $xmlData;
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