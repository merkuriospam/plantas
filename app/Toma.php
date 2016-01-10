<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Toma extends Model {

	protected $table = 'tomas';
	protected $fillable = ['red_id','user_id','nombre','created_at','updated_at'];

	public function nodos()
	{
		return $this->hasMany('App\Nodo');
	} 	

}