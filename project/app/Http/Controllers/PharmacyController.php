<?php

// app/Http/Controllers/PharmacyController.php
namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\ListMedicine;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function index()
    {
        $pharmacies = Pharmacy::with('medicines')->get();
        return view('pharmacies.index', compact('pharmacies'));
    }

    public function create()
    {
        return view('pharmacies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:pharmacies,name',
            'location' => 'required|string',
        ]);

        Pharmacy::create($request->all());
        return redirect()->route('pharmacies.index')->with('success', 'Pharmacy created successfully.');
    }

    public function show($id)
    {
        // Get the pharmacy by ID
        $pharmacy = Pharmacy::findOrFail($id);

        // Get all medicines from the database
        $medicines = Medicine::all();

        return view('pharmacies.show', compact('pharmacy', 'medicines'));
    }

    public function addMedicine(Request $request, $pharmacy_id)
    {
        // Validate the request
        $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Find the pharmacy
        $pharmacy = Pharmacy::findOrFail($pharmacy_id);

        // Find the selected medicine
        $medicine = Medicine::findOrFail($request->medicine_id);

        // Add the medicine to the pharmacy with quantity
        $pharmacy->medicines()->attach($medicine, ['quantity' => $request->quantity]);

        return redirect()->route('pharmacies.show', $pharmacy->id)
            ->with('success', 'Medicine added to pharmacy successfully!');
    }




}
