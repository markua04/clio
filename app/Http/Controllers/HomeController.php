<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\User;
use Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent;
use App\Http\Traits\newsTrait;
use Session;


class HomeController extends Controller
{
	use newsTrait;

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

		$history = self::history();
		$decoded_data = self::weather($location);
		$quotes = self::quotes();
		$sources = array(
				'source1' => 'ign',
				'source2' => 'sky-sports-news',
				'source3' => 'the-lad-bible',
				'source4' => 'time'
		);

		$newsMixed = $this->getNewsVariousSources($sources);

		$data = array(
			'name' => $decoded_data['name'],
			'country' => $decoded_data['sys']['country'],
			'current_temp' => $decoded_data['main']['temp'],
			'humidity' => $decoded_data['main']['humidity'],
			'high' => $decoded_data['main']['temp_max'],
			'low' => $decoded_data['main']['temp_min'],
			'description' => $decoded_data['weather'][0]['description'],
			'id_icon' => $decoded_data['weather'][0]['icon'],
			'history' => $history,
			'news'   => $newsMixed,
			'quote_author' => $quotes['author'],
			'quote' => $quotes['quote'],
		);

		return view('home', $data);
	}

	public function weather($location){
		$url = 'http://api.openweathermap.org/data/2.5/weather?lat='.$location->lat.'&lon='.$lon=$location->long.'&units=metric&appid=747c12fd84b299e633775c9f3d6daed8';
		$json_data = @file_get_contents($url);
		//make sure the file get contents does not fail
		if ($json_data === FALSE) {
			return redirect('edit')->with('key', 'Your connection to the server is not working');
		}

		$decoded_data = json_decode($json_data, true);
		// Check if decoded data is true then display if true or display message if false
		if ($decoded_data['cod'] == 502) {
			return redirect('edit')->with('key', 'You have been redirected to this page because you did not provide a valid location. Please provide a valid location below.');
		}
		return $decoded_data;

	}

	public function history()
	{
		$history_url = 'http://history.muffinlabs.com/date';

		$cachedContent = Cache::get('history');
		if (isset($cachedContent)) {

			$historyData = json_decode($cachedContent);
			$random = array_rand($historyData->data->Events, 1);
			$historyYear = $historyData->data->Events[$random]->year;
			$historyText = $historyData->data->Events[$random]->text;
			$historyLink = $historyData->data->Events[$random]->links[0]->link;
			$historyCombined = array("history_year" => $historyYear, "history_text" => $historyText, "history_link" => $historyLink);
			return $historyCombined;

		} else {
			$json_data = @file_get_contents($history_url);
			Cache::put('history', $json_data, 60);
			$cachedContent = Cache::get('history');
			$historyData = json_decode($cachedContent);
			$random = array_rand($historyData->data->Events, 1);
			$historyYear = $historyData->data->Events[$random]->year;
			$historyText = $historyData->data->Events[$random]->text;
			$historyLink = $historyData->data->Events[$random]->links[0]->link;
			$historyCombined = array("history_year" => $historyYear, "history_text" => $historyText, "history_link" => $historyLink);
			return $historyCombined;
		}

	}

	public function quotes()
	{

		$url = 'http://quotes.rest/qod.json';
		$cachedContent = Cache::get('quotes');

		if (isset($cachedContent)) {
			$quoteData = json_decode($cachedContent);
			$author = $quoteData->contents->quotes[0]->author;
			$quote = $quoteData->contents->quotes[0]->quote;
			$quoteDataNew = array(
					"quote" => $quote,
					"author" => $author
			);
			return $quoteDataNew;
		} else {

			$json_data = @file_get_contents($url);
			Cache::put('quotes', $json_data, 120);
			$cachedContent = Cache::get('quotes');
			$quoteData = json_decode($cachedContent);
			$author = $quoteData->contents->quotes[0]->author;
			$quote = $quoteData->contents->quotes[0]->quote;
			$quoteDataNew = array(
					"quote" => $quote,
					"author" => $author
			);
			return $quoteDataNew;
	}
}

}

