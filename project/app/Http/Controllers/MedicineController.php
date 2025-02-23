<?php
namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $medicines = Medicine::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(5);
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
            'name' => 'required|unique:medicines,name',
            'date' => 'nullable|date',
            'detail' => 'nullable|string',
            'selled' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        try {
            $medicine = new Medicine([
                'name' => $request->get('name'),
                'date' => $request->get('date'),
                'detail' => $request->get('detail'),
                'selled' => $request->get('selled'),
                'quantity' => $request->get('quantity'),
            ]);

            $medicine->save();

            return redirect()->route('medicines.index')->with('success', 'Medicine added successfully');
        } catch (\Exception $e) {
            return redirect()->route('medicines.create')->with('error', 'Medicine with the same name already exists.');
        }
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
            $request->validate([
                'name' => 'required|unique:medicines,name,' . $id,
                'date' => 'nullable|date',
                'detail' => 'nullable|string',
                'selled' => 'required|integer',
                'quantity' => 'required|integer',
            ]);

            $selled = $request->has('selled') ? $request->selled : $medicine->selled;

            $medicine->update([
                'name' => $request->name,
                'date' => $request->date,
                'detail' => $request->detail,
                'selled' => $selled,
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

    public function sell(Request $request, $id)
    {
        $request->validate([
            'sellQuantity' => 'required|integer|min:1',
        ]);

        $medicine = Medicine::find($id);

        // Check if the medicine exists and if there is enough quantity to sell
        if ($medicine && $medicine->quantity >= $request->sellQuantity) {
            $medicine->selled += $request->sellQuantity; // Increment the sold count
            $medicine->quantity -= $request->sellQuantity; // Decrement the available quantity
            $medicine->save(); // Save the changes

            return redirect()->route('medicines.index')->with('success', 'Medicine sold successfully.');
        }

        return redirect()->route('medicines.index')->with('error', 'Not enough quantity to sell.');
    }

    public function suggestions(Request $request)
    {
        $query = $request->query('query');
        $suggestions = Medicine::where('name', 'like', "%{$query}%")->limit(5)->get(['name']);
        return response()->json($suggestions);
    }
}
