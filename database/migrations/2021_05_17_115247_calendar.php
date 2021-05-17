<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Calendar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id')->unique();
            $table->text('event_name');
            $table->text('event_description');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('event_color');
            $table->integer('user_id');
            $table->boolean('delete');
            $table->timestamp('action_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar');
    }
}
