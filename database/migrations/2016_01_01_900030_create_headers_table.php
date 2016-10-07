<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->default('');
            $table->string('keywords')->default('');
            $table->string('description')->default('');
            $table->string('caption')->default('');
            $table->string('image')->default('');

            $table->morphs('headerable');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('headers');
    }
}
