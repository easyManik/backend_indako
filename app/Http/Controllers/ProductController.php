<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
   public function getAllProduct()
   {
       $products = Product::all();
       return response()->json($products);
   }

   public function getProductById($id)
   {
       $product = Product::findOrFail($id);
       return response()->json($product);
   }

   public function addProduct(Request $req)
   {
       $product = new Product;
       $product->code = $req->input('code');
       $product->name = $req->input('name');
       $product->color = $req->input('color');
       $product->is_raw_material = $req->input('is_raw_material') ? 1 : 0;
       $product->is_active = $req->input('is_active') ? 1 : 0;
       $product->uom_id = $req->input('uom_id');
       $product->stock = $req->input('stock');
       $product->save();
       
       return response()->json($product, 201); 
   }

   public function updateProduct(Request $req, $id)
   {
       $product = Product::findOrFail($id);
       $product->code = $req->input('code');
       $product->name = $req->input('name');
       $product->color = $req->input('color');
       $product->is_raw_material = $req->input('is_raw_material') ? 1 : 0;
       $product->is_active = $req->input('is_active') ? 1 : 0;
       $product->uom_id = $req->input('uom_id');
       $product->stock = $req->input('stock');
       $product->save();
       
       return response()->json(['status' => 'success', 'data' => $product]);
   }

   public function reduceStock(Request $request, $id)
{
    $product = Product::findOrFail($id);
     
    if ($product->stock > 0) {
        $product->stock -= 1;
        $product->save();
        
        return response()->json(['message' => 'Selling successfully', 'product' => $product]);
    } else {
        return response()->json(['message' => 'Product is out of stock'], 400);
    }
}

   public function deleteProduct($id)
   {
       $product = Product::findOrFail($id);
       $product->delete();
       
       return response()->json(['message' => 'Product deleted successfully']);
   }
}