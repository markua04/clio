@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>
				<b>{{ $name }}'s weather for today</b>
				<br />
				<br />
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
						<td>{{ $temps['day'] }}&deg;C</td>
						<td>{{ $temps['min'] }}&deg;C</td>
						<td>{{ $temps['max'] }}&deg;C</td>
						<td>{{ $weather[0]['description'] }}</td>
						<td><img src="http://openweathermap.org/img/w/{{ $id_icon }}.png" alt="weather" ></td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>
@endsection
