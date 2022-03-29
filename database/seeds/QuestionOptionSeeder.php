<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuestionOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_options')->insert(
            [
                [
                    'main_cat_id'  => 3,
                    'sub_cat_id'  => 4,
                    'q_id'  => 1,
                    'classification_id'  =>   1,
                    'activities_id'  => 3,
                    'option_text'  => "3",
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
