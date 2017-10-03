<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Localizacao extends AbstractMigration
{

    const TABLE = 'localizacao';
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

                $table->increments('id_localizacao')->unsigned();
                $table->string('nm_localizacao', 50);
                $table->string('ds_localizacao', 50);

                $table->unique('nm_localizacao', 'uk_localizacao');
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
