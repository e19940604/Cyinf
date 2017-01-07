<!DOCTYPE html>
<head>
    <title>@yield('title' , "Curriculum")</title>

    @yield('style')
    @include('includes.includingHeader')
    @include('includes.curriculumCss')


</head>
<body >

    <div id="blackBG" class="visibility-hidden"></div>

    <header id="header">

    </header>

    <section id="sideMenu-wrap">

    </section>

    <section id="container-wrap">

    </section>

    <section id="modal">

    </section>

    <footer id="footer">

    </footer>

@include('includes.scriptInclude')
    <script type="text/javascript" src="/Curr/js/main.js"></script>
    <script src="/Curr/js/views/commons.js"></script>
@yield('scriptArea')

</body>
</html>
