<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAlertsTable extends Migration
{
    public function up()
    {
        Schema::create('user_alerts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('alert_text')->nullable();

            $table->string('alert_link')->nullable();

            $table->date('start_date')->nullable();

            $table->time('start_time')->nullable();

            $table->date('end_date')->nullable();

            $table->time('end_time')->nullable();

            $table->string('activity_venue')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
