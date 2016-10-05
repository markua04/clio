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
        Cache::put($source, $json_data, 60);
        return Cache::get($source);
    }

}
}