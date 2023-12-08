<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = array(
            array('provinceCode' => 'TPHCM', 'provinceName' => 'Thành phố Hồ Chí Minh'),
            array('provinceCode' => 'HNOI', 'provinceName' => 'Hà Nội'),
            array('provinceCode' => 'DNANG', 'provinceName' => 'Đà Nẵng'),
            array('provinceCode' => 'QNGAI', 'provinceName' => 'Quảng Ngãi'),
            array('provinceCode' => 'DNAI', 'provinceName' => 'Dồng Nai'),
            array('provinceCode' => 'KHOA', 'provinceName' => 'Khánh Hòa'),
            array('provinceCode' => 'LDONG', 'provinceName' => 'Lâm Đồng'),
            array('provinceCode' => 'HGIANG', 'provinceName' => 'Hà Giang'),
            array('provinceCode' => 'BLIEU', 'provinceName' => 'Bạc Liêu'),
            array('provinceCode' => 'CMAU', 'provinceName' => 'Cà Mau'),
            array('provinceCode' => 'VLONG', 'provinceName' => 'Vĩnh Long'),
            array('provinceCode' => 'TVINH', 'provinceName' => 'Trà Vinh'),
            array('provinceCode' => 'BTHUAN', 'provinceName' => 'Bình Thuận'),
           
            // Các tỉnh thành khác
        );
  // CHẠY LỆNH php artisan db:seed --class=ProvinceSeeder
        DB::table('provinces')->insert($provinces);
    }
}
