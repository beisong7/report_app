<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->string('scn')->nullable();
            $table->string('status')->nullable();
            $table->string('issue')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('resolved')->nullable();
            $table->date('opened')->nullable();
            $table->integer('call_count')->nullable();
            $table->date('closed')->nullable();
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
        Schema::dropIfExists('phones');
    }
}
