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
    	$this->call(UsersTableSeeder::class); // php artisan db:seedclass= --UsersTableSeeder
    	$this->call(DiariesTableSeeder::class); // php artisan db:seedclass= --DiariseTableSeeder

    }
}
