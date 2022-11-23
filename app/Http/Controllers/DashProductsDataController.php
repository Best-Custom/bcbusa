<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\DB;
use App\Models\ProductslistDetails;
use App\Models\PermProductSpecsStore;
use App\Models\TempProductSpecsStore;
use App\Models\ProductFAQs;
use App\Models\ProductTestimonials;

class DashProductsDataController extends Controller
{
    public function AddNewProduct()
    {
        $categories_detail = DB::table('prod_categories')->get();
        return view('dashboard.add-new-product')->with('categories_detail',$categories_detail);
    }
    public function SavedNewProduct(Request $request)
    {
        $db_value = new ProductslistDetails();
        $prod_spec_value = new PermProductSpecsStore();
        $input = $request->all();
        if ($image = $request->file('prod_title_image')) {
            $destinationPath = 'frontend-assets/assets/categories_products/';
            $profileImage = $request->prod_slug.".".$image->getClientOriginalExtension();
            $img_name = $request->file('prod_title_image')->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        $multi_images = array();
        $count = 1;
        if($files = $request->file('prod_multiple_image')){
            foreach($files as $file){
                $mlt_Image = $request->prod_slug. $count ."." . $file->getClientOriginalExtension();
                $multi_img_name = $file->getClientOriginalName();
                $file->move('frontend-assets/assets/categories_products/',$mlt_Image);
                $multi_images[] = $mlt_Image;
                $count++;
            }
        }
 
        $db_value->cate_id = implode(",",$request->cate_id);
        $db_value->prod_title = $request->prod_title;
        $db_value->prod_slug = $request->prod_slug;
        $db_value->prod_title_image = $profileImage;
        $db_value->prod_multiple_image = implode("|",$multi_images);
        $db_value->prod_short_description = $request->prod_short_description;
        $db_value->prod_detail_description = $request->prod_detail_description;
        $db_value->status = "0";

        $specs_detail = DB::table('prod_temp_specifications')->select('prod_id','specs_name', 'specs_des', 'created_at', 'updated_at')->where(['prod_id' => $request->prod_id])->get();
        foreach($specs_detail as $specs_details){
            DB::table('prod_perm_specifications')->insert(get_object_vars($specs_details));
        }
        DB::table('prod_temp_specifications')->where(['prod_id' => $request->prod_id])->delete();
        $db_value->save();
        return redirect('add-new-product')->with('message', 'Data saved successfully!');
    }
    public function StoreSpecification(Request $request){
        $db_value = new TempProductSpecsStore();
        $db_value->prod_id = $request->prod_id;
        $db_value->specs_des = $request->specs_des;
        $db_value->specs_name = $request->specs_name;
        $db_value->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }
    
    public function ListOfProducts()
    {
        $products_list = DB::table('prod_products_detail')->orderBy('created_at', 'desc')->get();
        return view('dashboard.list-of-products')->with('list_of_products',$products_list);
    }
    public function GetProdSpecification($param){
        $specs_detail = DB::table('prod_temp_specifications')->where(['prod_id' => $param])->get();
        return ($specs_detail);
    }
    public function DeleteCompleteProdDetails($param){
        DB::table('prod_products_detail')->where(['id' => $param])->delete();
        DB::table('prod_perm_specifications')->where(['prod_id' => $param])->delete();
        return redirect('list-of-products');
    }
    public function EditCompleteProdDetails($param){
        $categories_detail = DB::table('prod_categories')->orderBy('created_at', 'desc')->get();
        $product_details = DB::table('prod_products_detail')->where('id', $param)->first();
        $product_specs = DB::table('prod_perm_specifications')->where('prod_id', $param)->get();
        return view('dashboard.edit-product-details')->with(['product_details' => $product_details, 'categories_detail' => $categories_detail, 'product_specifications' => $product_specs ]);
    }
    public function ProdStatusUpdate($param){
        $product_details = DB::table('prod_products_detail')->where('id', $param)->first();
        if($product_details->status == 0){
            DB::table('prod_products_detail')->where('id', $param)->update(['status' => 1]);
            return redirect('list-of-products');
        }else{
            DB::table('prod_products_detail')->where('id', $param)->update(['status' => 0]);
            return redirect('list-of-products');
        }
    }
    public function DeleteProductsSpecs(Request $request){
        DB::table('prod_perm_specifications')->where(['id' => $request->specs_id])->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }
    public function NewPermProductsSpecs(Request $request){
        $db_value = new PermProductSpecsStore();
        $db_value->prod_id = $request->prod_id;
        $db_value->specs_des = $request->specs_des;
        $db_value->specs_name = $request->specs_name;
        $db_value->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }
    public function UpdatePermProductsSpecs(Request $request){
        $specs_id = $request->specs_id;
        $prod_id = $request->prod_id;
        $specs_des = $request->specs_des;
        $specs_name = $request->specs_name;
        DB::table('prod_perm_specifications')
        ->where('id',$specs_id)
        ->update(['prod_id' => $prod_id, 'specs_name' => $specs_name, 'specs_des' => $specs_des, 'updated_at'=> Carbon::now('Asia/Karachi')]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }
    public function DeleteMultipleImg(Request $request){
        $product_id = DB::table('prod_products_detail')->where('id', '=', $request->prod_id)->first();
        $arr_img = explode('|',$product_id->prod_multiple_image);
        if (($key = array_search($request->img_src, $arr_img)) !== false) {
            foreach (array_keys($arr_img, $request->img_src) as $key) {
                unset($arr_img[$key]);
            }
            $updated_name = implode('|',$arr_img);
            DB::table('prod_products_detail')->where('id',$request->prod_id)->update(['prod_multiple_image' => $updated_name]);
            $image_path = public_path("frontend-assets/assets/categories_products/").$request->img_src;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            return response()->json(['success'=>'Slider deleted successfully!']);
        }
        // return response()->json(['success'=>'Slider deleted successfully!']);
    }
    public function UpdateExistProduct(Request $request){
        $get_prod = DB::table('prod_products_detail')->where('id', '=', $request->prod_id)->first();
        $title_img = $get_prod->prod_title_image;
        $multi_images = array();
        $count;
        if ($request->hasFile('prod_title_image')) {
            $image = $request->file('prod_title_image');
            $destinationPath = 'frontend-assets/assets/categories_products_old/';
            $title_img = $request->prod_slug."-".rand(0, 9999).".".$image->getClientOriginalExtension();
            $img_name = $request->file('prod_title_image')->getClientOriginalName();
            $image->move($destinationPath, $title_img);
            $input['image'] = "$title_img";
        }

        foreach(explode('|',$get_prod->prod_multiple_image) as $list){
            $val = explode('.',$list);
            $val_img = substr($val[0], -1);
            array_push($multi_images, $list);
            $count = $val_img;
        }
        $count = $count+1;

        if($files = $request->file('prod_multiple_image')){
            foreach($files as $file){
                $mlt_Image = $request->prod_slug. $count ."." . $file->getClientOriginalExtension();
                $multi_img_name = $file->getClientOriginalName();
                $file->move('frontend-assets/assets/categories_products/',$mlt_Image);
                $multi_images[] = $mlt_Image;
                $count++;
            }
        }

        $prod_id = $request->prod_id;
        $cate_id = implode(",",$request->cate_id);
        $prod_title = $request->prod_title;
        $prod_slug = $request->prod_slug;
        $prod_short_description = $request->prod_short_description;
        $prod_detail_description = $request->prod_detail_description;
        $multiple_images = implode('|', $multi_images);
        DB::table('prod_products_detail')
        ->where('id',$prod_id)
        ->update(['cate_id' => $cate_id, 'prod_title' => $prod_title, 'prod_slug' => $prod_slug, 'prod_short_description' => $prod_short_description, 'prod_detail_description' => $prod_detail_description, 'prod_title_image' => $title_img, 'prod_multiple_image' => $multiple_images, 'updated_at'=> Carbon::now('Asia/Karachi')]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );

    }
    public function StoreProductFAQ(Request $request){
        $db_value = new ProductFAQs();
        $db_value->prod_id = $request->prod_id;
        $db_value->faq_question = $request->faq_question;
        $db_value->faq_answer = $request->faq_answer;
        $db_value->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }
    public function ProductFaqList()
    {
        $product_list = DB::table('prod_products_detail')->get();
        return view('dashboard.add-product-faq')->with('product_list',$product_list);
    }
    public function FetchFAQList(Request $request)
    {
        $row = "";
        $faq_list = DB::table('prod_faqs')->whereRaw("find_in_set('".$request->prod_id."',prod_faqs.prod_id)")->get();
        foreach ($faq_list as $list) {
            $ques = explode('|',$list->faq_question);
            $answ = explode('|',$list->faq_answer);
            $cnew = array_combine($ques, $answ);
            foreach ($cnew as $qus => $ans) {  
                $row .="<tr><td>".$qus."</td><td>".$ans."</td></tr>";
            }
        }
        print_r($row);
    }
    public function ProductTestimonialsList()
    {
        $product_list = DB::table('prod_products_detail')->get();
        return view('dashboard.add-product-testimonials')->with('product_list',$product_list);
    }
    public function StoreProductTestMonials(Request $request){
        // print_r($request->all());
        $db_value = new ProductTestimonials();
        $db_value->prod_id = $request->prod_id;
        $db_value->name = $request->name;
        $db_value->designation = $request->designation;
        $db_value->message = $request->message;
        $db_value->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }
    public function FetchTestimList(Request $request)
    {
        $row = "";
        $testim_list = DB::table('prod_testimonials')->whereRaw("find_in_set('".$request->prod_id."',prod_testimonials.prod_id)")->get();
        foreach ($testim_list as $list) {
            $name = explode('|',$list->name);
            $designation = explode('|',$list->designation);
            $message = explode('|',$list->message);
            for ($i = 0; $i < count($name); $i++)  {  
                $row .="<tr><td>".$name[$i]."</td><td>".$designation[$i]."</td><td>".$message[$i]."</td></tr>";
            }
        }
        print_r($row);
    }
}
