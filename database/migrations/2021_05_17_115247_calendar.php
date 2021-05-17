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
            $table->string('event_id')->unique();
            $table->text('event_name');
            $table->text('event_description');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->string('event_color')->nullable();
            $table->integer('user_id')->nullable();
            $table->boolean('delete')->nullable();
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
