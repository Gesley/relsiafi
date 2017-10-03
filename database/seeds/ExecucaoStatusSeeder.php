<?php

use Illuminate\Database\Seeder;

class ExecucaoStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('RELSIAFI.execucao_status')->insert([
            'nm_execucao_status' => 'Sucesso'
        ]);

        DB::table('RELSIAFI.execucao_status')->insert([
            'nm_execucao_status' => 'Sem sucesso'
        ]);

        DB::table('RELSIAFI.execucao_status')->insert([
            'nm_execucao_status' => 'Arquivo vazio'
        ]);
    }
}
