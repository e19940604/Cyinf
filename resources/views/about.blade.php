@extends('layout')

@section('title' , "Favorite Courses" )
@inject( 'coursePresenter' , 'Cyinf\Presenters\CoursePresenter' )

@section('content')
    <article role="main">
        <h1>ABOUT /</h1>
        <p>Cyinf is an abbreviation of 「 Color Your Infinity 」. We are Cyinf Studio -- NSYSU students who want to make our school life much better.<br />
            If you have any idea that you want to make it come true, come and join us ! </p><br /><br />
        <div class="pArea">
            <img src="img/archerwind.png" alt="..." /><br />
            <h5>Archerwind</h5>
            <div class="nameTitle">
                Founder - Programmer & Visual Designer
            </div>
            <div class="description">
                本名：江緯宸。<br />
                來自：台北。<br />
                系級：中山大學資工系103級。<br />
                聯繫：archerwindy@gmail.com &nbsp;&nbsp;
                <a href="https://www.facebook.com/weichen.chiang.39" target="_blank"><img src="img/fb-blue.png" alt="fb-archerwind"/></a><br />
                簡介：<br />
            </div>
        </div>

        <div class="pArea">
            <img src="img/din.png" alt="..." /><br />
            <h5>DIN</h5>
            <div class="nameTitle">
                PHP & Javascript Programmer
            </div>
            <div class="description">
                本名：陳定延。<br />
                來自：高雄。<br />
                系級：中山大學資工系105級。<br />
                聯繫：&nbsp;&nbsp;
                <a href="https://www.facebook.com/profile.php?id=100000499835163" target="_blank"><img src="img/fb-blue.png" alt="fb-archerwind"/></a><br />
                簡介：<br />
            </div>
        </div>

        <div class="pArea">
            <img src="img/snow.png" alt="..." /><br />
            <h5>Snow Cracker</h5>
            <div class="nameTitle">
                PHP & Javascript Programmer
            </div>
            <div class="description">
                本名：陳秉耀。<br />
                來自：彰化。<br />
                系級：中山大學資工系105級。<br />
                聯繫：&nbsp;&nbsp;
                <a href="https://www.facebook.com/profile.php?id=100000297665580" target="_blank"><img src="img/fb-blue.png" alt="fb-archerwind"/></a><br />
                簡介：<br />
            </div>
        </div>

        <div class="pArea">
            <img src="img/kura.png" alt="..." /><br />
            <h5>Kura</h5>
            <div class="nameTitle">
                UX Designer &  Writer
            </div>
            <div class="description">
                本名：何蕙宇。<br />
                來自：台北。<br />
                系級：中山大學資管系104級。<br />
                聯繫：<br />
                簡介：<br />
            </div>
        </div>

        <div class="pArea">
            <img src="img/min.png" alt="..." /><br />
            <h5>Yo Min</h5>
            <div class="nameTitle">
                PHP & Javascript Programmer
            </div>
            <div class="description">
                本名：陳佑任。<br />
                來自：嘉義。<br />
                系級：中山大學資工系105級。<br />
                聯繫：&nbsp;&nbsp;
                <a href="https://www.facebook.com/pa.douluo" target="_blank"><img src="img/fb-blue.png" alt="fb-archerwind"/></a><br />
                簡介：<br />
            </div>
        </div>

        <div class="pArea">
            <img src="img/pichu.png" alt="..." /><br />
            <h5>Pichu</h5>
            <div class="nameTitle">
                Server Handler & Consultant
            </div>
            <div class="description">
                本名：陳慶耀。<br />
                來自：台北。<br />
                系級：中山大學資工所103級。<br />
                聯繫：&nbsp;&nbsp;
                <a href="https://www.facebook.com/pichu.chen" target="_blank"><img src="img/fb-blue.png" alt="fb-archerwind"/></a><br />
                簡介：<br />
            </div>
        </div>

        <div class="pArea">
            <img src="img/lion.png" alt="..." /><br />
            <h5>Ying</h5>
            <div class="nameTitle">
                Consultant
            </div>
            <div class="description">
                本名：成允君。<br />
                來自：高雄。<br />
                系級：中山大學資工系105級。<br />
                聯繫：&nbsp;&nbsp;
                <a href="https://www.facebook.com/joshctws" target="_blank"><img src="img/fb-blue.png" alt="fb-archerwind"/></a><br />
                簡介：<br />
            </div>
        </div>

    </article><!-- /article -->
@endsection

@section('scriptArea')
    <script  type="text/javascript">

    </script>
@endsection