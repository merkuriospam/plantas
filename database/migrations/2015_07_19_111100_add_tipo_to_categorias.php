<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoToCategorias extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
      Schema::table('categorias', function($table) {
          $table->integer('tipo_id')->nullable()->index()->after('depth');
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
      Schema::table('categorias', function($table) {
          $table->dropColumn('tipo_id');
      });
  }

}
