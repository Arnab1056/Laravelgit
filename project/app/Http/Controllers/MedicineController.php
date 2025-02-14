<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicines = Medicine::latest()->paginate(5);  // Get medicines and paginate
        return view('medicines.index', compact('medicines'))
            ->with('i', (request()->input('page', 1) - 1) * 5);  // Index calculation for pagination
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medicines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'detail' => 'required|string',
            'quantity' => 'required|integer|min:0',
        ]);

        // Store the medicine
        Medicine::create($request->all());

        return redirect()->route('medicines.index')
            ->with('success', 'Medicine added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine)
    {
        return view('medicines.show', compact('medicine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicine $medicine)
    {
        return view('medicines.edit', compact('medicine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicine $medicine)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'detail' => 'required|string',
            'quantity' => 'required|integer|min:0',
        ]);

        // Update the medicine
        $medicine->update($request->all());

        return redirect()->route('medicines.index')
            ->with('success', 'Medicine updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        // Delete the medicine
        $medicine->delete();

        return redirect()->route('medicines.index')
            ->with('success', 'Medicine deleted successfully.');
    }

    /**
     * Handle selling a medicine (decrease quantity and increase selled count).
     */
    public function sell($id)
    {
        // Find the medicine by its ID
        $medicine = Medicine::findOrFail($id);

        // Check if there's enough stock to sell
        if ($medicine->quantity > 0) {
            // Decrease quantity and increase selled count
            $medicine->quantity -= 1;
            $medicine->selled += 1;

            // Save the changes to the database
            $medicine->save();

            // Redirect to the medicines index page with a success message
            return redirect()->route('medicines.index')->with('success', 'Medicine sold successfully.');
        }

        // If there's not enough stock, show an error message
        return redirect()->route('medicines.index')->with('error', 'Not enough stock available.');
    }
}
