<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LinkHomesToLayout extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('homes', function (Blueprint $table) {
      $table->integer('layout_id')->unsigned()->nullable();
      $table->foreign('layout_id')->references('id')->on('layouts');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('homes', function (Blueprint $table) {
      $table->dropColumn('layout_id');
    });
  }
}
