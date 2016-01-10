<?php

use Illuminate\Database\Seeder;

class TipoTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('tipos')->delete();
 		DB::table('tipos')->insert([ 'id' => 1, 'nombre' => 'Buleano' ]);
 		DB::table('tipos')->insert([ 'id' => 2, 'nombre' => 'Entero' ]);
 		DB::table('tipos')->insert([ 'id' => 3, 'nombre' => 'Decimal' ]);
 		DB::table('tipos')->insert([ 'id' => 4, 'nombre' => 'Texto Pequeño' ]);
 		DB::table('tipos')->insert([ 'id' => 5, 'nombre' => 'Texto Grande' ]);
 		DB::table('tipos')->insert([ 'id' => 6, 'nombre' => 'Porcentaje' ]);
 		DB::table('tipos')->insert([ 'id' => 7, 'nombre' => 'Posición' ]);
 		DB::table('tipos')->insert([ 'id' => 8, 'nombre' => 'Sonido Local' ]);
 		DB::table('tipos')->insert([ 'id' => 9, 'nombre' => 'Sonido Externo' ]);
 		DB::table('tipos')->insert([ 'id' => 10, 'nombre' => 'Imagen Local' ]);
 		DB::table('tipos')->insert([ 'id' => 11, 'nombre' => 'Imagen Externa' ]);
 		DB::table('tipos')->insert([ 'id' => 12, 'nombre' => 'Video Local' ]);
 		DB::table('tipos')->insert([ 'id' => 13, 'nombre' => 'Video Externo' ]);
 		DB::table('tipos')->insert([ 'id' => 14, 'nombre' => 'URL' ]);
 		DB::table('tipos')->insert([ 'id' => 15, 'nombre' => 'Fecha' ]);
 		DB::table('tipos')->insert([ 'id' => 16, 'nombre' => 'Fecha y Hora' ]);
 		DB::table('tipos')->insert([ 'id' => 17, 'nombre' => 'Hora' ]);
 		DB::table('tipos')->insert([ 'id' => 18, 'nombre' => 'Grupo' ]);
 		DB::table('tipos')->insert([ 'id' => 19, 'nombre' => 'Archivo' ]);

	}
}