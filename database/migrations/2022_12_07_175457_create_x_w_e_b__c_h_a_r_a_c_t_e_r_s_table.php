<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXWEBCHARACTERSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('XWEB')->create('XWEB_CHARACTERS', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('class')->nullable();
            $table->integer('wins')->nullable();
            $table->string('status')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('XWEB')->dropIfExists('XWEB_CHARACTERS');
    }
}
