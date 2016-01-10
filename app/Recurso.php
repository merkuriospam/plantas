<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model {

	protected $table = 'recursos';
	protected $fillable = ['tipo_id','user_id','mime_type','extension','nombre','filename','path_source','path_modified','created_at','updated_at'];

}