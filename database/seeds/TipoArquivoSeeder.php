<?php

use Illuminate\Database\Seeder;

class TipoArquivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*
         * Registros referentes a extração P40020E2
         */
       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 1,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'NE',
            'nm_tipo_arquivo' => 'Nota de Empenho',
            'ds_expressao_regular' => '^qbdo_(?<extracao>ne)_(?<data>[0-9]{8})\.txt'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 1,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'PE',
            'nm_tipo_arquivo' => 'Pré-empenho',
            'ds_expressao_regular' => '^(?<extracao>PE)(?<data>[0-9]{5,8})'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 1,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'ND',
            'nm_tipo_arquivo' => 'Nota de Dotação',
            'ds_expressao_regular' => '^qbdo_(?<extracao>nd)_(?<data>[0-9]{8})\.txt'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 1,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'NC',
            'nm_tipo_arquivo' => 'Nota de Crédito',
            'ds_expressao_regular' => '^qbdo_(?<extracao>nc)_(?<data>[0-9]{8})\.txt'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 1,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'OB',
            'nm_tipo_arquivo' => 'Ordem Bancária',
            'ds_expressao_regular' => '^qbdo_(?<extracao>ob)_(?<data>[0-9]{8})\.txt'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 1,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'NS',
            'nm_tipo_arquivo' => 'Nota de Sistema',
            'ds_expressao_regular' => '^qbdo_(?<extracao>ns)_(?<data>[0-9]{8})\.txt'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 1,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'NL',
            'nm_tipo_arquivo' => 'Nota de Lançamento',
            'ds_expressao_regular' => '^qbdo_(?<extracao>nl)_(?<data>[0-9]{8})\.txt'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 1,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'GP',
            'nm_tipo_arquivo' => 'Guia da Previdência',
            'ds_expressao_regular' => '^(?<extracao>GP)(?<data>[0-9]{5,8})'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 1,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'DARF',
            'nm_tipo_arquivo' => 'Documento de Arrecadação Federal',
            'ds_expressao_regular' => '^qbdo_(?<extracao>darf)_(?<data>[0-9]{8})\.txt'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 1,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'NT',
            'nm_tipo_arquivo' => 'Nota de Compensação',
            'ds_expressao_regular' => '^(?<extracao>NT)(?<data>[0-9]{5,8})'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 1,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'AF',
            'nm_tipo_arquivo' => 'Apropriação Físico Financeira',
            'ds_expressao_regular' => '^(?<extracao>AF)(?<data>[0-9]{5,8})'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 1,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'PF',
            'nm_tipo_arquivo' => 'Programação Financeira',
            'ds_expressao_regular' => '^qbdo_(?<extracao>pf)_(?<data>[0-9]{8})\.txt'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 1,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'DI',
            'nm_tipo_arquivo' => 'Descrição Item',
            'ds_expressao_regular' => '^(?<extracao>DI)(?<data>[0-9]{5,8})'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 1,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'PTRES',
            'nm_tipo_arquivo' => 'Programa de Trabalho Resumido',
            'ds_expressao_regular' => '^qbto_(?<extracao>ptres)_(?<data>[0-9]{8})\.txt'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 1,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'DAR',
            'nm_tipo_arquivo' => 'Documento de Arrecadação',
            'ds_expressao_regular' => '^qbdo_(?<extracao>dar)_(?<data>[0-9]{8})\.txt'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 1,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'GF',
            'nm_tipo_arquivo' => 'GFIP',
            'ds_expressao_regular' => '^(?<extracao>GF)(?<data>[0-9]{5,8})'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 1,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'RA',
            'nm_tipo_arquivo' => 'Registro de Arrecadação',
            'ds_expressao_regular' => '^qbdo_(?<extracao>ra)_(?<data>[0-9]{8})\.txt'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 1,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'GRU',
            'nm_tipo_arquivo' => 'Guia de Recolhimento da União',
            'ds_expressao_regular' => '^qbdo_(?<extracao>gru_intra)_(?<data>[0-9]{8})\.txt'
       ]);

        /*
         * Registros referentes a extração P40020OU
         */
       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 2,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'CV',
            'nm_tipo_arquivo' => 'Convênio',
            'ds_expressao_regular' => '^(?<extracao>CV)(?<data>[0-9]{5,8})'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 2,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'CA',
            'nm_tipo_arquivo' => 'Convênio Aditivo',
            'ds_expressao_regular' => '^(?<extracao>CA)(?<data>[0-9]{5,8})'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 2,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'CC',
            'nm_tipo_arquivo' => 'Cronograma Convênio',
            'ds_expressao_regular' => '^(?<extracao>CC)(?<data>[0-9]{5,8})'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 2,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'DL',
            'nm_tipo_arquivo' => 'Documento de Liberação de Convênio',
            'ds_expressao_regular' => '^(?<extracao>DL)(?<data>[0-9]{5,8})'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 2,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'DC',
            'nm_tipo_arquivo' => 'Documento de Convênio',
            'ds_expressao_regular' => '^(?<extracao>DC)(?<data>[0-9]{5,8})'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 2,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'EC',
            'nm_tipo_arquivo' => 'Execução Convênio',
            'ds_expressao_regular' => '^(?<extracao>EC)(?<data>[0-9]{5,8})'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 2,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'LC',
            'nm_tipo_arquivo' => 'Lançamento Contábil',
            'ds_expressao_regular' => '^(?<extracao>LC)(?<data>[0-9]{5,8})'
       ]);

       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 2,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'LO',
            'nm_tipo_arquivo' => 'Lista de Ordem Bancária',
            'ds_expressao_regular' => '^(?<extracao>LO)(?<data>[0-9]{5,8})'
       ]);

        /*
         * Registros referentes a extração P40020BX
         */
       DB::table('RELSIAFI.tipo_arquivo')->insert([
            'id_extracao' => 3,
            'id_localizacao' => 1,
            'sg_tipo_arquivo' => 'CD',
            'nm_tipo_arquivo' => 'Crédito Descentralizado e Centralizado',
            'ds_expressao_regular' => '^(?<extracao>CD)(?<data>[0-9]{5,8})'
       ]);
    }
}
