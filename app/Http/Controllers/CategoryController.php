<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::select('id', 'name', 'description')->orderBy('id', 'desc')->get();

        return view('dashboard.pages.category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            $data = $request->all();

            Category::create($data);

            return redirect()->route('dashboard.category.index')->with('success', 'New category has been saved');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error during the creation!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $showKategori = Category::select('name', 'description')->find($id);
        return response()->json([
            'status' => 200,
            'categorydata' => $showKategori
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.pages.category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            $data = $request->all();
            $category->update($data);

            return redirect()->route('dashboard.category.index')->with('success', 'Category has been updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error during the creation!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return redirect()->route('dashboard.category.index')->with('success', 'Category has been deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error during the creation!');
        }
    }
}
