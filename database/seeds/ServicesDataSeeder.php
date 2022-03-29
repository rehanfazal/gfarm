<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServicesDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('services')->insert(
            [
                [
                    // 'main_cat_id'  => 1,
                    'name'  => "Dairy Products",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 1,
                    'name'  => "Fruits",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 1,
                    'name'  => "Household Items",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'name'  => "Plumbing",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'name'  => "Electrical",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'name'  => "Carpentry",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'name'  => "Custom Made Furniture",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'name'  => "Handyman",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'name'  => "Appliance Repairs",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'name'  => "Gardening",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'name'  => "Painting",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'name'  => "Moving",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'name'  => "Home Insurance",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'name'  => "Home Cleaning",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'name'  => "Home Decor",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]
            ]
        );
    }
}
