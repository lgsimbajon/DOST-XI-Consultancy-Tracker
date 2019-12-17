<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewFirmsTable extends Migration
{
    public function up()
    {
        Schema::create('new_firms', function (Blueprint $table) {
            $table->increments('id');

            $table->string('province');

            $table->string('beneficiary');

            $table->integer('cy_approvedsu');

            $table->string('mpex')->nullable();

            $table->string('cpt')->nullable();

            $table->string('gmp_assessment')->nullable();

            $table->string('gmp_seminar')->nullable();

            $table->string('plant_layout_design')->nullable();

            $table->string('gmp_manual')->nullable();

            $table->string('energy_audit')->nullable();

            $table->string('packaging_labeling')->nullable();

            $table->string('campi')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
