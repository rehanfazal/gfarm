<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('country')->insert(
        //     [
        //         [
        //             'name'  => "",
        //             'status'  => 1,
        //             'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //             'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //         ]
        //     ]
        // );
    }
}
