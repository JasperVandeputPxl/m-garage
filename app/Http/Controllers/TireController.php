<?php

namespace App\Http\Controllers;

use App\Models\Tire;
use Illuminate\Http\Request;

class TireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tires.index', ['tires' => Tire::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tires.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'size' => [ 'required', 'regex:/^[0-9]{3}\/[0-9]{2}\/[0-9]{2}$/' ],
            'quantity' => [ 'required', 'integer' ],
            'quantity_used' => [ 'required', 'integer' ],
            'brand' => [ 'required', 'string' ],
            'price' => [ 'required', 'decimal:1,3' ]
        ]);

        $tire = new Tire();

        $tire->size = $request->input('size');
        $tire->quantity = $request->input('quantity');
        $tire->quantity_used = $request->input('quantity_used');
        $tire->brand = $request->input('brand');
        $tire->price = $request->input('price');

        $tire->save();

        return redirect()
            ->route('tires.create')
            ->with('success', 'Tire is submitted!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tire $tire)
    {
        return view('tires.edit', [
            'tire' => $tire
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tire $tire)
    {
        $request->validate([
            'size' => [ 'required', 'regex:/^[0-9]{3}\/[0-9]{2}\/[0-9]{2}$/' ],
            'quantity' => [ 'required', 'integer' ],
            'quantity_used' => [ 'required', 'integer' ],
            'brand' => [ 'required', 'string' ],
            'price' => [ 'required', 'decimal:1,3' ]
        ]);

        $tire->size = $request->input('size');
        $tire->quantity = $request->input('quantity');
        $tire->quantity_used = $request->input('quantity_used');
        $tire->brand = $request->input('brand');
        $tire->price = $request->input('price');

        $tire->save();

        return redirect()
            ->route('tires.index')
            ->with('success', 'Tire is updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tire $tire)
    {
        $tire->delete();

        return redirect('tires.show')
            ->with('success', 'Tire has been deleted');
    }
}
