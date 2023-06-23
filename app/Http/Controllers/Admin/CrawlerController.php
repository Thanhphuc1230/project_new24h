<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
require_once app_path() . '/Library/simple_html_dom.php';
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CrawlerController extends Controller
{
    public function featchAllTuoiTre()
{
    $categories = DB::table('categories')
        ->where('status_cate', 1)
        ->get();

    foreach ($categories as $category) {
        $link = $category->link;
        $category_id = $category->id_category;

        if ($category->parent_id == 1) {
            $where_in = $category_id;
        } else {
            $where_in = $category->parent_id;
        }

        try {
            $html = file_get_html($link);
        } catch (\Exception $e) {
            continue; 
        }

        if (!$html) {
            continue;
        }

        $newPostsCount = 0;

        foreach ($html->find('.box-category-item') as $element) {
            // Get the title
            $title_element = $element->find('.box-content-title h3 a', 0);
            $title = $title_element ? $title_element->title : '';
            $href = $title_element ? $title_element->href : '';

            // Check if title exists in the news table
            if (empty($title) || DB::table('news')->where('title', $title)->exists()) {
                continue;
            }

            // Get the intro
            $intro_element = $element->find('.box-category-content p', 0);
            $intro = $intro_element ? $intro_element->plaintext : '';

            // Check if intro exists in the news table
            if (empty($intro) || DB::table('news')->where('intro', $intro)->exists()) {
                continue;
            }

            // Get the image
            $img_element = $element->find('.box-category-link-with-avatar img', 0);
            $img_src = $img_element ? $img_element->src : '';

            if (empty($img_src)) {
                continue;
            }

            // Get the content
            $detail = @file_get_html('https://tuoitre.vn' . $href);

            if (!$detail) {
                continue; // Continue to the next iteration if failed to get content
            }

            $contents = $detail->find('.detail-cmain .detail-content ');
            $content_arr = [];

            foreach ($contents as $content) {
                $content_arr[] = $content->outertext;
            }

            $content = implode('', $content_arr);
            echo '<script>CKEDITOR.instances.editor1.setData("' . $content . '");</script>';

            if (empty($content)) {
                continue;
            }

            DB::table('news')->insert([
                'uuid' => Str::uuid(),
                'title' => $title,
                'content' => $content,
                'intro' => $intro,
                'avatar' => $img_src,
                'author' => 'Tuoi Tre',
                'uuid_author' => Auth::user()->uuid,
                'status' => 0,
                'views' => 0,
                'where_in' => $where_in,
                'category_id' => $category_id,
                'created_at' => now(),
            ]);

            $newPostsCount++;
        }

        $categoryName = DB::table('categories')->where('id_category', $category_id)->value('name_cate');

        if ($newPostsCount == 0) {
            echo 'Cannot get posts of ' . $categoryName;
        } else {
            echo 'Successfully fetched ' . $newPostsCount . ' posts of ' . $categoryName . '<br>';
        }
    }
}

}
