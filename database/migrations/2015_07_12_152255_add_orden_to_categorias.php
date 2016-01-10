<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrdenToCategorias extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
      Schema::table('categorias', function($table) {
          $table->integer('orden')->nullable()->index()->after('depth');
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
      Schema::table('categorias', function($table) {
          $table->dropColumn('orden');
      });
  }

}
