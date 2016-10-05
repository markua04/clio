<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class NewsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$gaming = 'ign';
		$funny = 'the-lad-bible';
		$skySports = 'sky-sports-news';

		$gamingNews = self::getNewsBySource($gaming);
		$funnyNews = self::getNewsBySource($funny);
		$skySportsNews = self::getNewsBySource($skySports);
		$wallpaper = rand(1,6);

		if(isset($gamingNews) && isset($funnyNews) && isset($skySportsNews)){
			$funny_data = json_decode($funnyNews, true);
			$gaming_data = json_decode($gamingNews, true);
			$skySports_data = json_decode($skySportsNews, true);
			$data = array(
					'gaming_news' => $gaming_data['articles'],
					'funny_news' => $funny_data['articles'],
					'skySports_news' => $skySports_data['articles'],
					'wallpaper' => $wallpaper
			);
			return view('news', $data);
		}

		return view('news');

	}

	public function getNewsBySource($source){

		$url = 'https://newsapi.org/v1/articles?source='.$source.'&sortBy=latest&apiKey=232e4c6d4d41413bb8974eedf5c28ac5';

		$cachedContent = Cache::get($source);
		if(isset($cachedContent)){
			return $cachedContent;
		} else {
			$json_data = @file_get_contents($url);
			Cache::put($source, $json_data, 60);
			return Cache::get($source);
		}

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
