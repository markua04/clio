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
					<div class="col-lg-6">
						<div class="heading-content">
							<b>Quote of the day</b>
							<br />
						</div>
						<div class="history-content">
							@if($quote !== null && $author !== null)
								<b>Author : </b><p>{{ $author }}</p>
								<b>Quote : </b><p>{{ $quote }}</p>
							@else
								No quote available for today. Please refresh in 15 mins.
							@endif
						</div>
					</div>
					<div class="col-lg-6">
						<div class="row-scroller" id="scrollContainer">
							<div id="scrollBox">
								@if(isset($news))
									@foreach($news as $news_article)
										<p>
											<a target="blank" href="{{ $news_article['url'] }}">
												<img style="width:140px; height:85px;" src="{{ $news_article['urlToImage'] }}">
											</a>
												{{ substr($news_article['title'], 0, 40) . '...' }}
										</p>
									@endforeach
								@else
									No news available. Please refresh in 15 mins.
								@endif
							</div>
							</div>
					</div>
					</div>
				<br />
					<div class="heading-content">
						<b>This day in History</b>
					</div>
				<div class="history-content">
					@if($history != null)
						<p>Year : {{ $history['history_year'] }}</p>
						<p>Historical Data : {{ $history['history_text'] }}</p>
						<a href="{{ $history['history_link'] }}">View Article</a>
					@else
						No History available for today. Please notify admin.
					@endif
				</div>
				<br />
				<div class="heading-content">
					<b>{{ $name }}'s weather for today</b>
				</div>
				<br />
				<div class="table-weather-container">
				<table class="table table-bordered table-weather">
					<thead>
					<tr>
						<th>Current Temperature</th>
						<th>Min Temperature</th>
						<th>Max Temperature</th>
						<th>Weather</th>
						<th>Icon</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>{{ substr($temps['day'],0,2) }}&deg;C</td>
						<td>{{ substr($temps['min'],0,2) }}&deg;C</td>
						<td>{{ substr($temps['max'],0,2) }}&deg;C</td>
						<td>{{ $weather[0]['description'] }}</td>
						<td><img src="http://openweathermap.org/img/w/{{ $id_icon }}.png" alt="weather" ></td>
					</tr>
					</tbody>
				</table>
					<div class="weather-widget row">
						<div class="col-lg-1">
							<img src="http://openweathermap.org/img/w/{{ $id_icon }}.png" alt="weather" >
						</div>
						<div class="col-lg-11">
							{{ substr($temps['max'],0,2) }}&deg;C<br/>
							{{ $weather[0]['description'] }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
