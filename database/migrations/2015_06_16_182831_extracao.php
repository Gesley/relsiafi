<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Extracao extends AbstractMigration
{

    const TABLE = 'extracao';
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

                $table->increments('id_extracao')->unsigned();
                $table->char('sg_extracao', 2);
                $table->string('nm_extracao', 8);
                $table->string('ds_extracao', 100);
                $table->char('st_ativo', 1)->default('A');

                $table->unique('sg_extracao', 'uk_extracao_sgextracao');
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
