<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Auditoria extends AbstractMigration
{

    const TABLE = 'auditoria';
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

                $table->increments('id_auditoria')->unsigned();
                $table->integer('id_credencial')->unsigned();
                $table->integer('id_tipo_arquivo')->unsigned();
                $table->integer('id_arquivo_recebido')->nullable()->unsigned();
                $table->integer('id_execucao_status')->unsigned();
                $table->timestamp('dt_execucao');

                $table->foreign('id_credencial')->references('id_credencial')->on('credencial');
                $table->foreign('id_tipo_arquivo')->references('id_tipo_arquivo')->on('tipo_arquivo');
                $table->foreign('id_arquivo_recebido')->references('id_arquivo_recebido')->on('arquivo_recebido');
                $table->foreign('id_execucao_status')->references('id_execucao_status')->on('execucao_status');
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
