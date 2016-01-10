<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoriaIdToNodos extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
      Schema::table('nodos', function($table) {
          $table->integer('categoria_id')->nullable()->index()->after('red_id');
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
      Schema::table('nodos', function($table) {
          $table->dropColumn('categoria_id');
      });
  }

}
