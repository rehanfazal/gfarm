<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(UserDetailSeeder::class);
        // $this->call(MainCategorySeeder::class);
        // $this->call(SubCategorySeeder::class);
        $this->call(UserRoles::class);
        $this->call(ClassificationSeeder::class);
        $this->call(ActivitiesSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(ServicesDataSeeder::class);
    }
}
