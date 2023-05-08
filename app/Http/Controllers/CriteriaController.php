<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CriteriaController extends Controller
{
    /**
     * @param int categories_id
     * Display a listing of the resource.
     */
    public function index(int $categories_id)
    {
        $total_weight = Criteria::where('categories_id', $categories_id)->sum('weight');

        $criteria = Criteria::select('id', 'name', 'weight', 'atribute')->where('categories_id', $categories_id)->get();

        return view('dashboard.pages.criteria.index', [
            'categories_id' => $categories_id,
            'criterias' => $criteria,
            'total_weight' => $total_weight
        ]);
    }

    /**
     * @param int categories_id
     * Show the form for creating a new resource.
     */
    public function create(int $categories_id)
    {
        return view('dashboard.pages.criteria.create', [
            'categories_id' => $categories_id
        ]);
    }

    /**
     * @param int categories_id
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $categories_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:70',
            'weight' => 'required|numeric',
            'atribute' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            $data = $request->all();

            $sum_weight = Criteria::where('categories_id', $categories_id)->sum('weight');

            // return $sum_weight;

            if ($request->weight + $sum_weight > 1) {
                return redirect()->action([CriteriaController::class, 'index'], ['categories_id' => $categories_id])->with('error', 'weight more than one');
            }

            $data['categories_id'] = $categories_id;

            Criteria::create($data);

            return redirect()->action([CriteriaController::class, 'index'], ['categories_id' => $categories_id])->with('success', 'Criteria has been added');
        } catch (\Exception $e) {
            //throw $th;
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
     * @param int categories_id
     * @param int criteria_id
     * Show the form for editing the specified resource.
     */
    public function edit(int $categories_id, int $criteria_id)
    {
        try {
            $criteria = Criteria::find($criteria_id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error during find criteria!');
        }

        return view('dashboard.pages.criteria.edit', [
            'categories_id' => $categories_id,
            'criteria' => $criteria
        ]);
    }

    /**
     * @param int categories_id
     * @param int criteria_id
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $categories_id, int $criteria_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:70',
            'weight' => 'required|numeric',
            'atribute' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            $criteria = Criteria::find($criteria_id);

            $criteria->update([
                'name' => $request->name,
                'weight' => $request->weight,
                'atribute' => $request->atribute
            ]);

            return redirect()->action([CriteriaController::class, 'index'], ['categories_id' => $categories_id])->with('success', 'Criteria has been updated');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * @param int categories_id
     * @param int criteria_id
     * Remove the specified resource from storage.
     */
    public function destroy(int $categories_id, int $criteria_id)
    {
        try {
            $criteria = Criteria::find($criteria_id);

            $criteria->delete();
            return redirect()->action([CriteriaController::class, 'index'], ['categories_id' => $categories_id])->with('success', 'Criteria has been deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error during the creation!');
        } //
    }
}
