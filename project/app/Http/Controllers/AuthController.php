<?php

// Medicine Controller (app/Http/Controllers/MedicineController.php)
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Medicine;

class MedicineController extends Controller {
    public function showAddMedicine() {
        $medicines = Medicine::all();
        return view('pharmacy.add-medicine', compact('medicines'));
    }

    public function storeMedicine(Request $request) {
        Medicine::create($request->all());
        return back()->with('success', 'Medicine added successfully!');
    }

    public function search(Request $request) {
        $query = $request->input('query');
        $medicines = Medicine::where('name', 'LIKE', "%$query%")->get();
        return view('user.search-results', compact('medicines'));
    }

    public function manage() {
        $medicines = Medicine::all();
        return view('pharmaceutical.manage-medicine', compact('medicines'));
    }
}
