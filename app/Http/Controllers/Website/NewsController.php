<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
class NewsController extends Controller
{
    public function getChildCategory($id_category)
    {
        $data['category_child'] = DB::table('categories')
            ->select('name_cate', 'parent_id')
            ->where('id_category', $id_category)
            ->first();
        $parent_id = $data['category_child']->parent_id;
        $data['category'] = DB::table('categories')
            ->select('id_category', 'uuid', 'name_cate', 'parent_id')
            ->where('id_category', $parent_id)
            ->first();

        return $data;
    }

    public function detailNew(Request $request, $uuid)
    {
        if (!Uuid::isValid($uuid)) {
            return new Response(view('website.modules.error.index'), 404);
        }
        $news = News::where('uuid', $uuid)->firstOrFail();

        // Get cookie
        $cookie_name = $request->ip();

        // Check if the user has the cookie
        $has_cookie = $request->hasCookie($cookie_name);

        if (!$has_cookie) {
            // Set the cookie to expire in 30 seconds
            $cookie = Cookie::make($cookie_name, '1', 30);
        } else {
            // Get the value of the cookie
            $cookie_value = $request->cookie($cookie_name);
            if ($cookie_value >= 2) {
                // Do not increment view count if user refreshes page more than once within 30 seconds
                $cookie = Cookie::make($cookie_name, $cookie_value, 30);
                return redirect()->back();
            } else {
                // Increment view count if user stays on page for more than 30 seconds
                $cookie = Cookie::make($cookie_name, '2', 30);
                $news_view = News::where('uuid', $uuid)->firstOrFail();
                $news_view->increment('new_view');
            }
        }

        $data['detail_new'] = DB::table('news')
            ->join('categories', 'categories.id_category', '=', 'news.category_id')
            ->select('news.*', 'categories.name_cate')
            ->where('news.uuid', $uuid)
            ->first();

        $data['count_comment'] = DB::table('comments')
            ->where('post_id_comment', $uuid)
            ->where('status_comment', 1)
            ->count();
        $category_id = $data['detail_new']->category_id;
        //name category in header
        $data['category_header'] = $this->getChildCategory($category_id);
        //sidebar right of detail
        $data['news_updated'] = DB::table('news')
            ->select('uuid', 'avatar', 'title', 'new_view')
            ->where('status', 1)
            ->orderByDesc('new_view')
            ->limit(6)
            ->get();
        $uuidOfNewUpdated = $data['news_updated']->pluck('uuid')->toArray();
        //featured_posts in bot of detail
        $data['featured_posts'] = DB::table('news')
            ->where('category_id', $category_id)
            ->where('uuid', '!=', $uuid)
            ->where('status', 1)
            ->limit(3)
            ->get();
        $uuidOfFeaturedPost = $data['featured_posts']->pluck('uuid')->toArray();
        //featured_posts in bot 2 of detail
        $data['featured_posts_bot'] = DB::table('news')
            ->join('categories', 'categories.id_category', '=', 'news.category_id')
            ->select('news.*', 'categories.name_cate')
            ->where('news.uuid', '!=', $uuid)
            ->whereNotIn('news.uuid', $uuidOfFeaturedPost)
            ->where('news.status', 1)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        $uuidOfFeaturedPostBot = $data['featured_posts_bot']->pluck('uuid')->toArray();
        //all uuid of detail post
        $uuidOfPostInDetail = array_merge([$uuid], $uuidOfFeaturedPost, $uuidOfFeaturedPostBot, $uuidOfNewUpdated);

        $data['maybeYouLike'] = News::with('category')
            ->whereNotIn('news.uuid', $uuidOfPostInDetail)
            ->where('category_id', $news->category_id)
            ->OrWhere('where_in', $news->where_in)
            ->where('status', 1)
            ->inRandomOrder()
            ->limit(20)
            ->get();
        //show comments
        $data['comments_user'] = DB::table('comments')
            ->join('users', 'users.uuid', '=', 'comments.user_id_comment')
            ->select('users.fullname', 'users.avatar', 'comments.comment', 'comments.post_id_comment', 'comments.created_at')
            ->where('comments.post_id_comment', $uuid)
            ->where('comments.status_comment', 1)
            ->paginate(4);
        //count comment of post
        $data['count_comments'] = Comment::where('post_id_comment', $uuid)
            ->where('status_comment', 1)
            ->count();

        // Share button
        $data['shareButtons'] = \Share::page(url(route('website.detailNew', ['uuid' => $uuid])))
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();

        //make history for user
        if (Auth::user()) {
            $history = DB::table('history')
                ->where('id_post', $uuid)
                ->where('user_id', Auth::user()->uuid)
                ->first();
            if (!$history) {
                $history_user = [
                    'uuid' => Str::uuid(),
                    'id_post' => $uuid,
                    'user_id' => Auth::user()->uuid,
                    'status_history' => 1,
                    'created_at' => now(),
                ];
                DB::table('history')->insert($history_user);
            }
        }

        return view('website.modules.new.detail', $data)->withCookie($cookie);
    }

    public function postComment(Request $request, $id)
    {
        if ($request->comments == null) {
            return back()->with('error', 'Bạn chưa comment sản phẩm');
        } else {
            $data['uuid'] = Str::uuid();
            $data['comment'] = $request->comments;
            $data['user_id_comment'] = Auth::user()->uuid;
            $data['post_id_comment'] = $id;
            $data['created_at'] = new \DateTime();
            $data['status_comment'] = 0;
        }

        DB::table('comments')->insert($data);

        return back()->with('success', 'Đã thêm comment thành công, chúng tôi sẽ xem xét comment của bạn');
    }

    public function savePost($uuid_post)
    {
        $post_save = DB::table('save_post')
            ->where('id_post', $uuid_post)
            ->where('user_id', Auth::user()->uuid)
            ->count();
        if (!Auth::user()) {
            return back()->with('error', 'Vui lòng đăng nhập để sử dụng chức năng này');
        } else {
            if ($post_save == 0) {
                $data = [
                    'uuid' => Str::uuid(),
                    'id_post' => $uuid_post,
                    'user_id' => Auth::user()->uuid,
                    'status_save' => 1,
                    'created_at' => new \DateTime(),
                ];
                DB::table('save_post')->insert($data);
                return back()->with('success', 'Đã lưu bài viết thành công');
            } else {
                return back()->with('success', 'Bạn đã lưu bài viết này rồi');
            }
        }
    }
}
