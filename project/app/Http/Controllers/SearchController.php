<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        $medicines = Medicine::where('name', 'LIKE', "%{$query}%")->get();
        return response()->json($medicines);
    }

    public function buy($id)
    {
        // Implement the logic to add the medicine to the pharmacy delivery page
        return response()->json(['message' => 'Medicine has been added to your delivery.']);
    }
}
