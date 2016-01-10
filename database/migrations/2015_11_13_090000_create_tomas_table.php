<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTomasTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('tomas', function(Blueprint $table) {
      $table->increments('id');
      $table->integer('red_id')->nullable()->index();
      $table->integer('user_id')->nullable()->index();
      $table->string('nombre', 100);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('tomas');
  }

}
