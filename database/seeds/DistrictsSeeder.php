<?php

use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $i = 1;
        $districts = [
            [
                'id' => 1,
                'name_en' => 'Riyadh',
                'name_ar' => 'الرياض'
            ],
            [
                'id' => 2,
                'name_en' => 'Mecca',
                'name_ar' => 'مكة المكرمة',
            ],
            [
                'id' => 3,
                'name_en' => 'Medina',
                'name_ar' => 'المدينة المنورة'
            ],
            [
                'id' => 4,
                'name_en' => 'Al-Qassim',
                'name_ar' => 'القصيم'
            ],
            [
                'id' => 5,
                'name_en' => 'Eastern',
                'name_ar' => 'الشرقية'
            ],
            [
                'id' => 6,
                'name_en' => 'Asir',
                'name_ar' => 'عسير'
            ],
            [
                'id' => 7,
                'name_en' => 'Tabuk',
                'name_ar' => 'تبوك'
            ],
            [
                'id' => 8,
                'name_en' => 'Hail',
                'name_ar' => 'حائل'
            ],
            [
                'id' => 9,
                'name_en' => 'Northern Border',
                'name_ar' => 'الحدود الشمالية'
            ],
            [
                'id' => 10,
                'name_en' => 'Jazan',
                'name_ar' => 'جازان'
            ],
            [
                'id' => 11,
                'name_en' => 'Najran',
                'name_ar' => 'نجران'
            ],
            [
                'id' => 12,
                'name_en' => 'Al Bahah',
                'name_ar' => 'الباحة'
            ],
            [
                'id' => 13,
                'name_en' => 'Al-Jawf',
                'name_ar' => 'الجوف'
            ],
        ];
        
        District::insert($districts);
    }
}
