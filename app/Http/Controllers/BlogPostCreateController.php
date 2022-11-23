<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BlogPostCreate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Redirect;

class BlogPostCreateController extends Controller
{
    public function createBlogPageForm(){
        return view('dashboard.add-new-blogpost');
    }
    public function storeBlogPageForm(Request $request){
        $db_value = new BlogPostCreate;
        $data = $request->all();
        $profileImage = '';
        if ($image = $request->file('blog_title_image')) {
            $destinationPath = 'frontend-assets/assets/blogpost_img/';
            $img_name = $request->file('blog_title_image')->getClientOriginalName();
            $fileName = pathinfo($img_name,PATHINFO_FILENAME);
            // $profileImage = $fileName.date('YmdHis') . uniqid()."." . $image->getClientOriginalExtension();
            $profileImage = $request->blog_slug . uniqid()."." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        $db_value->blog_title = $request->blog_title;
        $db_value->blog_slug = $request->blog_slug;
        $db_value->blog_tag = $request->blog_tags;
        $db_value->blog_des = $request->blog_detail_description;
        $db_value->blog_title_img = $profileImage;
        $db_value->status = '0';
        $db_value->save();
        return Redirect::back()->with('message', 'Data saved successfully!');
        
    }
    // public function showBlogPageList(){
    //  	$blog_detail = DB::table('blog_post_creates')->where('status', '=', '0')->orderBy('created_at', 'DESC')->paginate(5);
    //     return view('frontend.blog')->with('blog_detail',$blog_detail);
    // }
    public function showBlogDetails($blogslug){
        $single_blog_detail = DB::table('blog_post_creates')->where('blog_slug', '=', $blogslug)->first();
        $socialShare = \Share::page(
            'https://www.nicesnippets.com/blog/laravel-custom-foreign-key-name-example',
            'Laravel Custom Foreign Key Name Example',
        )
        ->facebook()
        ->twitter()
        ->reddit()
        ->linkedin()
        ->whatsapp()
        ->telegram();
        return view('frontend.blog', compact('single_blog_detail', 'socialShare'));
    }
    public function checkUniqueSlug(Request $request){
    	$table_name = $request->table_name;
    	$column_name = $request->column_name;
    	$slug_value = $request->slug_value;
        $detail_slug = DB::table($table_name)->where($column_name, '=', $slug_value)->first();
        if (!empty($detail_slug)) {
        	return 1;        
        }
    }
    public function redirectBlog($blogslug){     
        $detail_blogs = DB::table('blog_post_creates')->where('blog_slug', '=', $blogslug)->first();
        if (!empty($detail_blogs)) {
            return redirect('/blog/'.$blogslug);
        }else{
             return abort(404);
        }
    }
    public function DashBlogPostList(){
        $blog_detail = DB::table('blog_post_creates')->orderBy('created_at', 'DESC')->get();
       return view('dashboard.list-of-blogpost')->with('blog_detail',$blog_detail);
   }
   public function DashBlogPostUpdateStatus($param){
    $blogpost_detail = DB::table('blog_post_creates')->where('id', $param)->first();
    if($blogpost_detail->status == 0){
        DB::table('blog_post_creates')->where('id', $param)->update(['status' => 1]);
        return redirect('list-of-blogpost');
    }else{
        DB::table('blog_post_creates')->where('id', $param)->update(['status' => 0]);
        return redirect('list-of-blogpost');
    }

   }
   public function DashBlogPostDelete($param){
    $blogpost_img = DB::table('blog_post_creates')->where('id', $param)->first();
    unlink('frontend-assets/assets/blogpost_img/'.$blogpost_img->blog_title_img);
    DB::table('blog_post_creates')->where(['id' => $param])->delete();
    return redirect('list-of-blogpost');
   }
   public function DashBlogPostEdit($param){
    $blogpost_detail = DB::table('blog_post_creates')->where('id', $param)->first();
    return view('dashboard.edit-blogpost-detail')->with('blogpost_detail',$blogpost_detail);
   }
   public function UpdateBlogPostForm(Request $request){
       $profileImage = '';
       $destinationPath = 'frontend-assets/assets/blogpost_img/';
       if ($image = $request->file('blog_title_image')) {
           $img_name = $request->file('blog_title_image')->getClientOriginalName();
           $fileName = pathinfo($img_name,PATHINFO_FILENAME);
           $profileImage = $request->blog_slug . uniqid()."." . $image->getClientOriginalExtension();
           $image->move($destinationPath, $profileImage);
           $input['image'] = "$profileImage";
       }
       $id = $request->blog_id;
       $blog_title = $request->blog_title;
       $blog_slug = $request->blog_slug;
       $blog_tag = $request->blog_tags;
       $blog_des = $request->blog_detail_description;
       $blog_title_img = $profileImage;
       if ($request->file('blog_title_image')) {
        $blogpost_img = DB::table('blog_post_creates')->where('id', $id)->first();
        DB::table('blog_post_creates')
        ->where('id',$id)
        ->update(['blog_title' => $blog_title, 'blog_slug' => $blog_slug, 'blog_tag' => $blog_tag, 'blog_des' => $blog_des, 'blog_title_img' => $blog_title_img, 'updated_at'=> Carbon::now('Asia/Karachi')]);
        unlink($destinationPath.$blogpost_img->blog_title_img);
       }else{
        DB::table('blog_post_creates')
        ->where('id',$id)
        ->update(['blog_title' => $blog_title, 'blog_slug' => $blog_slug, 'blog_tag' => $blog_tag, 'blog_des' => $blog_des, 'updated_at'=> Carbon::now('Asia/Karachi')]);
       }
       return redirect('list-of-blogpost');

   }
   public function getBlogs(Request $request)
   {
       $results = DB::table('blog_post_creates')->orderBy('created_at', 'DESC')->paginate(5);
       $artilces = '';
       if ($request->ajax()) {
           foreach ($results as $result) {
            $artilces.='<div class="single-blog-box">
            <div class="single-blog-box-img">
                <a href="/blog/'. $result->blog_slug .'/"><img src="/frontend-assets/assets/blogpost_img/'.$result->blog_title_img.'" alt="'.$result->blog_slug .'" /></a>
                </div>
                <div class="blog-content">
                    <h3 class="mt1"><a href="/blog/'. $result->blog_slug .'/">'. $result->blog_title .'</a></h3>
                    <div class="post-meta">
                        <span><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>'. Carbon::parse($result->created_at)->format("d-m-Y H:i") .'</span>
                        <span><i class="fa fa-eye" aria-hidden="true"></i>'. rand ( 10 , 999 ) .'</span>
                    </div>
                    <div class="post-excerpt">
                    <p>'. Str::limit($result->blog_des, 350, $end="...") .'</p>
                    </div>
                </div>
                <div class="read-more-box">
                    <a href="/blog/'. $result->blog_slug .'/" class="read-more">read more<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                </div>
            </div>';
           }
           return $artilces;
       }
       return view('frontend.blogs');
   }
}
