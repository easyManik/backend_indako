<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellTransactionDetail;

class SellTransactionDetailController extends Controller
{
    public function getAllSellTransactionDetail()
    {
        $sellTransactionDetails = SellTransactionDetail::all();
        return response()->json(['sellTransactionDetails' => $sellTransactionDetails], 200);
    }

    public function getSellTransactionDetailById($id)
    {
        $sellTransactionDetail = SellTransactionDetail::findOrFail($id);
        return response()->json(['sellTransactionDetail' => $sellTransactionDetail], 200);
    }

    public function addSellTransactionDetail(Request $request)
    {
        $validatedData = $request->validate([
            'sell_transaction_id' => 'required|exists:sell_transaction,id',
            'product_id' => 'required|exists:product,id',
            'qty' => 'required|numeric',
            'uom_id' => 'required|exists:uom_list,id',
            'price' => 'required|numeric',
            'disc_1' => 'nullable|numeric',
            'disc_2' => 'nullable|numeric',
            'disc_amount' => 'nullable|numeric',
            'total' => 'required|numeric',
            'cogs' => 'required|numeric',
        ]);

        $sellTransactionDetail = SellTransactionDetail::create($validatedData);
        return response()->json(['message' => 'Sell transaction detail added successfully', 'sellTransactionDetail' => $sellTransactionDetail], 201);
    }

    public function updateSellTransactionDetail(Request $request, $id)
    {
        $sellTransactionDetail = SellTransactionDetail::findOrFail($id);

        $validatedData = $request->validate([
            'sell_transaction_id' => 'sometimes|required|integer',
            'product_id' => 'sometimes|required|integer',
            'qty' => 'sometimes|required|numeric',
            'uom_id' => 'sometimes|required|integer',
            'price' => 'sometimes|required|numeric',
            'disc_1' => 'nullable|numeric',
            'disc_2' => 'nullable|numeric',
            'disc_amount' => 'nullable|numeric',
            'total' => 'sometimes|required|numeric',
            'cogs' => 'sometimes|required|numeric',
        ]);

        $sellTransactionDetail->update($validatedData);
        return response()->json(['message' => 'Sell transaction detail updated successfully', 'sellTransactionDetail' => $sellTransactionDetail], 200);
    }

    public function deleteSellTransactionDetail($id)
    {
        $sellTransactionDetail = SellTransactionDetail::findOrFail($id);
        $sellTransactionDetail->delete();

        return response()->json(['message' => 'Sell transaction detail deleted successfully'], 200);
    }
}