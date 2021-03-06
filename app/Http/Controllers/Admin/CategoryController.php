<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view("admin.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = Category::where("parent_id", 0)->get();
        $attributes = Attribute::all();
        return view('admin.categories.create', compact("attributes", "parentCategories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "parent_id" => "required",
            "name" => "required",
            "slug" => "required|unique:categories,slug",
            "is_active" => "required",
            "attribute_ids" => "required",
            "attribute_filter_ids" => "required",
            "attribute_variation_id" => "required",
        ]);

        try {
            DB::beginTransaction();
            $category = Category::create([
                "parent_id" => $request->parent_id,
                "name" => $request->name,
                "slug" => $request->slug,
                "icon" => $request->icon,
                "is_active" => $request->is_active,
                "description" => $request->description
            ]);

            foreach ($request->attribute_ids as $attributeId) {
                $attribute = Attribute::findOrFail($attributeId);

                $attribute->categories()->attach($category->id, [
                    "is_filter" => in_array($attributeId, ($request->attribute_filter_ids != Null ? $request->attribute_filter_ids : [])) ? 1 : 0,
                    "is_variation" => $request->attribute_variation_id == $attributeId ? 1 : 0
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error($e->getMessage(), '??????')->persistent("????????????!");

            return redirect()->back();
        }

        alert()->success('???????? ???????? ???????? ?????? ?????????? ????', '??????????')->persistent("???????? ????!");

        return redirect()->route("admin.categories.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view("admin.categories.show", compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::where("parent_id", 0)->get();
        $attributes = Attribute::all();
        return view('admin.categories.edit', compact("attributes", "parentCategories", "category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            "parent_id" => "required",
            "name" => "required",
            "slug" => "required|unique:categories,slug",
            "is_active" => "required",
            "attribute_ids" => "required",
            "attribute_filter_ids" => "required",
            "attribute_variation_id" => "required",
        ]);

        try {
            DB::beginTransaction();
            $category->update([
                "parent_id" => $request->parent_id,
                "name" => $request->name,
                "slug" => $request->slug,
                "icon" => $request->icon,
                "is_active" => $request->is_active,
                "description" => $request->description
            ]);

            $category->attributes()->detach();

            foreach ($request->attribute_ids as $attributeId) {
                $attribute = Attribute::findOrFail($attributeId);

                $attribute->categories()->attach($category->id, [
                    "is_filter" => in_array($attributeId, ($request->attribute_filter_ids != Null ? $request->attribute_filter_ids : [])) ? 1 : 0,
                    "is_variation" => $request->attribute_variation_id == $attributeId ? 1 : 0
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error($e->getMessage(), '??????')->persistent("????????????!");

            return redirect()->back();
        }

        alert()->success('???????? ???????? ???????? ?????? ???????????? ????', '??????????')->persistent("???????? ????!");

        return redirect()->route("admin.categories.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
