<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductPrice;

class ProductPriceController extends Controller
{
    public function getAllProductprice()
    {
        $productPrices = ProductPrice::all();
        return response()->json($productPrices);
    }

    public function addProductprice(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:product,id',
            'price' => 'required|numeric',
        ]);

        $productPrice = ProductPrice::create([
            'product_id' => $request->input('product_id'),
            'price' => $request->input('price'),
        ]);

        return response()->json($productPrice, 201); // 201 Created
    }

    public function getProductpriceById($id)
    {
        $productPrice = ProductPrice::findOrFail($id);
        return response()->json($productPrice);
    }

    public function updateProductprice(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:product,id',
            'price' => 'required|numeric',
        ]);

        $productPrice = ProductPrice::findOrFail($id);
        $productPrice->update([
            'product_id' => $request->input('product_id'),
            'price' => $request->input('price'),
        ]);

        return response()->json($productPrice);
    }

    public function deleteProductprice($id)
    {
        $productPrice = ProductPrice::findOrFail($id);
        $productPrice->delete();

        return response()->json(['message' => 'Product price deleted successfully']);
    }
}