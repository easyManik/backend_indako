<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductUom;
use Illuminate\Validation\Rule;

class ProductUomController extends Controller
{
    public function getAllProductUom()
    {
        $productUoms = ProductUom::all();
        return response()->json(['productUoms' => $productUoms], 200);
    }

    public function addProductUom(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:product,id',
            'uom_id' => 'required|exists:uom_list,id',
            'qty_conversion' => 'required|numeric|min:0',
        ]);

        $productUom = ProductUom::create($validatedData);

        return response()->json(['message' => 'Product UOM created successfully', 'productUom' => $productUom], 201);
    }

    public function getProductUomById($id)
    {
        $productUom = ProductUom::findOrFail($id);
        return response()->json(['productUom' => $productUom], 200);
    }

    public function updateProductUom(Request $request, $id)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:product,id',
            'uom_id' => 'required|exists:uom_list,id',
            'qty_conversion' => 'required|numeric|min:0',
        ]);

        $productUom = ProductUom::findOrFail($id);
        $productUom->update($validatedData);

        return response()->json(['message' => 'Product UOM updated successfully', 'productUom' => $productUom], 200);
    }

    public function deleteProductUom($id)
    {
        $productUom = ProductUom::findOrFail($id);
        $productUom->delete();

        return response()->json(['message' => 'Product UOM deleted successfully'], 200);
    }
}