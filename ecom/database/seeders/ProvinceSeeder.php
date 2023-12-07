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
            // Các tỉnh thành khác
        );

        DB::table('provinces')->insert($provinces);
    }
}
