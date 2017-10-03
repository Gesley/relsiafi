<?php

use Illuminate\Database\Seeder;

class LocalizacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('RELSIAFI.localizacao')->insert([
            'nm_localizacao' => 'Servidor Interno',
            'ds_localizacao' => 'misrv35'
        ]);

       DB::table('RELSIAFI.localizacao')->insert([
            'nm_localizacao' => 'STA',
            'ds_localizacao' => 'https://sta.tesouro.fazenda.gov.br/pcasp/index.asp'
       ]);
    }
}
