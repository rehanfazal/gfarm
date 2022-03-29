<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question')->insert(
            [
                [
                    // 'main_cat_id'  => 3,
                    'service_id'  => 4,
                    'question'  => "What is problem with your pipe(s)?",
                    'info_text'  => "I need to repair / replace my pipe(s)",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'service_id'  => 4,
                    'question'  => "What problems are you having with your drain(s)?",
                    'info_text'  => "I need to replace/repair my drain(s)",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'service_id'  => 4,
                    'question'  => "What is wrong with your toilet?",
                    'info_text'  => "I need to repair/replace my toilet(s)",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'service_id'  => 4,
                    'question'  => "What is wrong with your sink?",
                    'info_text'  => "I need to repair/replace my sink",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'service_id'  => 4,
                    'question'  => "What is wrong with your bathtub?",
                    'info_text'  => "I need to repair/replace my bathtub",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'service_id'  => 4,
                    'question'  => "What is wrong with your tap?",
                    'info_text'  => "I need to repair/replace my tap(s)",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'service_id'  => 4,
                    'question'  => "What appliance is leaking?",
                    'info_text'  => "I need to fix a leaking appliance",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'service_id'  => 4,
                    'question'  => "What is wrong with your geyser?",
                    'info_text'  => "I need to repair/replace my geyser",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'service_id'  => 4,
                    'question'  => "In what room is the leak?",
                    'info_text'  => "I have a leak but I don’t know the origin",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'service_id'  => 4,
                    'question'  => "What is wrong with your tap?",
                    'info_text'  => "I need to repair/replace my shower(s)",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    // 'main_cat_id'  => 3,
                    'service_id'  => 4,
                    'question'  => "What is wrong with your tap?",
                    'info_text'  => "I need to repair/replace my shower(s)",
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]
            ]
        );
    }
}
