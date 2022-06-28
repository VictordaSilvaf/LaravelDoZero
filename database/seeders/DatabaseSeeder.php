<?php

namespace Database\Seeders;

use Database\Factories\PropostaFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        /* $this->call(UserTableSeeder::class); */
        $this->call(PropostaFactory::class);
    }
}
