<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_category')->insert(
            [
                [
                    // 'main_cat_id'  => 1,
                    'category_name'  => "Dairy Products",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 1,
                    'category_name'  => "Fruits",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 1,
                    'category_name'  => "Household Items",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'category_name'  => "Plumbing",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'category_name'  => "Electrical",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'category_name'  => "Carpentry",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'category_name'  => "Custom Made Furniture",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'category_name'  => "Handyman",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'category_name'  => "Appliance Repairs",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'category_name'  => "Gardening",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'category_name'  => "Painting",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'category_name'  => "Moving",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'category_name'  => "Home Insurance",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'category_name'  => "Home Cleaning",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'category_name'  => "Home Decor",
                    'image'  => "",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]
            ]
        );
    }
}
