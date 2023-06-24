<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Admin\CrawlerController;
require_once app_path() . '../Library/simple_html_dom.php';
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class NewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:new-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Craw data from tuoitre.com';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
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
                if (
                    empty($title) ||
                    DB::table('news')
                        ->where('title', $title)
                        ->exists()
                ) {
                    continue;
                }

                // Get the intro
                $intro_element = $element->find('.box-category-content p', 0);
                $intro = $intro_element ? $intro_element->plaintext : '';

                // Check if intro exists in the news table
                if (
                    empty($intro) ||
                    DB::table('news')
                        ->where('intro', $intro)
                        ->exists()
                ) {
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
                echo '<script>
                    CKEDITOR.instances.editor1.setData("' . $content . '");
                </script>';

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
                    'uuid_author' => 'ca24ce99-cb8b-4a48-bafe-668f151d7f97',
                    'status' => 1,
                    'views' => 0,
                    'where_in' => $where_in,
                    'category_id' => $category_id,
                    'created_at' => now(),
                ]);

                $newPostsCount++;
            }

            $categoryName = DB::table('categories')
                ->where('id_category', $category_id)
                ->value('name_cate');

            if ($newPostsCount == 0) {
                echo 'Cannot get posts of ' . $categoryName;
            } else {
                echo 'Successfully fetched ' . $newPostsCount . ' posts of ' . $categoryName . '<br>';
            }
        }
    }
}
