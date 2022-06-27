<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        \App\Models\Account::create([
            "number_account" => "000001",
            "balance" => 25000,
            "email" => "cuenta01@banco.com"
        ]);

        \App\Models\Account::create([
            "number_account" => "000002",
            "balance" => 35000,
            "email" => "cuenta02@banco.com"
        ]);

        \App\Models\Account::create([
            "number_account" => "000003",
            "balance" => 40000,
            "email" => "cuenta03@banco.com"
        ]);
    }
}
