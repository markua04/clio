@extends('app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Weather Viewer</div>
                <div class="panel-body">
                    <div class="dropdown">
                    <p>To see the weather for your location please set your location in the "Edit Profile" section.</p>
                      <button id="dropweather" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Weather Forecast
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu days-dropdown">
                        <li class="day" data-days="7"><a href="#">7 Day</a></li>
                        <li class="day" data-days="10"><a href="#">10 Day</a></li>
                      </ul>
                    </div>
                    <br />
                    <div class="displayweather">
                    <div class="container">
                        <div class="row"></div>
                    </div>
                    <br />
                    <br />
                    <b>{{ $name }}'s weather for today</b>
                    <br />
                    <br />
                       <table class="table table-bordered table-weather">
                            <thead>
                              <tr>
                                <th>Current Temperature</th>
                                <th>Description</th>
                                <th>Min Temperature</th>
                                <th>Max Temperature</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>&nbsp;&deg;C</td>
                                <td>{{ $description['day'] }}&deg;C</td>
                                <td>{{ $description['min'] }}&deg;C</td>
                                <td>{{ $description['max'] }}&deg;C</td>
                              </tr>
                            </tbody>
                          </table>
                          <b>{{ $name }}'s weather forecast for today</b>
                          <br />
                          <br />
                    @if(isset($weekly['list']))
                    @for($x = 0; $x <= 9; $x++)
                          <table id="{{$x}}" class="table table-bordered table-weather">
                              <thead>
                                <tr>
                                  <th>Day</th>
                                  <th>Description</th>
                                  <th>Day Temperature</th>
                                  <th>View</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td> {{{ $x+1 }}} </td>
                                  <td>{{ $description }}</td>
                                  <td>&nbsp;&nbsp;&nbsp;&deg;C</td>
                                  <td>&nbsp;&nbsp;&nbsp;&deg;C</td>
                                  <td>&nbsp;&nbsp;&nbsp;&deg;C</td>
                                </tr>
                              </tbody>
                          </table>
                   @endfor
                   @else
                       {{ 'No weather forecast data received for this location. Please reload the page.' }}
                   @endif
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

