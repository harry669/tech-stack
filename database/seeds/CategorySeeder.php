<?php

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
        //
        for($i=0;$i<2;$i++)
        {
            DB::table('category')->insert([
                'cat_name' => Str::random(10),
            ]);
        }
       
    }
}
