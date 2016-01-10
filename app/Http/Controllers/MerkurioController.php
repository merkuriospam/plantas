<?php 

namespace App\Http\Controllers;
use Storage;
use Socialize;
use Excel;

class MerkurioController extends Controller {

	public function index()
	{
		return view('vacio');
	}

	public function archivo() {
		Storage::disk('local')->put('pepe.txt', 'Hola pibe!');
		return view('vacio');
	}

	// INI Socialite
	// http://laravel.com/docs/5.0/authentication#social-authentication
	public function redirectToProvider()
	{
	    return Socialize::with('facebook')->redirect();
	}

	public function handleProviderCallback()
	{
	    $user = Socialize::with('facebook')->user();
	    
	    // $user->token;

		/*
		// OAuth Two Providers
		$token = $user->token;

		// OAuth One Providers
		$token = $user->token;
		$tokenSecret = $user->tokenSecret;

		// All Providers
		$user->getId();
		$user->getNickname();
		$user->getName();
		$user->getEmail();
		$user->getAvatar();
		*/
	}
	// FIN Socialite

	public function xls() {
		Excel::create('Laravel Excel', function($excel) {
		    $excel->sheet('Excel sheet', function($sheet) {
		        $sheet->setOrientation('landscape');
		    });
		})->export('xls');
	}
}
