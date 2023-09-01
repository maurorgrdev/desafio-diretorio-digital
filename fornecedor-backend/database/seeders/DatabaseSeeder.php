<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\FornecedorModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(FornecedorSeeder::class);
        // FornecedorModel::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'Mauro',
            'email' => 'mauro@gmail.com',
            'password' => bcrypt('senha'),
        ]);
    }
}
