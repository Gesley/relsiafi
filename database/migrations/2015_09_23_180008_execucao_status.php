<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExecucaoStatus extends AbstractMigration
{

    const TABLE = 'execucao_status';
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

                $table->increments('id_execucao_status')->unsigned();
                $table->string('nm_execucao_status', 50);
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
