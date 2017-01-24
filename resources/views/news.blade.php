@extends('homeapp')

@section('content')
    <body class="body-image" style="background-image: url({{ url() }}/images/wallpapers/city/city{{ $wallpaper }}.jpg);">
    <div class="container">
    </div>
    @include('partials.nav')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-news">
                    <div class="panel-heading">Latest News</div>
                    <br />
                    <div class="history-content">
                        <div class="panel-group" id="accordion">
                            <h4>Gaming News</h4>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">IGN News</a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        @if(isset($gaming_news))
                                            @foreach($gaming_news as $news)
                                                <div class="gaming-content row">
                                                    @if(isset($news['urlToImage']))
                                                    <div class="col-lg-3">
                                                        <a href="{{ $news['url'] }}">
                                                            <img class="gaming-image" src="{{ $news['urlToImage'] }}">
                                                        </a>
                                                    </div>
                                                    @else
                                                        <div class="col-lg-3">
                                                        <img class="gaming-image" src="/images/ign.png">
                                                        </div>
                                                    @endif
                                                    <div class="col-lg-9">
                                                    <p><b>{{ $news['title'] }}</b></p>
                                                    <p>{{ $news['description'] }}</p>
                                                    <p><a href="{{ $news['url'] }}">View Article</a></p>
                                                    </div>
                                                </div>
                                                <br />
                                            @endforeach
                                        @else
                                            No news available. Please refresh in 15 mins.
                                        @endif</div>
                                </div>
                            </div>
                            <h4>World News</h4>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Lad Bible News</a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        @if(isset($funny_news))
                                            @foreach($funny_news as $news)
                                                <div class="gaming-content row">
                                                    @if(isset($news['urlToImage']))
                                                        <div class="col-lg-3">
                                                        <a href="{{ $news['url'] }}" target="_blank">
                                                            <img class="gaming-image" src="{{ $news['urlToImage'] }}">
                                                        </a>
                                                        </div>
                                                    @else
                                                        <div class="col-lg-3">
                                                            <img class="gaming-image" src="/images/ign.png">
                                                        </div>
                                                    @endif
                                                    <div class="col-lg-9">
                                                        <p><b>{{ $news['title'] }}</b></p>
                                                        <p>{{ $news['description'] }}</p>
                                                        <p><a href="{{ $news['url'] }}" target="_blank">View Article</a></p>
                                                    </div>
                                                </div>
                                                <br />
                                            @endforeach
                                        @else
                                            No news available. Please refresh in 15 mins.
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <h4>Sports</h4>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                            Sky Sports News</a>
                                    </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        @if(isset($skySports_news))
                                            @foreach($skySports_news as $news)
                                                <div class="gaming-content row">
                                                    @if(isset($news['urlToImage']))
                                                        <div class="col-lg-2">
                                                            <a href="{{ $news['url'] }}" target="_blank">
                                                                <img class="sports-image" src="{{ $news['urlToImage'] }}">
                                                            </a>
                                                        </div>
                                                    @else
                                                        <img class="gaming-image" src="/images/ign.png">
                                                    @endif
                                                    <div class="col-lg-10">
                                                        <p><b>{{ $news['title'] }}</b></p>
                                                        <p>{{ $news['description'] }}</p>
                                                        <p><a href="{{ $news['url'] }}" target="_blank">View Article</a></p>
                                                    </div>
                                                </div>
                                                <br />
                                            @endforeach
                                        @else
                                            No news available. Please refresh in 15 mins.
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
