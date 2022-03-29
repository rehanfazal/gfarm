<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_details')->insert(
            [
                [
                    'first_name'  => "Super",
                    'last_name'  => "Admin",
                    'user_id'  => 1,
                    'country_id'  => 92,
                    'status'  => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]
            ]
        );
    }
}
