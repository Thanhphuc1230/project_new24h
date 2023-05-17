<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        DB::table('categories')->insert([
            [
                'name_cate' => 'Trang chủ',
                'uuid' => Str::uuid(),
                'parent_id' => 1,
                'status_cate' => 1,
                'link'=>null,
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Thời sự',
                'uuid' => Str::uuid(),
                'parent_id' => 1,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/thoi-su.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Thế giới',
                'uuid' =>Str::uuid(),
                'parent_id' => 1,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/the-gioi.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Pháp luật',
                'uuid' => Str::uuid(),
                'parent_id' => 1,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/phap-luat.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Kinh doanh',
                'uuid' => Str::uuid(),
                'parent_id' => 1,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/kinh-doanh.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Công nghệ',
                'uuid' => Str::uuid(),
                'parent_id' => 1,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/cong-nghe.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Du lịch',
                'uuid' => Str::uuid(),
                'parent_id' => 1,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/du-lich.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Văn hóa',
                'uuid' => Str::uuid(),
                'parent_id' => 1,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/van-hoa.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Giải trí',
                'uuid' => Str::uuid(),
                'parent_id' => 1,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/giai-tri.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Thể thao',
                'uuid' => Str::uuid(),
                'parent_id' => 1,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/the-thao.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Sức Khỏe',
                'uuid' => Str::uuid(),
                'parent_id' => 10,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/suc-khoe.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Xã hội',
                'uuid' => Str::uuid(),
                'parent_id' => 2,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/thoi-su/xa-hoi.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Phóng sự',
                'uuid' => Str::uuid(),
                'parent_id' => 2,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/thoi-su/phong-su.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Bình luận',
                'uuid' => Str::uuid(),
                'parent_id' => 3,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/thoi-su/binh-luan.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Muôn màu',
                'uuid' => Str::uuid(),
                'parent_id' => 3,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/the-gioi/muon-mau.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Tư vấn',
                'uuid' => Str::uuid(),
                'parent_id' => 4,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/phap-luat/tu-van.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Pháp lý',
                'uuid' => Str::uuid(),
                'parent_id' => 4,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/phap-luat/phap-ly.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Tài chính',
                'uuid' => Str::uuid(),
                'parent_id' => 5,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/kinh-doanh/tai-chinh.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Doanh Nghiệp',
                'uuid' => Str::uuid(),
                'parent_id' => 5,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/kinh-doanh/doanh-nghiep.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Đầu tư',
                'uuid' => Str::uuid(),
                'parent_id' => 5,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/kinh-doanh/dau-tu.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Thiết bị',
                'uuid' => Str::uuid(),
                'parent_id' => 6,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/cong-nghe/thiet-bi.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Chuyển đổi số',
                'uuid' => Str::uuid(),
                'parent_id' => 6,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/cong-nghe/chuyen-doi-so.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Nhịp sống số',
                'uuid' => Str::uuid(),
                'parent_id' => 6,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/cong-nghe/nhip-song-so.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Cơ hội du lịch',
                'uuid' => Str::uuid(),
                'parent_id' => 7,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/du-lich/co-hoi-du-lich.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Quê hương',
                'uuid' => Str::uuid(),
                'parent_id' => 7,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/du-lich/que-huong.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Sách',
                'uuid' => Str::uuid(),
                'parent_id' => 8,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/van-hoa/van-hoc-sach.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Đời sống',
                'uuid' => Str::uuid(),
                'parent_id' => 8,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/van-hoa/doi-song.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Nghe gì hôm nay',
                'uuid' => Str::uuid(),
                'parent_id' => 9,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/giai-tri/nghe-gi-hom-nay.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Âm nhạc',
                'uuid' => Str::uuid(),
                'parent_id' => 9,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/giai-tri/am-nhac.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Điện ảnh',
                'uuid' => Str::uuid(),
                'parent_id' => 9,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/giai-tri/dien-anh.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Bóng đá',
                'uuid' => Str::uuid(),
                'parent_id' => 10,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/the-thao/bong-da.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Bóng rổ',
                'uuid' => Str::uuid(),
                'parent_id' => 10,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/the-thao/bong-ro.htm',
                'created_at' => $now,
            ],
            [
                'name_cate' => 'Võ thuật',
                'uuid' => Str::uuid(),
                'parent_id' => 10,
                'status_cate' => 1,
                'link'=>'https://tuoitre.vn/the-thao/vo-thuat.htm',
                'created_at' => $now,
            ],
           
        ]);
    }
}
