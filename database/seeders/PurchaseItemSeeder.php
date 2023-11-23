<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class PurchaseItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items =[
            [
                'name'      => "Item 1",
                'length'    => 2500,
                'width'     => 113,
                'thikness'  => 25,
                'created_by'=> 1,
                'updated_by'=> 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],
            [
                'name'      => "Item 2",
                'length'    => 2985,
                'width'     => 113,
                'thikness'  => 25,
                'created_by'=> 1,
                'updated_by'=> 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],
            [
                'name'      => "Item 3",
                'length'    => 2700,
                'width'     => 113,
                'thikness'  => 25,
                'created_by'=> 1,
                'updated_by'=> 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ]
        ];
        DB::table('purchase_items')->insert($items);
    }
}
