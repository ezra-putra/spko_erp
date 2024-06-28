<?php

namespace App\Http\Controllers;

use App\Models\Spko;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Spkoitem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SpkoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spko = Spko::all();
        $product = Product::all();
        $employee = Employee::all();

        return view('index', compact('spko', 'product', 'employee'));
    }

    public function invoice($id)
    {
        $spko = Spko::findOrFail($id)->first();
        $spkoitem = Spkoitem::where('id', $id)->get();

        return view('invoice', compact('spkoitem', 'spko'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lastdata = Spko::count('sw');

        $spko = new Spko();
        $spko->remarks = null;
        $spko->employee = $request->input('employee');
        $spko->trans_date = Carbon::now();
        $spko->process = $request->input('spko');
        $counter = (int)$lastdata + 1;
        $formattedCounter = sprintf('%03d', $counter);
        $spko->sw = "SPKO". date("ymd"). "$formattedCounter";
        // dd($spko);
        $spko->save();

        $id = $spko->id;
        $ordinal = 1;
        $id_product = $request->input('product');
        $quantity = $request->input('qty');

        $data = [];
        for($i = 0; $i < count($id_product); $i++) {
            $data[] = [
                'id' => $id,
                'ordinal' => $ordinal++,
                'id_product' => $id_product[$i],
                'qty' => $quantity[$i]
            ];
        }
        // dd($data);
        Spkoitem::insert($data);
        return redirect()->back()->with('success', 'New Data has been Added!');
    }

    public function destroy($id)
    {
        $spko = Spko::findOrFail($id);
        $spko->delete();

        return redirect()->back()->with('success', 'Item Deleted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spko  $spko
     * @return \Illuminate\Http\Response
     */
    public function show(Spko $spko)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spko  $spko
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $spko = Spko::findOrFail($id)->first();
        $spkoitem = Spkoitem::where('id', $id)->get();
        $employee = Employee::all();

        return view('edit', compact('spko', 'spkoitem', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spko  $spko
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $spko = Spko::findOrFail($id)->first();
        $spko->employee = $request->input('employee');
        $spko->process = $request->input('spko');
        $spko->trans_date = $request->input('trans_date');
        $spko->save();

        $spkoitem = SpkoItem::where('id', $id)->get();
        $quantity = $request->input('qty');

        foreach ($spkoitem as $index => $item) {
            $item->qty = $quantity[$index];
            $item->save();
        }
        return redirect('/')->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spko  $spko
     * @return \Illuminate\Http\Response
     */

}
