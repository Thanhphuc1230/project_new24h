<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;
use App\Models\Category;
use App\Models\News;
class SearchController extends Controller
{
    public function search(Request $request){
    
        $search_text =$request->search;               

        Session::put('key', $search_text);
    
        return redirect()->route('website.searchNow');
    
    }
    public function searchNow(Request $request){
  
        $search_text = Session::get('key');
        $data['key'] = $search_text = Session::get('key');
        $title = News::with('category')
        ->select('news.*', 'categories.name_cate', 'news.uuid as Nuuid')
        ->join('categories', 'news.category_id', '=', 'categories.id_category')
        ->where('title','like','%' . $search_text . '%')
        ->OrWhere('intro','like','%' . $search_text . '%')
        ->OrWhere('name_cate','like','%' . $search_text . '%')
        ->where('status',1)
        ->get();
        $data['count_result'] =$title->count();
        return view('website.modules.search.search',$data,['name'=>$title]);
    }

    public function liveSearch(Request $request){
        $search = $request->get('search');

        $news = News::where(function ($query) use ($search) {
            $query->where('title', 'LIKE', '%'.$search.'%')
                  ->orWhere('intro', 'LIKE', '%'.$search.'%');
        })
        ->where('status', 1)
        ->latest('created_at')
        ->get();

        return response()->json($news);
    }

}
