<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function boot_new()
    {
        $data['local_news'] = $this->getNewsWhereIn(2, 10);
        $data['technology_news'] = $this->getNewsWhereIn(6, 5);
        $data['health_news'] = $this->getNewsWhereIn(11, 5);
        $data['travel_news'] = $this->getNewsWhereIn(7, 5);
        $data['culture_news'] = $this->getNewsWhereIn(8, 5);
        $data['entertainment_news'] = $this->getNewsWhereIn(9, 5);
        $data['sport_news'] = $this->getNewsWhereIn(10, 5);

        $data['most_views'] = News::select('uuid', 'avatar', 'title', 'views')
            ->where('status', 1)
            ->orderByDesc('views')
            ->limit(20)
            ->get();

        return $data;
    }

    private function getNewsWhereIn($whereIn, $limit){
        return News::with('category')
        ->where('status', 1)
        ->where('where_in', $whereIn)
        ->latest('created_at')
        ->limit($limit)
        ->get();

    }

    private function getIdCategory($id)
    {
        $data['new_category'] = Category::select('name_cate', 'id_category')
            ->where('id_category', $id)
            ->first();
        $parent_id = $data['new_category']->id_category;
        $data['breaking_new'] = DB::table('categories')
            ->where('parent_id', $parent_id)
            ->get();
        $id_category = $data['breaking_new']->pluck('id_category')->toArray();
        $category_ids = array_merge([$parent_id], $id_category);

        return [
            'data' => $data,
            'category_ids' => $category_ids,
        ];
    }

    public function index()
    {   

        $data = [];

        $data['breaking_news_left'] = News::with('category')
        ->where('status', 1)
        ->where('hot_new', 1)
        ->limit(4)
        ->latest('created_at')
        ->get();
        
        $uuidOfLeftNews = $data['breaking_news_left']->pluck('uuid')->toArray();
        $data['breaking_news_right'] = News::with('category')
            ->where('status', 1)
            ->whereNotIn('uuid', $uuidOfLeftNews)
            ->where('hot_new', 1)
            ->limit(4)
            ->latest('created_at')
            ->get();

        $data['nation_news'] = $this->getNewsWhereIn(3, 5);
      
        $data['law_news'] = $this->getNewsWhereIn(4, 9);
   
        $data['business_news'] = $this->getNewsWhereIn(5, 9);

        $data['entertainmentAndCulture'] =  $this->getNewsWhereIn(9, 4);
          

        $data['boot_new'] = $this->boot_new();

        return view('website.modules.home.index', $data);
    }

    public function getCategory($id = 0)
    {
        $data['mini_category'] = Category::select('name_cate')
            ->where('parent_id', $id)
            ->get();
        return $data;
    }

    public function category_news($category, $uuid)
    {   
        $id = DB::table('categories')
            ->where('uuid', $uuid)
            ->value('id_category');
        if (!$id) {
            return response()->view('website.modules.error.index', [], 404);
        }
        $data['new_category'] = $this->getIdCategory($id);
        //get id_category of categories and child categories then get new of id_category
        $category_ids = $data['new_category']['category_ids'];
        $data['new_top'] = DB::table('news')
            ->where('category_id', $id)
            ->where('status', 1)
            ->latest('created_at')
            ->paginate(9);
        //get more data of the same type if not enough
        $parentIdOfChild = DB::table('categories')->where('id_category',$category_ids)->value('parent_id');

        $uuidOfNewTop = $data['new_top']->pluck('uuid')->toArray();

        $data['newOfSameTopic'] = News::with('category')
            ->whereIn('category_id', $category_ids)
            ->whereNotIn('uuid', $uuidOfNewTop)
            ->OrWhere('category_id',$parentIdOfChild)
            ->latest('created_at')
            ->where('status', 1)
            ->paginate(15);
        $uuidOfNewMid = $data['newOfSameTopic']->pluck('uuid')->toArray();

      
        $data['boot_new'] = $this->boot_new();

        $data['maybeYouLike'] = News::with('category')
            ->whereNotIn('uuid', $uuidOfNewTop)
            ->whereNotIn('uuid', $uuidOfNewMid)
            ->where('category_id',$id)
            ->where('status', 1)
            ->latest('created_at')
            ->inRandomOrder()
            ->limit(15)
            ->get();
        return view('website.modules.category.category', $data);
    }

    private function getTimeAgoString($seconds) {
        $minutes = floor($seconds / 60);
        if ($minutes < 1) {
            return 'less than a minute ago';
        } else if ($minutes == 1) {
            return '1 phút trước';
        } else if ($minutes < 60) {
            return $minutes . ' phút tước';
        } else if ($minutes < 120) {
            return '1 tiếng trước';
        } else if ($minutes < 1440) {
            return floor($minutes / 60) . ' tiếng trước';
        } else if ($minutes < 2880) {
            return '1 ngày trước ';
        } else {
            return floor($minutes / 1440) . ' ngày trước';
        }
    }


    public function checkUser()
    {
        $mess = 'nếu chưa có tài khoản vui lòng click vào đây để  <a href="' . route('getRegister') . '" style="color: blue">Đăng ký</a>';
        $login = ' <a href="' . route('getLogin') . '" style="color: blue">Đăng nhập </a>';
        return back()->with('error', 'Vui lòng' . $login . 'để sử dụng chức năng ' . $mess);
    }

    public function hotNews(){
 
        return view('website.modules.category.hot_new');
    }

    function loadMoreData(Request $request)
    {
        if ($request->ajax()) {
            $last_id = $request->id_new;
            if ($last_id == 0) {
                $news = News::with('category')
                    ->where('hot_new', 1)
                    ->where('status', 1)
                    ->selectRaw('*, TIMESTAMPDIFF(SECOND, created_at, "' . Carbon::now() . '") as time_diff')
                    ->orderBy('id_new', 'DESC')
                    ->limit(10)
                    ->get();
            } else {
                $news = DB::table('news')
                    ->where('id_new', '<', $last_id)
                    ->where('hot_new', 1)
                    ->where('status', 1)
                    ->selectRaw('*, TIMESTAMPDIFF(SECOND, created_at, "' . Carbon::now() . '") as time_diff')
                    ->orderBy('id_new', 'DESC')
                    ->limit(5)
                    ->get();
            } 

            $output = '';

            if (!$news->isEmpty()) {
                foreach ($news as $item) {
                    $output .= '
                    <div class="content-hot-new">
                    <p><b>'.$this->getTimeAgoString($item->time_diff).'</b></p>
                    <div class="item">
                    <div class="item-image-2"><a class="img-link" href="'.route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'),'uuid' => $item->uuid]).'"><img class="img-responsive img-full"  '.(substr($item->avatar, 0, 8) === "https://" ? 'src="'.$item->avatar.'" ' : 'src="'.asset('images/news/'.$item->avatar).'" ' ).' alt=""></a></div>
                    <div class="item-content">
                      <div class="title-left title-style04 underline04">
                        <h3><a href="'.route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'),'uuid' => $item->uuid]).'"><strong>'.html_entity_decode(Str::words($item->title, 15)).'</strong></a></h3>
                      </div>
                      <p> <i class="fa fa-clock-o"></i> <span class="date"><strong>'.$item->created_at.'</strong></span></p>
                      <p><a href="'.route('website.detailNew', ['name_post' => Str::of($item->title)->slug('-'),'uuid' => $item->uuid]).'">'.Str::words($item->intro, 20).'</a></p>
                    </div>
                  </div>
                    ';
                    
                    $last_id = $item->id_new;
                }
                
                $output .= '<div id="load_more">
                                <button type="button" name="load_more_button" class="btn btn-success form-control" data-id_new="' . $last_id . '" id="load_more_button">Load More</button>
                            </div>';
            } else {
                $output .= '<div id="load_more">
                                <button type="button" name="load_more_button" class="btn btn-info form-control">No Data Found</button>
                            </div>';
            }

            echo $output;
        }
    }

}
