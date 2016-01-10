<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteColumnsToNodos extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
      Schema::table('nodos', function($table) {
          $table->dropColumn('parent_id');
          $table->dropColumn('lft');
          $table->dropColumn('rgt');
          $table->dropColumn('depth');
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
      Schema::table('nodos', function($table) {
        $table->integer('parent_id')->nullable()->index();
        $table->integer('lft')->nullable()->index();
        $table->integer('rgt')->nullable()->index();
        $table->integer('depth')->nullable();
      });
  }

}
