<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->boolean('is_active');
            $table->date('opened_at')->nullable();
            $table->date('closed_at')->nullable();
            $table->string('units_label');
            $table->integer('units_value');
            $table->integer('units_total');
            $table->boolean('require_spend_all');
            $table->string('video_provider')->nullable();
            $table->string('video_id')->nullable();
            $table->string('survey_provider')->nullable();
            $table->string('survey_id')->nullable();
            $table->longText('description');
            $table->timestamps();

            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budgets');
    }
}
