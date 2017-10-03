<?php

use Illuminate\Database\Seeder;

class ExtracaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('RELSIAFI.extracao')->insert([
            'sg_extracao' => 'E2',
            'nm_extracao' => 'P40020E2',
            'ds_extracao' => 'Documentos gerados para o tipo de instrumento de convênios'
        ]);

       DB::table('RELSIAFI.extracao')->insert([
            'sg_extracao' => 'OU',
            'nm_extracao' => 'P40020OU',
            'ds_extracao' => 'Documentos gerados para Orgem Bancária'
        ]);

       DB::table('RELSIAFI.extracao')->insert([
            'sg_extracao' => 'BX',
            'nm_extracao' => 'P40020BX',
            'ds_extracao' => 'Documentos gerados'
        ]);
    }
}
