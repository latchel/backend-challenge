<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUrlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url', function (Blueprint $table) {
            $table->bigIncrements('url_id');
            $table->bigInteger('user_id');
            $table->text('name')->nullable();
            $table->text('url')->nullable();
            $table->text('slug')->nullable();

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('url');
    }
}
