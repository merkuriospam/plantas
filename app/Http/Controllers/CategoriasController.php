<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Request;
use App\Categoria;
use App\Tipo;
use App\Red;

class CategoriasController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getIndex()
	{
		$data['categorias'] = Categoria::all()->toHierarchy();
		$data['tipos'] = Tipo::lists('nombre','id');
		return view('admin.categorias')->with('data', $data);
	}

	public function postIndex(Request $request)
	{
		if ($request->isMethod('post')) {
			switch ($request->input('accion')) {
			    case 'nuevo':
			    	$nodoPadre 	= Categoria::where('id', '=', $request->input('padre_id'))->first();
			        $nodoHijo 	= Categoria::create(['nombre' => $request->input('nombre'), 'red_id'=> $request->input('red_id'), 'user_id' => $request->user()->id, 'tipo_id'=>$request->input('tipo_id')]);
			        $nodoHijo->makeChildOf($nodoPadre);
			        break;
			    case 'editar':
			    	$nodoEditar = Categoria::where('id', '=', $request->input('nodo_id'))->first();
			    	$nodoEditar->nombre = $request->input('nombre');
			    	$nodoEditar->tipo_id = $request->input('tipo_id');
			    	$nodoEditar->user_id = $request->user()->id;
			    	$nodoEditar->save();
			        break;
			    case 'mover':
			    	$nodoMover = Categoria::find($request->input('nodo_id'));
			    	if ($request->input('direccion')=='izquierda') {
			    		$nodoMover->moveLeft();
			    	} else {
			    		$nodoMover->moveRight();
			    	}
			    	break;
			    case 'eliminar':
			   		$nodoEliminar = Categoria::find($request->input('nodo_id'));
					$nodoEliminar->delete();
			        break;
			    default:
			}
		}
		$data['categorias'] = Categoria::all()->toHierarchy();
		$data['tipos'] = Tipo::lists('nombre','id');		
		//return view('admin.categorias')->with('data', $data);
		return redirect()->back();
	}

	public function getEjecutar() 
	{
		//Categoria::rebuild(true);
		//$nodoRaiz = Categoria::create(['nombre' => 'Padre Nuestro']);
		//$firstRootNode = Categoria::root();
		//$arbol = $firstRootNode->children()->get();
		/*
		$child1 = $firstRootNode->children()->create(['nombre' => 'Hijo Padre Nuestro 1']);
		$child2 = $firstRootNode->children()->create(['nombre' => 'Hijo Padre Nuestro 2']);
		$child3 = $firstRootNode->children()->create(['nombre' => 'Hijo Padre Nuestro 3']);
		$child4 = $firstRootNode->children()->create(['nombre' => 'Hijo Padre Nuestro 4']);
		*/
		//$nodoPadre = Categoria::find(3);
		//$child1 = $nodoPadre->children()->create(['nombre' => 'Hijo 2 de Hijo Padre Nuestro 2']);

		//$nodos = Categoria::all();
		//$redes = Red::all();

		//$data = array();
		//$nodoMover 	= Categoria::find(7);
		//$nodoRef	= Categoria::find(6);
		//$nodoMover->moveToLeftOf($nodoRef);

		//return view('admin.categorias')->with('data', $data);
		//return view('vacio');		
	}
}
