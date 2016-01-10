<?php 

namespace App\Http\Controllers;
use Storage;
use Response;
use PDF;

class TcpdfController extends Controller {

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		PDF::SetTitle('Hello World');
		PDF::AddPage();
		PDF::Write(0, 'Hello World');
		PDF::Output('hello_world.pdf');
		//return view('vacio');
	}
	public function archivo()
	{
		PDF::setPrintHeader(false);
		PDF::setPrintFooter(false);
		PDF::SetTitle('Titulo Evento');
		PDF::AddPage();
		PDF::Write(0, 'Entrada');

		$style = array(
		    'border' => 2,
		    'vpadding' => 'auto',
		    'hpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255)
		    'module_width' => 1, // width of a single module in points
		    'module_height' => 1 // height of a single module in points
		);

		PDF::write2DBarcode('963852741', 'QRCODE,L', 20, 30, 50, 50, $style, 'N');

		$public_path = public_path();

		PDF::Image($public_path.'/images/mercurio.jpg', 20, 100, 80, 80);
		$archivo = PDF::Output('hello_world.pdf','S');

		$carpeta = 'carpetingui';
		if (!Storage::exists($carpeta)) { Storage::makeDirectory($carpeta); }
		Storage::disk('local')->put($carpeta.'/hello_world.pdf', $archivo);
		return view('vacio');
	}

	public function descargar() {
		$storage_path = storage_path();
		return response()->download($storage_path.'/app/hello_world.pdf');
	}

}
