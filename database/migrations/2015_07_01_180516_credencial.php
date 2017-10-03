<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Credencial extends AbstractMigration
{

    const TABLE = 'credencial';
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

                $table->increments('id_credencial')->unsigned();
                $table->string('nm_usuario', 100);
                $table->string('ds_nome', 250);
                $table->string('ds_email', 200);
                $table->binary('nr_cpf');
                $table->binary('ds_senha');
                $table->char('st_ativo', 1)->default('I');
                $table->char('st_deletado', 1)->default('N');

                $table->timestamp('dt_criado');
                $table->timestamp('dt_atualizado');

                $table->unique('nm_usuario', 'uk_usuario');
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
