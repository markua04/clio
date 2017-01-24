<?php
namespace App\Http\Traits;
use Illuminate\Support\Facades\Cache;

trait newsTrait {

    public function getNewsBySource($source){

        $url = 'https://newsapi.org/v1/articles?source='.$source.'&sortBy=latest&apiKey=232e4c6d4d41413bb8974eedf5c28ac5';

        $cachedContent = Cache::get($source);
        if(isset($cachedContent)){
            return $cachedContent;
        } else {
            $json_data = @file_get_contents($url);
            Cache::put($source, $json_data, 1);
            return Cache::get($source);
        }

    }

    public function getNewsVariousSources($sources){

        $newsMixed = array();
        foreach($sources as $source){
            $news = $this->getNewsBySource($source);
            $news2 = json_decode($news, true);
            $y = array_chunk($news2, 1, 1);
            $newsMixedUp = $y['3']['articles'][0];
            array_push($newsMixedUp, array('source' => $source));
            $newsMixed[] = $newsMixedUp;
        }

        return $newsMixed;
    }

}
