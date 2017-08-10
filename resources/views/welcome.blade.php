<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Finder - Portfolio Gallery</title>

    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
</head>
<body>

<!-- Page Content -->
<div class="container">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Finder Girls
                <small>[ Portfolio Gallery ]</small>
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <!-- Projects Row -->
    <div class="row">
        @foreach($photos as $photo)
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
            <div class="image-box">
                <a href="#photo-{{ $photo->id }}" data-toggle="lightbox" data-gallery="example-gallery">
                    <img src="{{ url( '/storage/resize/medium/' . $photo->path) }}" class="img-responsive" alt="">
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <!-- / row -->

    <!-- Pagination -->
    <div class="row">
        <div class="text-center">
            {{ $photos->links() }}
        </div>
    </div>
    <!-- /.row -->

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12 text-center">
                <p>Copyright &copy; AMLUN 2017</p>
            </div>
        </div>
        <!-- /.row -->
    </footer>
</div>
<!-- /.container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="{{ asset('js/index.js')}}"></script>
</body>
</html>