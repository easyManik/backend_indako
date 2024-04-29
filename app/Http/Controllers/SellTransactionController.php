<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellTransaction;

class SellTransactionController extends Controller
{
    public function getAllSellTransaction()
    {
        $sellTransactions = SellTransaction::all();
        return response()->json(['sellTransactions' => $sellTransactions], 200);
    }

    public function getSellTransactionById($id)
    {
        $sellTransaction = SellTransaction::findOrFail($id);
        return response()->json(['sellTransaction' => $sellTransaction], 200);
    }

    public function addSellTransaction(Request $request)
    {
        $validatedData = $request->validate([
            'product_id'=>'required|exists:product,id',
            'transaction_date' => 'required|date',
            'customer_name' => 'required|string|max:255',
            'is_cancelled' => 'sometimes|boolean',
            'cancelled_at' => 'nullable|date',
            'is_printed' => 'sometimes|boolean',
            'printed_at' => 'nullable|date',
            'sub_total' => 'required|numeric',
            'disc_amount' => 'nullable|numeric',
            'grand_total' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        $validatedData = $request->merge([
            'is_cancelled' => $request->has('is_cancelled') ? $request->input('is_cancelled') : 0,
            'is_printed' => $request->has('is_printed') ? $request->input('is_printed') : 0,
        ])->all();

        $sellTransaction = SellTransaction::create($validatedData);
        return response()->json(['status'=>'success', 'message' => 'Sell transaction added successfully', 'sellTransaction' => $sellTransaction], 201);
    }

    public function updateSellTransaction(Request $request, $id)
    {
        $sellTransaction = SellTransaction::findOrFail($id);

        $validatedData = $request->validate([
            'product_id'=>'required|exists:product,id',
            'transaction_date' => 'sometimes|date',
            'customer_name' => 'sometimes|string|max:255',
            'is_cancelled' => 'sometimes|boolean',
            'cancelled_at' => 'nullable|date',
            'is_printed' => 'sometimes|boolean',
            'printed_at' => 'nullable|date',
            'sub_total' => 'sometimes|numeric',
            'disc_amount' => 'sometimes|numeric',
            'grand_total' => 'sometimes|numeric',
            'notes' => 'nullable|string',
        ]);

        $sellTransaction->update($validatedData);
        return response()->json(['message' => 'Sell transaction updated successfully', 'sellTransaction' => $sellTransaction], 200);
    }

    public function deleteSellTransaction($id)
    {
        $sellTransaction = SellTransaction::findOrFail($id);
        $sellTransaction->delete();

        return response()->json(['message' => 'Sell transaction deleted successfully'], 200);
    }
}