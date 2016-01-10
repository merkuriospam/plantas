<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecursosTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('recursos', function(Blueprint $table) {
      $table->increments('id');
      $table->integer('tipo_id')->nullable()->index();
      $table->integer('user_id')->nullable()->index();
      $table->string('nombre', 100);
      $table->string('filename', 255);
      $table->string('path_source', 255);
      $table->string('path_modified', 255);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('recursos');
  }

}
