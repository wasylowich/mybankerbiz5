<!DOCTYPE html>
<!--
Landing page based on Pratt: http://blacktie.co/demo/pratt/
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mybanker.biz - Let financial institutions bid for you deposit so you can maximize your return. ">
    <meta name="author" content="Mybanker.biz development team">

    <meta property="og:title" content="Mybanker.biz" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Mybanker.biz - {{ trans('adminlte_lang::message.landingdescription') }}" />
    <meta property="og:url" content="http://mybanker.biz/" />
    <meta property="og:sitename" content="mybanker.biz" />
    <meta property="og:url" content="http://mybanker.biz" />

    <title>Mybanker.biz</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('/js/smoothscroll.js') }}"></script>


</head>

<body data-spy="scroll" data-offset="0" data-target="#navigation">

<!-- Fixed navbar -->
<div id="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><b>Mybanker.biz</b></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#home" class="smoothScroll">{{ trans('adminlte_lang::message.home') }}</a></li>
                <li><a href="#desc" class="smoothScroll">{{ trans('adminlte_lang::message.description') }}</a></li>
                <li><a href="#showcase" class="smoothScroll">{{ trans('adminlte_lang::message.showcase') }}</a></li>
                <li><a href="#contact" class="smoothScroll">{{ trans('adminlte_lang::message.contact') }}</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                    <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                @else
                    <li><a href="/home">{{ Auth::user()->name }}</a></li>
                    <li><a href="{{ url('/logout') }}">{{ trans('adminlte_lang::message.signout') }}</a></li>

                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>


<section id="home" name="home"></section>
<div id="headerwrap">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-12">
                <h1>Mybanker.biz <b>deposit auction</b></h1>
                <h3>A service to help you find the best return on your investment. A complimentary service to
                    the very popular <a href="https://www.mybanker.dk/skift-bank/">Skift Bank</a> service at <a href="http://mybanker.dk/">Mybanker.dk</a>
                </h3>
                <h3><a href="{{ url('/register') }}" class="btn btn-lg btn-success">{{ trans('adminlte_lang::message.gedstarted') }}</a></h3>
            </div>
            <div class="col-lg-2">
                <h5>Decades of experience</h5>
                <p>Denmarks top financial institutions participate in our auction</p>
            </div>
            <div class="col-lg-8">
                <img class="img-responsive" src="{{ asset('/img/mybankbiz-landing-cta.png') }}" alt="">
            </div>
            <div class="col-lg-2">
                <br>
                <h5>Thousands of satisfied customers</h5>
                <p>Let us help you put your money to work for you.</p>
            </div>
        </div>
    </div> <!--/ .container -->
</div><!--/ #headerwrap -->


<section id="desc" name="desc"></section>
<!-- INTRO WRAP -->
<div id="intro">
    <div class="container">
        <div class="row centered">
            <h1>{{ trans('adminlte_lang::message.designed') }}</h1>
            <br>
            <br>
            <div class="col-lg-4">
                <img src="{{ asset('/img/intro01.png') }}" alt="">
                <h3>{{ trans('adminlte_lang::message.community') }}</h3>
                <p>Hear what others are saying about their experiences and the interest they earned.
                Participate in online forum or get assistance from a financial advisor at Mybanker.biz</p>
            </div>
            <div class="col-lg-4">
                <img src="{{ asset('/img/intro02.png') }}" alt="">
                <h3>{{ trans('adminlte_lang::message.schedule') }}</h3>
                <p>Guaranteed response to your enquiry within 2 hours.</p>
            </div>
            <div class="col-lg-4">
                <img src="{{ asset('/img/intro03.png') }}" alt="">
                <h3>{{ trans('adminlte_lang::message.monitoring') }}</h3>
                <p>Track the incoming offers from financial institutions online.</p>
            </div>
        </div>
        <br>
        <hr>
    </div> <!--/ .container -->
</div><!--/ #introwrap -->

<!-- FEATURES WRAP -->
<div id="features">
    <div class="container">
        <div class="row">
            <h1 class="centered">What's in it for you?</h1>
            <br>
            <br>
            <div class="col-lg-6 centered">
                <img class="centered" src="{{ asset('/img/mobile.png') }}" alt="">
            </div>

            <div class="col-lg-6">
                <h3>{{ trans('adminlte_lang::message.features') }}</h3>
                <br>
                <!-- ACCORDION -->
                <div class="accordion ac" id="accordion2">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                Optimér din formue
                            </a>
                        </div><!-- /accordion-heading -->
                        <div id="collapseOne" class="accordion-body collapse in">
                            <div class="accordion-inner">
                                <p>
                                    <ul>
                                        <li>Udbyd opsparing, aftaleindskud eller pensionsopsparing</li>
                                        <li>Du bestemmer selv bindingsperiode</li>
                                        <li>Tilbud fra op til 20 banker</li>
                                        <li>Fordel dine penge og opnå fuld indskydergaranti</li>
                                        <li>Du får svar i løbet af 2 timer</li>
                                    </ul>
                                </p>
                            </div><!-- /accordion-inner -->
                        </div><!-- /collapse -->
                    </div><!-- /accordion-group -->
                    <br>

                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                                Vores services
                            </a>
                        </div>
                        <div id="collapseTwo" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <p>
                                    Vi hjælper dig til at få en høj rente på dine kontante indlån og på din pensionsopsparing.
                                </p>

                                <p>
                                    Mybanker.biz er en unik service, der indhenter rentetilbud for dig fra flere banker på en gang, på præcis det beløb som du ønsker. Du får et unikt overblik over dine personlige rentetilbud, som du frit kan vælge imellem.
                                </p>

                                <p>
                                    Du kan altid ringe til os (hverdage 9.00 - 16.00), hvis du har spørgsmål til, hvordan du bruger systemet. Vores telefonnummer er 70 20 72 34.
                                </p>
                            </div><!-- /accordion-inner -->
                        </div><!-- /collapse -->
                    </div><!-- /accordion-group -->
                    <br>

                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                                Aftaleindskud
                            </a>
                        </div>
                        <div id="collapseThree" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <p>
                                    Et aftaleindskud er et indlån i en bank, hvor beløb og løbetid er aftalt på forhånd. Banken giver dig en bedre rente på et aftaleindskud, fordi den ved, i hvor lang tid den har din opsparing.
                                </p>
                                <p>
                                    <ul>
                                        <li>Du får et tilbud i løbet af 2 timer indenfor bankernes åbningstid</li>
                                        <li>Du kan frit vælge mellem tilbuddene</li>
                                        <li>Du kan placere indkud i flere banker og dermed blive fuldt dækket af Indskydergarantifonden</li>
                                        <li>Du optimerer din renteindtægt</li>
                                    </ul>
                                </p>
                            </div><!-- /accordion-inner -->
                        </div><!-- /collapse -->
                    </div><!-- /accordion-group -->
                    <br>

                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                                Sådan fungerer systemet
                            </a>
                        </div>
                        <div id="collapseFour" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <p>
                                    Når du har oprettet dig som bruger af Mybanker.biz, og har betalt for en forespørgsel, kan du sætte indlån og pensionsmidler i udbud hos vores pengeinstitutter, som tilbyder dig rentesatser i løbet af 2 timer (indenfor deres åbningstid).
                                </p>
                                <p>
                                    Hvis du er tilfreds med en tilbudt rentesats, accepterer du denne. Herefter sender Mybanker.biz dine kontaktoplysninger til det valgte pengeinstitut, som efterfølgende opretter en konto til dig og kontakter dig.
                                </p>
                            </div><!-- /accordion-inner -->
                        </div><!-- /collapse -->
                    </div><!-- /accordion-group -->
                    <br>
                </div><!-- Accordion -->
            </div>
        </div>
    </div><!--/ .container -->
</div><!--/ #features -->


<section id="showcase" name="showcase"></section>
<div id="showcase">
    <div class="container">
        <div class="row">
            <h1 class="centered">{{ trans('adminlte_lang::message.screenshots') }}</h1>
            <br>
            <div class="col-lg-8 col-lg-offset-2">
                <div id="carousel-example-generic" class="carousel slide">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="{{ asset('/img/mybankbiz-landing-carousel-item01.png') }}" alt="">
                        </div>
                        <div class="item">
                            <img src="{{ asset('/img/mybankbiz-landing-carousel-item02.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
    </div><!-- /container -->
</div>


<section id="contact" name="contact"></section>
<div id="footerwrap">
    <div class="container">
        <div class="col-lg-5">
            <h3>{{ trans('adminlte_lang::message.address') }}</h3>
            <p>
                Amaliegade 36,<br />
                1256 København K.<br />
                Denmark
            </p>
        </div>

        <div class="col-lg-7">
            <h3>{{ trans('adminlte_lang::message.dropus') }}</h3>
            <br>
            <form role="form" action="#" method="post" enctype="plain">
                <div class="form-group">
                    <label for="name1">{{ trans('adminlte_lang::message.yourname') }}</label>
                    <input type="name" name="Name" class="form-control" id="name1" placeholder="{{ trans('adminlte_lang::message.yourname') }}">
                </div>
                <div class="form-group">
                    <label for="email1">{{ trans('adminlte_lang::message.emailaddress') }}</label>
                    <input type="email" name="Mail" class="form-control" id="email1" placeholder="{{ trans('adminlte_lang::message.enteremail') }}">
                </div>
                <div class="form-group">
                    <label>{{ trans('adminlte_lang::message.yourtext') }}</label>
                    <textarea class="form-control" name="Message" rows="3"></textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-large btn-success">{{ trans('adminlte_lang::message.submit') }}</button>
            </form>
        </div>
    </div>
</div>
<div id="c">
    <div class="container">
        <!-- To the right -->
        <div class="hidden-xs">
            <a href="#">Forretningsbetingelser</a> | <a href="#">Persondatapolitik</a>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; <a href="http://mybanker.dk">Mybanker.dk A/S</a>,</strong> Amaliegade 36, 1256 København K.<br />
        Tlf. +45 70 20 72 34, e-mail: info@mybanker.biz, CVR-nr. 30504496
    </div>
    <p>&nbsp;</p>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script>
    $('.carousel').carousel({
        interval: 3500
    })
</script>
</body>
</html>
