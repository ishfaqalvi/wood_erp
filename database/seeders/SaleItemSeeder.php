<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class SaleItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            $items[] = [
                'name'      => "Item $i",
                'created_by'=> 1,
                'updated_by'=> 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ];
        }
        DB::table('sale_items')->insert($items);
    }
}
