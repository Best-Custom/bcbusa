<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteMapDataStore;
use Illuminate\Support\Facades\DB;
use Redirect;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class ManageSitemapController extends Controller
{
    public function createSitemapForm(){
        return view('dashboard.add-new-sitemap');
    }
    public function submitSitemapForm(Request $request){
        $db_value = new SiteMapDataStore;
        $db_value->loc = $request->loc;
        $db_value->lastmod = $request->lastmod;
        $db_value->changefreq = $request->changefreq;
        $db_value->priority = $request->priority;
        $db_value->status = '0';
        $db_value->save();
        return Redirect::back()->with('message', 'Data saved successfully!');

    }
    public function listSitemapData(){
        $sitemap_detail = DB::table('sitemap_details')->where('status', '=', '0')->orderBy('created_at', 'DESC')->get();
        return view('dashboard.list-of-sitemap')->with('sitemap_detail',$sitemap_detail);
    }
    public function viewSitemapDetails(){
        $sitemap_detail = DB::table('sitemap_details')->where('status', '=', '0')->get();
        return response()->view('dashboard.sitemap.main', [
            'sitemap_detail' => $sitemap_detail,
        ])->header('Content-Type', 'text/xml');
    }
    public function replaceSitemapFile(){
        $sitemap = Sitemap::create();
        $sitemap_detail = DB::table('sitemap_details')->where('status', '=', '0')->get();
        foreach ($sitemap_detail as $post) {
            $sitemap->add(Url::create("{$post->loc}")->setPriority("{$post->priority}")->setLastModificationDate(Carbon::now('Asia/Karachi'))->setChangeFrequency("{$post->changefreq}"));
        }
        $sitemap->writeToFile(public_path('sitemap.xml'));
        return Redirect::back()->with('message', 'Sitemap successfully replace !');
    }
    public function deleteSitemapURL($id){
        DB::table('sitemap_details')->where(['id' => $id])->delete();
        return Redirect::back()->with('message', 'Sitemap URL deleted !');
    }
    public function editSitemapURL($id){
        $sitemap_url = DB::table('sitemap_details')->where('id', $id)->first();
        return view('dashboard.edit-sitemap-url')->with(['sitemap_url' => $sitemap_url]);
    }
    public function updateSitemapForm(Request $request){
        // print_r($request->all());
        $id = $request->id;
        $loc = $request->loc;
        $lastmod = $request->lastmod;
        $changefreq = $request->changefreq;
        $priority = $request->priority;
        $status = '0';
        DB::table('sitemap_details')
        ->where('id',$id)
        ->update(['loc' => $loc, 'lastmod' => $lastmod, 'changefreq' => $changefreq, 'priority' => $priority, 'updated_at'=> Carbon::now('Asia/Karachi')]);
        return Redirect::back()->with('message', 'Sitemap URL updated !');
    }
}
