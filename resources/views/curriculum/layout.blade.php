<!DOCTYPE html>
<head>
    <title>@yield('title' , "Curriculum")</title>

    @yield('style')
    @include('includes.includingHeader')
    @include('includes.curriculumCss')
    

</head>
<body>
    <header>
        <div id="hd-container" >
            <div id="title-wrap">
                <img id="logo" src={{ asset("/curr/img/icon_c.svg") }}>
                <h3>urriculum</h3>
            </div>
            <div id="profile">
                <ul>
                    <li id="note" >
                        <i class="fa fa-bell-o"></i>
                    </li>
                    <li id="m-sidebtn" class="m-only" >
                        <i class="fa fa-bars"></i>
                    </li>
                    <li class="desk-only"> | </li>
                    <li id="fb-icon" class="desk-only">
                        <!-- put the picture url of variable for user picture or fb-icon -->
                        <a href="#"><img src={{ asset("/img/fb-blue.png")}}></a>
                    </li>
                    <li class="desk-only"> | </li>
                    <li id="fb-name" class="desk-only">
                        <!-- put user fb-name or please login -->
                        <a href="#">連結 FB</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <section id="container">
        @yield('content')
    </section>

    <footer >
        <div class="container">
            <h5>Copyright &copy; Cyinf Studio 2015 <p class="desk-only"> |  <a href="#" class="desk-only footer-link"><i class="fa fa-commenting-o"></i> 意見與反饋</a>  | <a href="#" class="desk-only footer-link"><i class="fa fa-question"></i> 使用教學</a></p></h5>
        </div>
        
    </footer>
@include('includes.scriptInclude')

@yield('scriptArea')

</body>
</html>
