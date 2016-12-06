<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Mybanker.biz - @yield('htmlheader_title', 'subsidiary of Mybanker.dk A/S') </title>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.6/cerulean/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <meta name="robots" content="noindex, nofollow">
    <!-- App custom styles -->
    {{-- <link href="/css/app.css" rel="stylesheet"> --}}

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="stylesheet" href="//brick.a.ssl.fastly.net/Roboto:300,400,700/Linux+Libertine:400,400i,700,700i">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/styles/github.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    <!-- Custom styles for this template -->
    <!-- <link href="navbar-fixed-top.css" rel="stylesheet"> -->
    <style type="text/css">
        body {
          min-height: 750px;
          padding-top: 70px;
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-nav-collapse" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">Mybanker.biz</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/banker/dashboard">Dashboard</a></li>
                    <li><a href="{{ route('banker.offerChances.index') }}">OfferChances</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/">{{ Auth::user()->name }}</a></li>
                    <li><a href="/logout">Logout</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
        <h2>@yield('contentheader_title', 'Page Header here')</h2>

        @yield('main-content')

    </div> <!-- /container -->


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/autosize.js/3.0.14/autosize.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    {{-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> --}}
  </body>
</body>
</html>
