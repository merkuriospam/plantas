<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Nodo extends Model {

	protected $table = 'nodos';
	protected $fillable = ['toma_id','tipo_id','nombre','user_id','red_id','categoria_id','recurso_id','v_fecha','v_fecha_hora','v_url','v_buleana','v_entero','v_decimal','v_texto_grande','v_texto','lat','lng','created_at','updated_at'];

    public function toma()
    {
        return $this->belongsTo('App\Toma');
    }

	public function recurso()
	{
		return $this->hasOne('App\Recurso');
	}  

	public function categoria()
	{
		return $this->belongsTo('App\Categoria');
	}  
}