<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXWEBVIPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('XWEB')->create('XWEB_VIP', function (Blueprint $table) {
            $table->id();
            $table->string('account')->nullable();
            $table->integer('bought')->nullable();
            $table->integer('duration')->nullable();
            $table->string('expires')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('XWEB')->dropIfExists('XWEB_VIP');
    }
}
