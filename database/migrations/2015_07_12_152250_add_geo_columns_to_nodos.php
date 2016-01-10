<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGeoColumnsToNodos extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
      Schema::table('nodos', function($table) {
          $table->decimal('lat', 10, 7)->nullable()->index()->after('categoria_id');
          $table->decimal('lng', 10, 7)->nullable()->index()->after('lat');
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
      Schema::table('nodos', function($table) {
          $table->dropColumn('lat');
          $table->dropColumn('lng');
      });
  }

}
