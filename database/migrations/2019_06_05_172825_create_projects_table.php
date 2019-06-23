<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('region_id');
            $table->string('title');
            $table->longText('objectives');
            $table->string('partyto');
            $table->string('trust_fund');
            $table->string('co_financing');
            $table->string('duration');
            $table->string('status');
            $table->longText('story')->nullable();
            $table->string('sdgs');
        });

        Schema::create('regions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('class');
        });

        Schema::create('country_project', function (Blueprint $table) {
            $table->integer('country_id');
            $table->integer('project_id');
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('region_id');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('regions');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('country_project');
    }
}
