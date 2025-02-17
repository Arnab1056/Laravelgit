<?php
namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::paginate(5);
        $i = (request()->input('page', 1) - 1) * 5; // Calculate the index based on the current page
        return view('medicines.index', compact('medicines', 'i'));
    }

    public function create()
    {
        return view('medicines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required|date',
            'detail' => 'required',
            'selled' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        Medicine::create($request->all());
        return redirect()->route('medicines.index')->with('success', 'Medicine created successfully.');
    }

    public function show($id)
    {
        $medicine = Medicine::find($id);
        return view('medicines.show', compact('medicine'));
    }

    public function edit($id)
    {
        $medicine = Medicine::find($id);
        return view('medicines.edit', compact('medicine'));
    }

    public function update(Request $request, $id)
    {
        $medicine = Medicine::find($id);

        if ($medicine) {
            // If 'selled' is provided in the request, update it
            $selled = $request->has('selled') ? $request->selled : $medicine->selled;

            $medicine->update([
                'name' => $request->name,
                'date' => $request->date,
                'detail' => $request->detail,
                'selled' => $selled, // Use the previous selled value if not updated
                'quantity' => $request->quantity,
            ]);

            return redirect()->route('medicines.index')->with('success', 'Medicine updated successfully.');
        }

        return redirect()->route('medicines.index')->with('error', 'Medicine not found.');
    }

    public function destroy($id)
    {
        Medicine::find($id)->delete();
        return redirect()->route('medicines.index')->with('success', 'Medicine deleted successfully.');
    }

    public function sell($id)
    {
        $medicine = Medicine::find($id);

        // Check if the medicine exists and if there is enough quantity to sell
        if ($medicine && $medicine->quantity > 0) {
            $medicine->selled += 1; // Increment the sold count
            $medicine->quantity -= 1; // Decrement the available quantity
            $medicine->save(); // Save the changes

            return redirect()->route('medicines.index')->with('success', 'Medicine sold successfully.');
        }

        return redirect()->route('medicines.index')->with('error', 'Not enough quantity to sell.');
    }
}
