<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayoutsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('layouts', function (Blueprint $table) {
      $table->increments('id');
      $table->string('fileName');
      $table->integer('project_id')->unsigned();
      $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
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
    Schema::dropIfExists('layouts');
  }
}
