@extends('homeapp')

@section('content')
	<body class="body-image" style="background-image: url({{ url() }}/images/weather/{{ $id_icon }}.png);">
	<div class="container">
	</div>
	@include('partials.nav')
<div class="container background-image">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>
				<div class="row">
					<div class="col-lg-8">
						<div class="heading-content">
							<b>This day in History</b>
						</div>
						<div class="history-content history-box">
							@if($history != null)
								<img class="history-image" style="width:190px;height:auto;" src="/images/todayinhistory.jpg" alt="history" >
								<p>Year : {{ $history['history_year'] }}</p>
								<p>Historical Data : {{ $history['history_text'] }}</p>
								<a href="{{ $history['history_link'] }}">View Article</a>
							@else
								No History available for today. Please notify admin.
							@endif
						</div>
					</div>
					<div class="col-lg-4">
						<div class="heading-content-right">
							<b>News updates</b>
						</div>
						<div class="row-scroller" id="scrollContainer">
							<div id="scrollBox">
								@if(isset($news))
									@foreach($news as $news_article)
										<div style="text-align:center;margin-bottom:10px;" class="scroll-box-content">
											<a target="blank" href="{{ $news_article['url'] }}">
												@if($news_article['urlToImage'] == '')
													@if(strpos($news_article['url'], 'skysports') == true)
														<img class="news-image-resp img-responsive" style="width:auto; max-height:115px !important; margin: 0 auto;" src="/images/logo/skysports.jpg">
													@elseif(strpos($news_article['url'], 'ladbible') == true)
														<img class="news-image-resp img-responsive" style="width:auto; max-height:150px; margin: 0 auto;" src="/images/logo/ladbible.png">
													@endif
												@else
													<img class="news-image-resp img-responsive" style="width:auto; max-height:110px; margin: 0 auto;" src="{{ $news_article['urlToImage'] }}">
												@endif
											</a>
											<h4 class="news-articles-header">{{ strtoupper(str_replace('-',' ', $news_article[0]['source'])) }}</h4>
											<div style ="word-break:break-all;" class="content-text">
												@if(strlen($news_article['title']) > 60)
												<a target="blank" href="{{ $news_article['url'] }}">{{ substr($news_article['title'], 0, 80) }}</a>
												@else
												<a target="blank" href="{{ $news_article['url'] }}">{{ substr($news_article['title'], 0, 80) }} - {{ substr($news_article['description'], 0, 23) . '...' }}</a>
											    @endif
											</div>
										</div>
									@endforeach
								@else
									No news available. Please refresh in 15 mins.
								@endif
							</div>
						</div>
					</div>
					</div>
				<br />
				<div class="row">
					<div class="col-lg-8">
						<div class="heading-content">
							<b>Quote of the day</b>
							<br />
						</div>
						<div class="history-content">
							@if($quote !== null && $quote_author !== null)
								<b>Author : </b><p>{{ $quote_author }}</p>
								<b>Quote : </b><p>{{ $quote }}</p>
							@else
								No quote available for today. Please refresh in 15 mins.
							@endif
						</div>
					</div>
					<div class="weather-widget col-lg-4">
						<div class="heading-content-right">
							<b>{{ $name . ' , ' . $country }}'s weather for today</b>
						</div>
						<div class="col-lg-2">
							<h2 class="current-temp">{{ substr($current_temp,0,2) }}&deg;c</h2>
							<img style="width:55px;height:auto;" class="temp-widget" src="http://openweathermap.org/img/w/{{ $id_icon }}.png" alt="weather" >
						</div>
						<div class="temps col-lg-10">
							<p class="temp-widget">High : {{ substr($high,0,2) }}&deg;C</p>
							<p class="temp-widget">Low : {{ substr($low,0,2) }}&deg;C</p>
							<p class="temp-widget">Humidity : {{ substr($humidity,0,2) }}</p>
							<p class="temp-widget">Type : {{ $description }}</p>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
	</body>
@endsection
