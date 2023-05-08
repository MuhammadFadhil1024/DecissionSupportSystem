<?php

namespace App\Http\Controllers;

use App\Models\value;
use App\Models\Criteria;
use App\Models\Alternative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValueController extends Controller
{
    /**
     * param int categories_id
     * Display a listing of the resource.
     */
    public function index(int $categories_id)
    {
        $alternatives = Alternative::with('values')->select('id', 'alternative_code', 'name')->where('categories_id', $categories_id)->get();

        return view('dashboard.pages.value.index', [
            'categories_id' => $categories_id,
            'alternatives' => $alternatives
        ]);
    }

    /**
     * param int categories_id
     * param int alternative_id
     * Show the form for creating a new resource.
     */
    public function create(int $categories_id, int $alternative_id)
    {

        $criterias = Criteria::select('id', 'name')->where('categories_id', $categories_id)->get();

        $alternative = Alternative::find($alternative_id);

        return view('dashboard.pages.value.create', [
            'categories_id' => $categories_id,
            'criterias' => $criterias,
            'alternative_id' => $alternative_id,
            'alternative' => $alternative
        ]);
    }

    /**
     * param int alternative_id
     * param int categories_id
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $categories_id, int $alternative_id)
    {

        $validator = Validator::make($request->all(), [
            'value.*.value' => 'required|numeric'
        ], [
            'value.*.value' => 'Field required cannt be null'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            foreach ($request->value as $value) {

                value::create([
                    'alternative_id' => $alternative_id,
                    'criteria_id' => $value['criteria_id'],
                    'value' => $value['value']
                ]);
            }
            return redirect()->action([ValueController::class, 'index'], ['categories_id' => $categories_id])->with('success', 'Value has been added');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error during the creation!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * param int alternative_id
     * param int categories_id
     * Show the form for editing the specified resource.
     */
    public function edit(int $categories_id, int $alternative_id)
    {
        $alternative_value = Alternative::with('values.criterias')->where('id', $alternative_id)->first();
        // dd($alternative_value);

        return view('dashboard.pages.value.edit', [
            'alternative_value' => $alternative_value,
            'categories_id' => $categories_id,
        ]);
    }

    /**
     * param int alternative_id
     * param int categories_id
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $categories_id)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'value.*.value' => 'required|numeric'
        ], [
            'value.*.value' => 'Field required cannt be null'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            foreach ($request->value as $value) {
                $get_values = value::find($value['value_id']);
                // dd($value['value']);
                $get_values->update([
                    'value' =>  $value['value']
                ]);
            }
            return redirect()->action([ValueController::class, 'index'], ['categories_id' => $categories_id])->with('success', 'Value has been updated');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
