<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SymbolSeeder extends Seeder
{
    /**
     * Seed the symbol DB with the required symbol name.
     * The name column is unique, so running this more tha once will generate an error for duplicate value.
     * Add more symbols if needed.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('symbols')
            ->insert([
                'name' => 'BTCUSD'
            ]);
    }
}
