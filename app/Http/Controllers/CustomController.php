<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomController extends Controller
{
    public function index(){
        return view('frontend.index');
    }
    public function whyBCB(){
        return view('frontend.why-bcb');
    }
    public function about(){
        return view('frontend.about');
    }
    public function categories(Request $request)
    {
        $results = DB::table('prod_categories')->orderBy('cat_title')->paginate(8);
        $categories = '';
        if ($request->ajax()) {
            foreach ($results as $result) {
             $categories.='<div class="col-sm-3 col-xs-12">
             <div class="single-product">
                 <div class="product-image">
                     <a href="/product-category/'.$result->cat_slug.'/">
                         <img src="/frontend-assets/assets/categories_products/'.$result->cat_image.'" alt="custom '.str_replace("-", " ", explode(".",$result->cat_image)[0]) .'" title="custom '.str_replace("-", " ", explode(".",$result->cat_image)[0]).'"/>
                     </a>
                 </div>
                 <div class="add-chart-icon">
                     <a href="/product-category/'.$result->cat_slug.'/" class=""><i class="fa fa-eye"></i><span class="add-chart-text">Detail</span></a>
                 </div>
                 <div class="product-info">
                     <h3><a href="/product-category/'.$result->cat_slug.'/">'. $result->cat_title .'</a></h3>
                     <h6>'.DB::table("prod_products_detail")->whereRaw("FIND_IN_SET(".$result->id.", prod_products_detail.cate_id )")->count().'<span> Products</span></h6>
                 </div>
             </div>									
         </div>';
            }
            return $categories;
        }
        return view('frontend.categories');
    }
    public function productQuote(){
        return view('frontend.product-quote-for-price');
    }
    public function contact(){
        return view('frontend.contact');
    }
    public function TermsAndConditions(){
        return view('frontend.terms-and-conditions');
    }
    public function PrivacyPolicy(){
        return view('frontend.privacy-policy');
    }
    public function Disclaimer(){
        return view('frontend.disclaimer');
    }
    // public function productCategory($productcatname){
    //     $categori_id = DB::table('prod_categories')->select('id')->where('cat_slug', '=', $productcatname)->value('id');
    //     $detail_products = DB::table('prod_products_detail')->orderBy('prod_title')->whereRaw("find_in_set('".$categori_id."',prod_products_detail.cate_id)")->where('status', '=', 0)->paginate(8);
    //     return view('frontend.product-category')->with('detail_products',$detail_products);
    // }
    public function productCategory($productcatname){
        $categori_id = DB::table('prod_categories')->where('cat_slug', '=', $productcatname)->first();
        $single_id = $categori_id->id;
        $category_detail = $categori_id->description;
        $detail_products = DB::table('prod_products_detail')->orderBy('prod_title')->whereRaw("find_in_set('".$single_id."',prod_products_detail.cate_id)")->where('status', '=', 0)->paginate(8);
        return view('frontend.product-category')->with(['detail_products' => $detail_products, 'category_detail' => $category_detail]);
    }
   
    public function moreproductCategory(Request $request){
        $current_category = $request->current_category;   
        $page = $request->page; 
        $skip = $page*8;
        $categori_id = DB::table('prod_categories')->select('id')->where('cat_slug', '=', $current_category)->value('id');
        $detail_products = DB::table('prod_products_detail')->orderBy('prod_title')->whereRaw("find_in_set('".$categori_id."',prod_products_detail.cate_id)")->where('status', '=', 0)->skip($skip)->take(8)->get();
        $products_data = '';
        if (!empty($detail_products)) {
            foreach ($detail_products as $result) {
            $products_data.='<div class="col-sm-3 col-xs-12">
            <div class="single-product">
                <div class="product-image">
                    <a href="/product/'.$result->prod_slug.'/"><img src="/frontend-assets/assets/categories_products_old/'.$result->prod_title_image.'" /></a>
                </div>
                <div class="add-chart-icon">
                    <a href="/product/'.$result->prod_slug.'/"><i class="fa fa-eye"></i><span class="add-chart-text">Detail</span></a>
                </div>
                <div class="product-info">
                    <h3><a href="/product/'.$result->prod_slug.'/">'. $result->prod_title .'</a></h3>
                </div>
            </div>									
        </div>';
            }
        }else{
            $products_data = 0;
        }
        return $products_data;
    }
    public function singleProductDetail($singlrproduct){
        $product_id = array();
        $cnew = array();
        $testimonial_arr = array();
        $testim = array();
        $product_id = DB::table('prod_products_detail')->where('prod_slug', '=', $singlrproduct)->first();
        if(!empty($product_id)){

            // for faqs
            $faq_list = DB::table('prod_faqs')->whereRaw("find_in_set('".$product_id->id."',prod_faqs.prod_id)")->get();
                if(!empty($faq_list)){
                    $name1 = '';
                    $designation1 = '';
                    $message1 = '';
                    $delimiter = '|';
                    foreach ($faq_list as $list) {
                        $ques = explode('|',$list->faq_question);
                        $answ = explode('|',$list->faq_answer);
                        $cnew += array_combine($ques, $answ);
                    }
                }

            // for testimonials
            $testim_list = DB::table('prod_testimonials')->whereRaw("find_in_set('".$product_id->id."',prod_testimonials.prod_id)")->get();
                if(!empty($testim_list)){
                    foreach ($testim_list as $item) {
                        $name1 .= $delimiter.$item->name;
                        $designation1 .= $delimiter. $item->designation;
                        $message1 .= $delimiter. $item->message;
                    }
                    $name2 = substr($name1, 1);
                    $designation2 = substr($designation1, 1);
                    $message2 = substr($message1, 1);
                    $testimonial_arr = ['name'=> explode('|',$name2), 'designation'=>explode('|', $designation2), 'message'=> explode('|', $message2)];
                }
            // for relevent products
            $relevent_prod = DB::table('prod_products_detail')->whereRaw("find_in_set('".substr($product_id->cate_id, 0, 1)."',prod_products_detail.cate_id)")->inRandomOrder()->take(4)->get(); 
            return view('frontend.product')->with(['detail_single_product' => $product_id, 'faq_list' => $cnew, 'testimonial_list' => $testimonial_arr, 'relevent_prod' => $relevent_prod ]);
        }else{
            return abort(404);
        }
    }
    public function AllProductsList(Request $request){
        $products_list = DB::table('prod_products_detail')->orderBy('prod_title')->where('status', '=', 0)->paginate(12);

        $products_data = '<div class="shoping-items row" id="data-wrapper">';
        if ($request->ajax()) {
            foreach ($products_list as $result) {
            $products_data.='<div class="col-sm-3 col-xs-12">
            <div class="single-product">
                <div class="product-image">
                    <a href="/product/'.$result->prod_slug.'/"><img src="/frontend-assets/assets/categories_products_old/'.$result->prod_title_image.'" /></a>
                </div>
                <div class="add-chart-icon">
                    <a href="/product/'.$result->prod_slug.'/"><i class="fa fa-eye"></i><span class="add-chart-text">Detail</span></a>
                </div>
                <div class="product-info">
                    <h3><a href="/product/'.$result->prod_slug.'/">'. $result->prod_title .'</a></h3>
                </div>
            </div>									
        </div>';
            }
            $products_data .= '</div>';
            return $products_data;
        }
        return view('frontend.products');
    }
    public function SearchForAll(Request $request){
        $search_request = $request->search;
        $products_list = DB::table('prod_products_detail')->orderBy('prod_title')->where('status', '=', 0)->where('prod_title', 'like', '%' . $search_request . '%')->get();
        $categories_list = DB::table('prod_categories')->orderBy('cat_title')->where('cat_title', 'like', '%' . $search_request . '%')->get();
        $blogs_list = DB::table('blog_post_creates')->orderBy('blog_title')->where('status', '=', 0)->where('blog_title', 'like', '%' . $search_request . '%')->get();
        return view('frontend.search-result')->with(['products_list' => $products_list, 'categories_list' => $categories_list, 'blogs_list' => $blogs_list ]);
    }
    public function SearchProductList(Request $request){
        $search_request = $request->input_value;
        $products_list = DB::table('prod_products_detail')->orderBy('prod_title')->where('prod_title', 'like', '%' . $search_request . '%')->where('status', '=', 0)->get();
        $products_data = '';
        if ($request->ajax()) {
            foreach ($products_list as $result) {
            $products_data.='<div class="col-sm-3 col-xs-12">
            <div class="single-product">
                <div class="product-image">
                    <img src="/frontend-assets/assets/categories_products_old/'.$result->prod_title_image.'" />
                </div>
                <div class="add-chart-icon">
                    <a href="/product/'.$result->prod_slug.'"><i class="fa fa-eye"></i><span class="add-chart-text">Detail</span></a>
                </div>
                <div class="product-info">
                    <h3><a href="/product/'.$result->prod_slug.'">'. $result->prod_title .'</a></h3>
                </div>
            </div>									
        </div>';
            }
            return $products_data;
        }
        return view('frontend.products');
    }
}
