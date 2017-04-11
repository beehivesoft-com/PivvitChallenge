<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\Offering;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::with('offering')
                             ->get();

        return response()->json($purchases);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_name' => 'required',
            'offering_id' => 'required|exists:offerings,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $offering = Offering::findOrFail($request->input('offering_id'));

        $purchase = new Purchase($request->only('customer_name', 'quantity'));

        $offering->purchase()->save($purchase);

        return response()->json($purchase, 201);
    }
}
