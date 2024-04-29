<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UOM;

class UOMController extends Controller
{
  
public function addUOM(Request $req){
    $validatedData = $req->validate([
        'uom_name' => 'required|string|max:50', // Validasi inputan
    ]);

    $uom = UOM::create([
        'uom_name' => $validatedData['uom_name'],
    ]);
    $uom->save();

    return response()->json(['message' => 'UOM added successfully', 'uom' => $uom], 201);
}
public function getAllUOM() {
    $uoms = UOM::all();
    return response()->json(['uoms' => $uoms], 200);
}

public function getUOMById($id) {
    $uom = UOM::findOrFail($id);
    return response()->json(['uom' => $uom], 200);
}
public function updateUOM(Request $req, $id) {
    $uom = UOM::findOrFail($id);
    $validatedData = $req->validate([
        'uom_name' => 'required|string|max:50',
    ]);

    $uom->uom_name = $validatedData['uom_name'];
    $uom->save();

    return response()->json(['message' => 'UOM updated successfully', 'uom' => $uom], 200);
}
public function deleteUOM($id) {
    $uom = UOM::findOrFail($id);
    $uom->delete();

    return response()->json(['message' => 'UOM deleted successfully'], 200);
}
}