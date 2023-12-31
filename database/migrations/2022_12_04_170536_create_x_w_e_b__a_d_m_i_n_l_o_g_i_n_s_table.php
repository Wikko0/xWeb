<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXWEBADMINLOGINSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('XWEB')->create('XWEB_ADMINLOGIN', function (Blueprint $table) {
            $table->id();
            $table->string('admin')->nullable();
            $table->string('password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('XWEB')->dropIfExists('XWEB_ADMINLOGIN');
    }
}
