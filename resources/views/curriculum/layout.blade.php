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

    <section id="container">
        @yield('content')
    </section>

    <footer id="footer">
        
    </footer>

@include('includes.scriptInclude')
<script   src="build/bundle.js"  ></script>
@yield('scriptArea')

</body>
</html>
