<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Red extends Model {

	protected $table = 'redes';
	protected $fillable = ['nombre','user_id'];

	public function tomas()
	{
		return $this->hasMany('App\Toma');
	}	

}