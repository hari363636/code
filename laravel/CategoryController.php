<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Helpers\Helpers;

class CategoryController extends Controller
{
    public function index()
    {
            $category = Category::withTrashed();
            $category = $category->get();
        return view('category.index', compact('category'));
    }
    public function AddCategory()
    {
        return view('category.add');
    }

    public function CreateCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:category',
            'image' => 'required',
                ], [
            'name.required' => 'Please enter Name.',
            'name_arabic.required' => 'Please enter Arabic Name.',
            'image.required' => 'Please upload image.',
        ]);

        $category = $request->all();

        $fileName = "";
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = Helpers::imageUpload($image, 'category');
        }
        $category["image"] = $fileName;

        $success = Category::create($category);

        $success->translateOrNew('ar')->name = $request->name_arabic;
        $success->save();

        if ($success) {
            return redirect()->route("category");
        } else {
            return redirect()->back();
        }
    }
    public function index_SubCategory()
    {
        $sub_category = SubCategory::withTrashed()->get();
        return view('sub_category.index', compact('sub_category'));
    }
    public function AddSubCategory()
    {
        $sub_category = Category::get();
        return view('sub_category.add', compact('sub_category'));
    }

    public function CreateSubCategory(Request $request)
    {
        app()->setLocale('en');

        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'name_arabic' => 'required',
            'sub_image' => 'required',
                ], [
            'category_id.required' => 'Please Select category.',
            'name.required' => 'Please enter Name.',
            'name_arabic.required' => 'Please enter arabic Name.',
            'sub_image.required' => 'Please upload image.',
        ]);

     $sub_check = SubCategory::where('category_id',$request->category_id)
                ->whereHas('translations',function($query) use ($request){
                    $query->where('name','=', $request->name);
                })->with('translations')->first();


        if($sub_check){
         session(['exists' =>'Sub-category exist with same name.']);
      return redirect()->back();
     }
        $category = $request->all();
        $fileName = "";
        if ($request->hasFile('sub_image')) {
            $image = $request->file('sub_image');
            $fileName = Helpers::imageUpload($image, 'subcategory');
        }
        $category["image"] = $fileName;
        $success = SubCategory::create($category);

        $success->translateOrNew('ar')->name = $request->name_arabic;
        $success->save();
        if ($success) {
            return redirect()->route("sub_category");
        } else {
            return redirect()->back();
        }
    }

    public function EditCategory($id)
    {
        $cat = Category::where("id", $id)->with('translations')->withTrashed()->first();

        return view(
            "category.edit",
            compact("cat")
        );

    }

    public function UpdateCategory($id, Request $request)
    {
        $find = Category::withTrashed()->find($id);
        $category = $request->all();

        $success = $find->update($category);
         $find->translateOrNew('ar')->name = $request->name_arabic;
        $find->save();

        if ($request->hasFile('cat_image')) {
            if(file_exists(''.$find->image)){

            \unlink(''.$find->image);
          }

            $image = $request->file('cat_image');
            $fileName = Helpers::imageUpload($image, 'category');
            $find->image = $fileName;
            $find->save();
        }

        if ($success) {
            return redirect()->route("category");
        } else {
            return redirect()->back();
        }
    }
    public function DeleteCategory($id)
    {
//      $category = Product::where('id', $id)->delete();

        $category = Category::where('id', $id)->withTrashed()->first();

        if($category->trashed()){
            $category->deleted_at = null;
            $category->save();
        }
        else{
            $category->delete();
        }

//      $data['status'] = 'sucess';
//      return response()->json($data);
        return redirect()->back()->with('updated','Enabled/Disabled Sucessfully.');
    }

    public function EditSubCategory($id)
    {
        $cat = SubCategory::where("id", $id)->withTrashed()->first();

         return view(
            "sub_category.edit",
            compact("cat"  )
        );
    }

    public function UpdateSubCategory($id, Request $request)
    {
        $find = SubCategory::find($id);
        $category = $request->all();
        $success = $find->update($category);
        $find->translateOrNew('ar')->name = $request->name_arabic;
        $find->save();


        if ($request->hasFile('cat_image')) {
            if(file_exists(''.$find->image)){

                \unlink(''.$find->image);
            }

            $image = $request->file('cat_image');
            $fileName = Helpers::imageUpload($image, 'subcategory');
            $find->image = $fileName;
            $find->save();
        }

        if ($success) {
            return redirect()->route("sub_category");
        } else {
            return redirect()->back();
        }
    }
    public function DeleteSubCategory($id)
    {

      $category = SubCategory::where('id', $id)->withTrashed()->first();

        if($category->trashed()){
            $category->deleted_at = null;
            $category->save();
        }
        else{
            $category->delete();
        }

        return redirect()->back()->with('updated','Enabled/Disabled Sucessfully.');

//      $data['status'] = 'sucess';
//      return response()->json($data);
    }

    public function getSubCategory(Request $request)
    {
        $sub_category = SubCategory::where('category_id', $request->category_id)->get();
        return $sub_category;
    }
}
