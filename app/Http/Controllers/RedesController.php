<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Categoria;
use App\Tipo;
use App\Red;
use App\Toma;
use App\Nodo;
use App\Recurso;

class RedesController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getIndex(Request $request)
	{
		$data = array();
		return view('redes.index')->with('data', $data);
	}

    public function getBasicData(Request $request)
    {
        $redes = Red::select(['id', 'nombre'])->where('user_id', $request->user()->id)->get();
        return Datatables::of($redes)
			->addColumn('action', function ($red) {
				$boton_ver = '<a href="'.url('redes/ver/'.$red->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Ver</a>';
                $boton_editar = '<a href="'.url('redes/editar/'.$red->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>';
                $boton_nodo = '<a href="'.url('redes/nodo/'.$red->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Nodo</a>';
                $boton_toma = '<a href="'.url('redes/tomas/'.$red->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Tomas</a>';

                return $boton_ver.'&nbsp;'.$boton_editar.'&nbsp;'.$boton_nodo.'&nbsp;'.$boton_toma;
            })
	        ->make();
    }

	public function getVer(Request $request, $red_id = null)
	{
		$data['categorias'] = Categoria::where('red_id', $red_id)->get()->toHierarchy();
		$data['tipos'] = Tipo::lists('nombre','id');
		$data['red_id'] = $red_id;
		return view('admin.categorias')->with('data', $data);
	}

	public function getTomas(Request $request, $red_id = 0)
	{
		$data['tipos'] 		= Tipo::lists('nombre','id');
		$data['red'] 		= Red::with('tomas','tomas.nodos','tomas.nodos.recurso','tomas.nodos.categoria')->find($red_id) ;
		$categorias = Categoria::where('red_id', $red_id)->get()->toHierarchy();
		

		$simplificado = array(); foreach($categorias as $node) { $simplificado = simplifica($node); }

		$tomas = array();
		foreach ($data['red']->tomas as $toma) {
			$nodos = array();
			foreach ($toma->nodos as $nodo) {
				$nodos[$nodo->categoria_id] = $nodo;
			}
			$tomas[$toma->id] = $nodos;
		}

		$resultado = array();
		foreach ($tomas as $toma_id => $oNodo) {
			foreach($categorias as $node) {
				$resultado[$toma_id] = procesarToma($node, $oNodo); 
			}
		}

/* ini pruebas */
		$resultadoTemp = array();
		foreach ($tomas as $toma_id => $oNodo) {
			echo 'Toma: '.$toma_id.'<br>';
			foreach($categorias as $node) {
				$resultadoTemp[$toma_id] = procesarTomaTemp($node, $oNodo); 
			}
		}
/* fin pruebas */
		
		//dd($resultadoTemp);
		//dd($categorias);
		//dd($tomas);
		//dd($data['red']);
		//dd($resultado);
		dd($simplificado);

		return view('redes.tomas')->with('data', $data);
	}

	public function getEditar(Request $request, $red_id = 0)
	{
		$data['red'] = ( $red_id == 0 ) ? new Red : Red::find($red_id);
		return view('redes.edit')->with('data', $data);
	}

	public function postEditar(Request $request)
	{
    	$red = (empty($request->input('id'))) ? new Red : Red::where('id', '=', $request->input('id'))->first();
    	$red->nombre = $request->input('nombre');
    	$red->user_id = $request->user()->id;
    	$red->save();

    	$cat = Categoria::where('red_id', $red->id)->get();
		if ($cat->isEmpty()) {
			$cat = Categoria::create(['nombre' => 'Categoria Raiz', 'red_id' => $red->id, 'user_id' => $request->user()->id]) ;
			$cat->save();
		}
		//$data['data'] = $cat;
		//return view('vacio')->with('data', $data);
    	return redirect('redes');
	}

	public function getNodo(Request $request, $red_id = 0, $parent_id = null)
	{
		$data['tipos'] 		= Tipo::lists('nombre','id');
		$data['parent_id']	= $parent_id;
		$data['red'] 		= ( $red_id == 0 ) ? new Red : Red::find($red_id) ;
		$data['toma_id']	= null;
		$data['categorias'] = ($parent_id==null) ? Categoria::roots()->with('tipo')->where('red_id', $red_id)->get() : Categoria::find($parent_id)->children()->with('tipo')->get() ;
		
		return view('redes.nodo')->with('data', $data);
	}
	public function postNodo(Request $request, $red_id = 0, $parent_id = null)
	{		
		if ($request->input('accion')=='crear') {

			$categorias = Categoria::where('red_id', $request->input('red_id'))->lists('tipo_id','id');

			if (!empty($request->input('toma_id'))) {
				$toma = Toma::find($request->input('toma_id'));
			} else {
				$toma = new Toma;
				$toma->nombre = time();
				$toma->red_id = $request->input('red_id');
		    	$toma->user_id = $request->user()->id;
		    	$toma->save();
			}

			if ($request->hasFile('nodo')) {
				foreach ($request->file('nodo') as $categoria_id => $uploadedFile) {
					if ($uploadedFile->isValid()) {
						$file_tipo_id 			= $categorias[$categoria_id];
						$upload_path 			= base_path().'/public/uploads/';
						$nombre_archivo 		= str_random(32).'.'.$uploadedFile->getClientOriginalExtension();
						//creo el recurso
					    $recurso = new Recurso;
					    $recurso->nombre		= 'Recurso'; 
						$recurso->tipo_id 		= $file_tipo_id;
						$recurso->user_id 		= $request->user()->id;
					    $recurso->mime_type 	= $uploadedFile->getMimeType();
					    $recurso->filename 		= $nombre_archivo;
					    $recurso->extension 	= $uploadedFile->getClientOriginalExtension();
					    $recurso->path_source 	= $upload_path;
					    //$recurso->path_modified	= $uploadedFile->getClientOriginalName();
      					$movedFile 				= $uploadedFile->move($upload_path, $nombre_archivo);
					    $recurso->save();
					    //creo el nodo
						$nodo = new Nodo;
						$nodo->recurso_id 	= $recurso->id;
						$nodo->toma_id 		= $toma->id;
						$nodo->red_id 		= $request->input('red_id');
						$nodo->user_id 		= $request->user()->id;
						$nodo->categoria_id	= $categoria_id;
						$nodo->tipo_id 		= $file_tipo_id;					
						$nodo->save();

						$recurso->nodo_id = $nodo->id;
					    $recurso->save();

					}
				}
				//dd($request->file());
			}
			foreach ($request->input('nodo') as $categoria_id => $valor) {
		    	$tipo_id = $categorias[$categoria_id];
				$nodo = new Nodo;
				$nodo->toma_id 		= $toma->id;
				$nodo->red_id 		= $request->input('red_id');
				$nodo->user_id 		= $request->user()->id;
				$nodo->categoria_id	= $categoria_id;
				$nodo->tipo_id 		= $tipo_id;

				switch ($tipo_id) {
					case '15': //Fecha
						$nodo->v_fecha			= $valor;
						break;
					case '16': //Fecha Y Hora
					case '17': //Hora
						$nodo->v_fecha_hora		= $valor;
						break;
					case '9':  //Sonido Externo
					case '11': //Imagen Externa
					case '13': //Video Externo
					case '14': //URL
						$nodo->v_url			= $valor;
						break;
					case '1': //Buleano
						$nodo->v_buleana		= $valor;
						break;
					case '2': //Entero
						$nodo->v_entero			= $valor;
						break;
					case '3': //Decimal
					case '6': //Porcentaje
						$nodo->v_decimal		= $valor;
						break;
					case '5': //Texto Grande
						$nodo->v_texto_grande	= $valor;
						break;
					case '19': //Archivo no hago nada porque se procesa anteriormente
						break;
					case '7': //Posición
						$nodo->lat		= $valor['lat'];
						$nodo->lng		= $valor['lng'];
						break;
					default:
						$nodo->v_texto		= $valor;
						break;
				}
				$nodo->save();


			}

			if ($request->input('seguir')=='si') {
				$data['tipos'] 		= Tipo::lists('nombre','id');
				$data['parent_id']	= $parent_id;
				$data['red'] 		= ( $red_id == 0 ) ? new Red : Red::find($red_id) ;
				$data['toma_id']	= $toma->id;
				$data['categorias'] = ($parent_id==null) ? Categoria::roots()->with('tipo')->where('red_id', $red_id)->get() : Categoria::find($parent_id)->children()->with('tipo')->get() ;

				return view('redes.nodo')->with('data', $data);
			} else {
				return redirect('redes/nodo/'.$request->input('red_id'));			
			}
		} elseif ($request->input('accion')=='ingresar') {
			$data['tipos'] 		= Tipo::lists('nombre','id');
			$data['parent_id']	= $parent_id;
			$data['red'] 		= ( $red_id == 0 ) ? new Red : Red::find($red_id) ;
			$data['toma_id']	= $request->input('toma_id');
			$data['categorias'] = ($parent_id==null) ? Categoria::roots()->with('tipo')->where('red_id', $red_id)->get() : Categoria::find($parent_id)->children()->with('tipo')->get() ;

			return view('redes.nodo')->with('data', $data);
		}
	}
}