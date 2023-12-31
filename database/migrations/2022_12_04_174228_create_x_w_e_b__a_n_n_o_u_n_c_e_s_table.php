<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXWEBANNOUNCESTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('XWEB')->create('XWEB_ANNOUNCE', function (Blueprint $table) {
            $table->id();
            $table->integer('row');
            $table->integer('status')->nullable();
            $table->string('title')->nullable();
            $table->date('date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('XWEB')->dropIfExists('XWEB_ANNOUNCE');
    }
}
