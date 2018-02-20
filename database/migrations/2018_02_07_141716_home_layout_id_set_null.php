<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HomeLayoutIdSetNull extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('homes', function (Blueprint $table) {
      $table->dropForeign(['layout_id']);
      $table->foreign('layout_id')->references('id')->on('layouts')->onDelete(DB::raw('set null'));
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
      $table->dropForeign(['layout_id']);
    });
  }
}
