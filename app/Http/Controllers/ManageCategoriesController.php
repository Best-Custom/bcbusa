<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreCategories;
use Illuminate\Support\Facades\DB;
use Redirect;
use Carbon\Carbon;

class ManageCategoriesController extends Controller
{
    public function createCategoryForm(){
        return view('dashboard.add-new-category');
    }
    public function submitCategoryForm(Request $request){
        $profileImage = "";
        if ($file = $request->file('cat_image')) {
        $profileImage = $request->cat_slug."-".uniqid().".".$file->getClientOriginalExtension();
        $destination = 'frontend-assets/assets/categories_products/';
        $file->move($destination, $profileImage);
        $data['image'] = "$profileImage";
        }
        $db_value = new StoreCategories;
        $db_value->cat_title = $request->cat_title;
        $db_value->cat_slug = $request->cat_slug;
        $db_value->cat_image = $profileImage;
        $db_value->description = $request->description;
        $db_value->save();
        return Redirect::back()->with('message', 'Data saved successfully!');
    }
    public function listOfCategories()
    {
        $category_list = DB::table('prod_categories')->orderBy('cat_title')->get();
        return view('dashboard.list-of-categories')->with('category_list',$category_list);
    }
    public function editOfCategories($param){
        $category_detail = DB::table('prod_categories')->where('id', $param)->first();
        return view('dashboard.edit-category-details')->with(['category_detail' => $category_detail]);
    }
    public function updateCategoryData(Request $request){
        $destination = 'frontend-assets/assets/categories_products/';
        $category_detail = DB::table('prod_categories')->where('id', $request->id)->first();
        $profileImage = $category_detail->cat_image;
        if ($file = $request->file('cat_image')) {
            $profileImage = $request->cat_slug."-".uniqid().".".$file->getClientOriginalExtension();
            $file->move($destination, $profileImage);
            $data['image'] = "$profileImage";
            unlink($destination.$category_detail->cat_image);
        }
        $id = $request->id;
        $cat_title = $request->cat_title;
        $cat_slug = $request->cat_slug;
        $description = $request->description;
        $cat_image = $profileImage;
        DB::table('prod_categories')
        ->where('id',$id)
        ->update(['cat_title' => $cat_title, 'cat_slug' => $cat_slug, 'description' => $description, 'cat_image' => $cat_image, 'updated_at'=> Carbon::now('Asia/Karachi')]);
        return Redirect::back()->with('message', 'Category data updated successfully !');
    }
    public function deleteOfCategory($param){
        DB::table('prod_categories')->where(['id' => $param])->delete();
        return Redirect::back()->with('message', 'Category deleted successfully !');
    }
}
