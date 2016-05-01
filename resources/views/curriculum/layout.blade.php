<!DOCTYPE html>
<head>
    <title>@yield('title' , "Curriculum")</title>

    @yield('style')
    @include('includes.includingHeader')
    @include('includes.curriculumCss')


</head>
<body >
    <header id="header">

    </header>

    <section id="sideMenu-wrap">

    </section>

    <div id="blackBG"></div>

    <section id="container-wrap">

    </section>

    <footer id="footer">

    </footer>

@include('includes.scriptInclude')
<script type="text/javascript" src="/Curr/js/main.js"></script>
@yield('scriptArea')

</body>
</html>
