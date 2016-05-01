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

    <div id="sideMenu" class="m-only">
        <div id="sideContent">
            <div id="sideProfile" >
                <img class="img-circle" src="./img/no-user-image.gif" >
                <span>xgnid</span>
            </div>
            <div class="sideRow">
                新增課程
            </div>
            <div class="sideRow">
                通知設定
            </div>
            <div class="sideRow">
                帳號連結
            </div>
            <img id="sideBg" src="../../Cyinf/img/CyinfLogo.png">
        </div>
    </div>

    <div id="blackBG"></div>

    <section id="container">
        @yield('content')
    </section>

    <footer id="footer">

    </footer>

@include('includes.scriptInclude')
<script type="text/javascript" src="/Curr/js/main.js"></script>
@yield('scriptArea')

</body>
</html>
