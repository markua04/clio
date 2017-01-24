<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SeriesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Retrieve users details from DB and pass lat and long to url
		$fullSchedule = self::getTodaySchedule();
		$data = array(
			'fullSchedule' => $fullSchedule,
		);

		return view('series', $data);
	}

	public function getTodaySchedule() {

		$date = date("Y-m-d");
		$schedule_url = 'http://api.tvmaze.com/schedule?country=US&date=' . $date;
		$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
		$full_schedule = file_get_contents($schedule_url,false,$context);

		if(isset($full_schedule)){

			$scheduleDataCombined = json_decode($full_schedule);
			$showsCombined = array();
			foreach($scheduleDataCombined as $scheduleData){

				foreach($scheduleData as $show){

					$showName = $show->show->name;
					$showSeason = $show->season;
					$showUrl = $show->url;
					$showEpisode = $show->number;
					$showEpisodeName = $show->name;

					$showsCombined = array(
						"show_name" => $showName,
						"show_episode_name" => $showEpisodeName,
						"show_season" => $showSeason,
						"show_url" => $showUrl,
						"show_episode" => $showEpisode,
					);
				}

			}

			var_dump($showsCombined);

			return $showsCombined;

		} else {

			return null;

		}
	}

}
