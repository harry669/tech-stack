<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
          $counter=1;
        for($i=0;$i<2;$i++)
        {
            
            DB::table('product')->insert([
                'pro_name' => Str::random(10),
                'cat_ref' => $counter
            ]);
            $counter++;
        }
       
    }
}
