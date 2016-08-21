<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\User;
use Auth;
use Illuminate\Database\Eloquent;
use Session;


class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for refractor that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	// * Only display the weather if the user is logged in *
	public function __construct()
	{
		$this->middleware('auth', ['only' => 'weather']);
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Retrieve users details from DB and pass lat and long to url

		$id = Auth::user()->id;
		$location = User::find($id);
		$location->long;
		$location->lat;

			$url = 'http://api.openweathermap.org/data/2.5/forecast/daily?lat='.$location->lat.'&lon='.$location->long.'&units=metric&cnt=7&APPID=747c12fd84b299e633775c9f3d6daed8';

			$json_data = @file_get_contents($url);
			//make sure the file get contents does not fail
			if($json_data === FALSE){
				return redirect('edit')->with('key','Your connection to the server is not working');
			}
			$json_data = file_get_contents($url);
			$decoded_data = json_decode($json_data, true);

			// Check if decoded data is true then display if true or display message if false
			if($decoded_data['cod'] == 404) {
				return redirect('edit')->with('key', 'You have been redirected to this page because you did not provide a valid location. Please provide a valid location below.');
			}

			$json_string = file_get_contents('http://api.openweathermap.org/data/2.5/forecast/daily?lat='.$location->lat.'&lon='.$location->long.'&units=metric&cnt=7&APPID=747c12fd84b299e633775c9f3d6daed8');
			$weekly['list'] = json_decode($json_string, true);
			$data = array(
					'name' => $decoded_data['city']['name'],
					'temps' => $decoded_data['list'][0]['temp'],
					'weather' => $decoded_data['list'][0]['weather'],
					'id_icon' => $decoded_data['list'][0]['weather'][0]['icon'],
			);

		return view('home', $data);
	}

}
