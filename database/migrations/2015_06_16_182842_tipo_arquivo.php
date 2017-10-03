<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TipoArquivo extends AbstractMigration
{

    const TABLE = 'tipo_arquivo';
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

                $table->increments('id_tipo_arquivo')->unsigned();
                $table->integer('id_extracao')->unsigned();
                $table->integer('id_localizacao')->unsigned();
                $table->char('sg_tipo_arquivo', 5);
                $table->string('nm_tipo_arquivo', 50);
                $table->string('ds_expressao_regular', 70);
                $table->char('st_ativo', 1)->default('A');

                $table->unique('sg_tipo_arquivo', 'uk_tipo_arquivo_sgtipoarquivo');
                $table->unique('ds_expressao_regular', 'uk_tipo_dsexpressaoregl');

                $table->foreign('id_extracao')->references('id_extracao')->on('extracao');
                $table->foreign('id_localizacao')->references('id_localizacao')->on('localizacao');
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
