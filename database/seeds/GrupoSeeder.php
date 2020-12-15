<?php

use Illuminate\Database\Seeder;
use App\Grupo;
class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grupo::create([
            'nombregrupo'   => "A1"
        ]);

        Grupo::create([
            'nombregrupo'   => "A2"
        ]);

        Grupo::create([
            'nombregrupo'   => "A3"
        ]);
    }
}
