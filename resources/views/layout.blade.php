<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <title>FacingCourse</title>

    @include('includes.includingHeader')

    <noscript>
        <style>
            .step {
                width: 100%;
                position: relative;
            }
            .step:not(.active) {
                opacity: 1;
                filter: alpha(opacity=99);
                -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(opacity=99)";
            }
            .step:not(.active) a.jms-link{
                opacity: 1;
                margin-top: 40px;
            }
        </style>
    </noscript>

</head>
<body onload="latestRefresh()">
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
<div id="st-container" class="st-container">

   @include('includes.sidebar')


    <div class="container">

        @include('includes.header')

        @yield('content')

        @include('includes.footer')

    </div><!-- /container -->
</div><!-- /st-container -->

@include('includes.scriptInclude')

@yield('scriptArea')

</body>
</html>
