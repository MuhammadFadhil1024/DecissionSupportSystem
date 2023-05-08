<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlternativeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $categories_id)
    {
        $alternatives = Alternative::select('id', 'alternative_code', 'name')->where('categories_id', $categories_id)->orderBy('id', 'asc')->get();
        // return $alternatives;
        return view('dashboard.pages.Alternative.index', [
            'categories_id' => $categories_id,
            'alternatives' => $alternatives
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $categories_id)
    {
        return view('dashboard.pages.Alternative.create', [
            'categories_id' => $categories_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $categories_id)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'alternative_code' => 'required|unique:alternatives,alternative_code|max:50',
            'name' => 'required|max:200',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            $data = $request->all();
            $data['categories_id'] = $categories_id;

            Alternative::create($data);

            return redirect()->action([AlternativeController::class, 'index'], ['categories_id' => $categories_id])->with('success', 'Alternatives has been added');
        } catch (\Exception $e) {
            // dd($e->getMessage());
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
     * @param int alternative_id
     * Show the form for editing the specified resource.
     */
    public function edit(int $categories_id, int $alternative_id)
    {
        try {
            $alternative = Alternative::find($alternative_id);
            // return $alternative;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error during find alternative!');
        }

        return view('dashboard.pages.Alternative.edit', [
            'categories_id' => $categories_id,
            'alternative' => $alternative
        ]);
    }

    /**
     * @param int categories_id
     * @param int alternative_id
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $categories_id, int $alternative_id)
    {
        $validator = Validator::make($request->all(), [
            'alternative_code' => 'required|max:50|unique:alternatives,alternative_code,' . $alternative_id,
            'name' => 'required|max:200',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            $alternative = Alternative::find($alternative_id);

            $alternative->update([
                'alternative_code' => $request->alternative_code,
                'name' => $request->name
            ]);

            return redirect()->action([AlternativeController::class, 'index'], ['categories_id' => $categories_id])->with('success', 'Alternatives has been updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error during the creation!');
        }
    }

    /**
     * @param int categories_id
     * @param int alternative_id
     * Remove the specified resource from storage.
     */
    public function destroy(int $categories_id, int $alternative_id)
    {
        try {
            $alternative = Alternative::find($alternative_id);

            $alternative->delete();
            return redirect()->action([AlternativeController::class, 'index'], ['categories_id' => $categories_id])->with('success', 'Alternatives has been deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error during the creation!');
        }
    }
}
