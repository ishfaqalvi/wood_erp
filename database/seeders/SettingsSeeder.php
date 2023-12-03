<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'key' 	=> 'company_name',
                'value' => ' نیو پائن ',
            ],
            [
                'key' 	=> 'business_name',
                'value' => ' وڈ مولڈنگ انڈسٹری ',
            ],
            [
                'key'   => 'owner_name',
                'value' => ' ناصر صاحب ',
            ],
            [
                'key'   => 'first_contact_person_name',
                'value' => ' تنویر ناصر ',
            ],
            [
                'key'   => 'first_contact_person_mobile_number',
                'value' => '0303-7728317',
            ],
            [
                'key'   => 'second_contact_person_name',
                'value' => ' وحید ناصر ',
            ],
            [
                'key'   => 'second_contact_person_mobile_number',
                'value' => '0303-4655720',
            ],
            [
                'key'   => 'third_contact_person_name',
                'value' => 'توقیر ناصر ',
            ],
            [
                'key'   => 'third_contact_person_mobile_number',
                'value' => '0300-0479596',
            ],
            [
                'key'   => 'address',
                'value' => ' میں شیخوپورہ روڈ، امین مارکیٹ، حاجی آباد، فیصل آباد ',
            ]
        ]);
    }
}
