<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('new_firms_id')->unsigned();
            $table->longText('category');
            $table->longText('areas_for_improvement');
            $table->longText('recommendations_short_term');
            $table->longText('recommendations_long_term');
            $table->string('p');
            $table->longText('remarks');
            $table->string('status');
            $table->longText('results');
            $table->double('cost_of_implementations', 15, 2);
            $table->longText('comments_problems');
            $table->longText('plan_of_action');
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
        Schema::dropIfExists('interventions');
    }
}
