<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PapelSeeder::class);
        $this->call(PermissaoSeeder::class);

        DB::table('papel_user')->insert(['user_id' => 1,'papel_id' => 1]);
    }
}
