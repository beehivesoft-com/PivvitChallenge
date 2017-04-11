<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $tables = [
            'purchases',
            'offerings',
        ];

        //DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        //DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $this->call(PurchasesTableSeeder::class);
    }
}
