<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

abstract class AbstractMigration extends Migration
{
    const CONNECTION = 'relsiafi';

    abstract public function up();
    abstract public function down();
}
