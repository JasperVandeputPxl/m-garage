<?php

namespace App\Http\Controllers;

use App\Models\Tire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('tires.edit', [ 'tire' => $tire ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tire $tire)
    {
        if (strcmp(Auth::user()->user_type, 'admin') !== 0)
            return redirect()->route('tires.index');

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
        if (strcmp(Auth::user()->user_type, 'admin') !== 0)
            return redirect()->route('tires.index');

        $tire->delete();

        return redirect('tires.show')
            ->with('success', 'Tire has been deleted');
    }

    public function quantity(Request $request, Tire $tire)
    {
        if (strcmp(Auth::user()->user_type, 'admin') !== 0)
            return redirect()->route('tires.index');

        $request->validate([
            'quantity' => [ 'required', 'integer']
        ]);

        $oldQuantity = $tire->quantity;
        $newQuantity = (int)($request->input('quantity'));

        $oldUsed = $tire->quantity_used;

        if ($newQuantity > $oldQuantity) {
            $tire->quantity = $newQuantity;
        }else if ($newQuantity < $oldQuantity) {
            $difference = $oldQuantity - $newQuantity;

            $tire->quantity = $newQuantity;
            $tire->quantity_used += $difference;
        } else {
            return redirect()
                ->route('tires.index')
                ->withErrors('Tire quantity did not change!');
        };

        $tire->save();

        return redirect()
            ->route('tires.index')
            ->with('updated_tire', $tire->id)
            ->with('success', 'Tire quantity was successfully updated!');

        /* ->with('success', 'Tire \'' . $tire->id . '\' quantity was successfully updated!' . ' old: ' . $oldQuantity . ' new: ' . $tire->quantity . ' | old used: ' . $oldUsed . ' new used: ' . $tire->quantity_used); */
    }
}
