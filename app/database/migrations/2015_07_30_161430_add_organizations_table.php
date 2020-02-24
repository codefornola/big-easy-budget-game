<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('budget_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->nullable()->index();
            $table->string('name')->index();
            $table->integer('units_min');
            $table->integer('units_previous_period');
            $table->boolean('is_active')->index();
            $table->text('short_description');
            $table->longText('full_description');
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
        Schema::dropIfExists('organizations');
    }
}
