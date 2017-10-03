<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArquivoRecebido extends AbstractMigration
{

    const TABLE = 'arquivo_recebido';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::connection(self::CONNECTION)->hasTable(self::TABLE))
        {
            Schema::connection(self::CONNECTION)->create(self::TABLE, function (Blueprint $table)
            {
                $table->engine = 'InnoDB';

                $table->increments('id_arquivo_recebido')->unsigned();
                $table->integer('id_tipo_arquivo')->unsigned();
                $table->string('nm_arquivo', 100);
                $table->integer('qtd_linhas')->nullable()->unsigned();
                $table->date('dt_recebimento');
                $table->timestamp('dt_hora_cadastro');

                $table->unique('nm_arquivo', 'uk_nmarquivo');

                $table->foreign('id_tipo_arquivo')->references('id_tipo_arquivo')->on('tipo_arquivo');

            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::connection(self::CONNECTION)->hasTable(self::TABLE)) {
            Schema::drop(self::TABLE);
        }
    }
}
