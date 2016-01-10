<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMimeColumnToRecursos extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
      Schema::table('recursos', function($table) {
          $table->string('mime_type',100)->nullable()->after('user_id');
          $table->string('extension',10)->nullable()->after('mime_type');
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
      Schema::table('recursos', function($table) {
          $table->dropColumn('mime_type');
          $table->dropColumn('extension');
      });
  }

}
