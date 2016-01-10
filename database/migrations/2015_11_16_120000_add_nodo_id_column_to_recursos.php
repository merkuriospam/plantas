<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNodoIdColumnToRecursos extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
      Schema::table('recursos', function($table) {
          $table->integer('nodo_id')->nullable()->index()->after('id');
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
      Schema::table('recursos', function($table) {
          $table->dropColumn('nodo_id');
      });
  }

}
