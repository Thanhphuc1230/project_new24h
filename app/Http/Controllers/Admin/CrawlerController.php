<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
require_once(app_path().'/Library/simple_html_dom.php');
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CrawlerController extends Controller
{
    public function index($category_id, $link,$where_in )
    {   
        $html = file_get_html($link);
        $i = 0; 
        foreach ($html->find('.box-category-item') as $element) {
            // get the title
            $title_element = $element->find('.box-content-title h3 a', 0);
            $title = isset($title_element) ? $title_element->title : '';
            $href = isset($title_element) ? $title_element->href : '';

             // check if title exists in the news table
            $existing_title = DB::table('news')->where('title', $title)->exists();
            if ($existing_title) {
                continue;
            }
            
            // get the intro
            $intro_element = $element->find('.box-category-content p', 0);
            $intro = isset($intro_element) ? $intro_element->plaintext : '';
            $existing_intro = DB::table('news')->where('intro', $intro)->exists();
            if ($existing_intro) {
                continue;
            }
            // get the image
            $img_element = $element->find('.box-category-link-with-avatar img', 0);
            $img_src = isset($img_element) ? $img_element->src : '';

            // get the content
            $detail = @file_get_html('https://tuoitre.vn' . $href);
            if (!$detail) {
                continue; // continue to next iteration if failed to get content
            }
            $contents = $detail->find('.detail-cmain .detail-content ');
            $content_arr = [];
            foreach ($contents as $content) {
                $content_arr[] = $content->outertext;
            }
            $content = implode("", $content_arr);
            echo '<script>';
            echo 'CKEDITOR.instances.editor1.setData("'.$content.'");';
            echo '</script>';
            DB::table('news')->insert([
                'uuid' => Str::uuid(),
                'title' => $title,
                'content' => $content,
                'intro' => $intro,
                'avatar' => $img_src,
                'author' => 'Tuoi Tre',
                'uuid_author' => '7555d214-5b5e-4b23-b440-86746ae05851',
                'status' => 0,
                'new_view' => 0,
                'where_in' => $where_in,
                'category_id' => $category_id,
                'created_at' => now()
            ]);
    
          $i++;
        }
        $name = DB::table('categories')->where('id_category',$category_id)->value('name_cate');
        if($i == 0 ){
            echo 'cant get post of '.$name;
        }else{
            echo 'success ' .$i .' post of '.$name.'<br>';
        }
       
    }
    public function featchAllTuoiTre () 
    {
        $result = DB::table('categories')->where('parent_id','=',1 )->get();
        foreach ($result as $item) {
            $link = $item->link;
            $category_id = $item->id_category;
           
            if($item->parent_id == 1){
                $where_in = $item->id_category;
            }else{
                $where_in = $item->parent_id;
            }

            $this->index ($category_id, $link,$where_in );
        }
        //     $link= 'https://tuoitre.vn/tin-moi-nhat.htm';
        //     $category_id = 2;
        //     $where_in = 1;

        // $this->index ($category_id, $link,$where_in );
    }
}
