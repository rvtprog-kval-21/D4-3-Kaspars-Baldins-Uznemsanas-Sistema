<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('personal_code');
            $table->string('home');
            $table->string('telephone');
            $table->string('email');
            $table->string('education');
            $table->string('education_code');
            $table->string('education_name');
            $table->string('year');
            $table->json('marks');
            $table->json('relatives');
            $table->bigInteger('speciality_id')->unsigned();
            $table->bigInteger('secondary_speciality_id')->unsigned();
            $table->bigInteger('group_id')->unsigned()->nullable();
            $table->json('info');
            $table->string('document1');
            $table->string('document2');
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
        Schema::dropIfExists('applications');
    }
}
