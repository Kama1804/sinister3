<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    public function edit($id)
    {
        $barber = Barber::findOrFail($id);
        return view('admin.barber.edit', compact('barber'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'outlet' => 'required|string|in:eco_grandeur,taman_ilmu',
        ], [
            'name.required' => 'The Name field is required.',
            'outlet.required' => 'The Outlet field is required.',
            'outlet.in' => 'The selected Outlet must be Taman Ilmu or Eco Grandeur.',
        ]);
    
        $barber = Barber::findOrFail($id);
        $barber->update($validated);
    
        return redirect()->route('admin.barbers.table')->with('success', 'Barber updated successfully.');
    }
    

    public function destroy($id)
    {
        $barber = Barber::findOrFail($id);
        $barber->delete();

        return redirect()->route('admin.barbers.table')->with('success', 'Barber deleted successfully.');
    }
    public function table()
    {
        $barbers = Barber::all(); // Fetch all barbers
        return view('admin.barber.table', compact('barbers')); // Updated folder name
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'outlet' => 'required|string|in:eco_grandeur,taman_ilmu',
    ]);

    Barber::create($validated);

    return redirect()->route('admin.barbers.table')->with('success', 'Barber added successfully.');
}

public function create()
{
    return view('admin.barber.create'); // Ensure the path matches your actual view file
}

    

}
