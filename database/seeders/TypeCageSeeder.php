<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeCageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_cages')->insert(
            [
                'name'      => 'Kucing',
                'alias'     => 'CT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        DB::table('type_cages')->insert(
            [
                'name'      => 'Anjing',
                'alias'     => 'DG',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        DB::table('type_cages')->insert(
             [
                'name'      => 'Perkawinan',
                'alias'     => 'BR',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
    }
}
