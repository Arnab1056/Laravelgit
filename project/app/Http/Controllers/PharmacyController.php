<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pharmacy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PharmacyController extends Controller
{
    // Show all pharmacies
    public function index()
    {
        $pharmacies = Pharmacy::all();  // Retrieve all pharmacies from the database
        return view('pharmacies.index', compact('pharmacies'));
    }

    // Show form to create a new pharmacy
    public function create()
    {
        return view('pharmacies.create');
    }

    // Store new pharmacy in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|unique:pharmacies',
            'password' => 'required|string|min:6',
        ]);

        Pharmacy::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('pharmacies.index')->with('success', 'Pharmacy added successfully');
    }

    // Show form to edit an existing pharmacy
    public function edit($id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        return view('pharmacies.edit', compact('pharmacy'));
    }

    // Update an existing pharmacy record
    public function update(Request $request, $id)
    {
        $pharmacy = Pharmacy::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|unique:pharmacies,email,' . $pharmacy->id,
            'password' => 'nullable|string|min:6',  // Optional password update
        ]);

        $pharmacy->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $pharmacy->password,
        ]);

        return redirect()->route('pharmacies.index')->with('success', 'Pharmacy updated successfully');
    }

    // Delete a pharmacy from the database
    public function destroy($id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->delete();

        return redirect()->route('pharmacies.index')->with('success', 'Pharmacy deleted successfully');
    }
}
