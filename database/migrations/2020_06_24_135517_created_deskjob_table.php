<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatedDeskjobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deskjobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('classroom_id')->references('id')->on('classroom');
            $table->string('judul', '30');
            $table->longText('petunjuk', '255');
            $table->dateTime('due_date');
            $table->string('slug', '10');
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
        //
    }
}
