@extends('app')
@section('content')

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    @if (Session::has('key'))

        <div class="alert alert-success">{{ Session::get('key') }}
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    @include('partials.profile')
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="POST" action="/edit">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-1 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="username"
                                           value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-1 control-label">Surname</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="surname"
                                           value="{{ Auth::user()->surname }}">
                                </div>
                            </div>
                            <div id="lat"><input name="lat" type="hidden" value="-33.925838">
                            </div>
                            <div id="long"><input name="long" type="hidden" value="18.423220">
                            </div>
                            <input type="hidden" class="form-control" name="id" value="{{ Auth::user()->id }}">
                            <button type="submit" id="btn-sub" class="btn btn-primary" style="margin-right: 15px;">
                                Submit
                            </button>

                        </form>
                        @include('partials.map')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
