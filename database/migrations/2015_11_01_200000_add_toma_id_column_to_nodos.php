<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTomaIdColumnToNodos extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
      Schema::table('nodos', function($table) {
          $table->integer('toma_id')->nullable()->index()->after('id');;
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
      Schema::table('nodos', function($table) {
          $table->dropColumn('toma_id');
      });
  }

}
