<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValueColumnsToNodos extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
      Schema::table('nodos', function($table) {

          $table->integer('recurso_id')->nullable()->index()->after('categoria_id');
          $table->date('v_fecha')->nullable()->after('recurso_id');
          $table->dateTime('v_fecha_hora')->nullable()->after('v_fecha');
          $table->string('v_url', 255)->nullable()->after('v_fecha_hora');
          $table->boolean('v_buleana')->nullable()->after('v_url');
          $table->integer('v_entero')->nullable()->after('v_buleana');
          $table->decimal('v_decimal', 5, 2)->nullable()->after('v_entero');
          $table->text('v_texto_grande')->nullable()->after('v_decimal');
          $table->string('v_texto', 255)->nullable()->after('v_texto_grande');

      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
      Schema::table('nodos', function($table) {

          $table->dropColumn('recurso_id');
          $table->dropColumn('v_fecha');
          $table->dropColumn('v_fecha_hora');
          $table->dropColumn('v_url');
          $table->dropColumn('v_buleana');
          $table->dropColumn('v_entero');
          $table->dropColumn('v_decimal');
          $table->dropColumn('v_texto_grande');
          $table->dropColumn('v_texto');


      });
  }

}
