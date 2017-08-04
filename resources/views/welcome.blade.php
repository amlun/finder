<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Finder - Portfolio Gallery</title>
    <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
</head>
<body>
<header>
    <h1>Finder Girls <br> <span>[ Portfolio Gallery ]</span></h1>
    <p>Powered by <a href="http://www.amlun.com/" target="_blank">Amlun</a></p>
</header>
<div id="top"></div>
<section class="gallery">
    <div class="row">
        <ul>
            <a href="#" class="close"></a>
            @foreach($images as $image)
            <li>
                <a href="#{{ $image->id }}">
                    <img src="{{ url( '/storage/resize/medium/' . $image->path) }}" alt="">
                </a>
            </li>
            @endforeach
        </ul>
    </div> <!-- / row -->
    @foreach($images as $image)
    <div id="{{ $image->id }}" class="port">
        <div class="row">
            <div class="description">
                <h1>{{ $image->topic->title }}</h1>
                <p>{{ $image->topic->content }}</p>
            </div>
            <img src="{{ url( '/storage/resize/large/' . $image->path) }}" alt="">
        </div>
    </div> <!-- / row -->
    @endforeach

</section> <!-- / projects -->

<section class="page">
    <div class="row">
        {{ $images->links() }}
    </div>
</section>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!--<script src="{{ asset('js/app.js')}}"></script>-->
<script src="{{ asset('js/index.js')}}"></script>

</body>
</html>