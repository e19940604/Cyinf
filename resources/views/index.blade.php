<?php
// Count total comment
/*
$query = "SELECT COUNT(comment_id) AS total FROM commentdetail";
$result = mysqli_query( $connect, $query ) or die( 'total error' );
$total = mysqli_fetch_array( $result );
*/
?>
@extends('layout')

@section('title' , 'home')

@section('content')

                <!--section id="jms-slideshow" class="jms-slideshow">
                    <div class="step" data-color="color-1">
                        <div class="jms-content">
                            <h3>Facing Course on Air</h3>
                            <blockquote>
                                <p>After a half year break, WE ARE BACK ! <br />Come and register to find the course you want. Our only way home is your feedback.</p>
                                <small>Cyinf Founder - Archerwind</small>
                            </blockquote>
                        </div>
                    </div>
                    <div class="step" data-color="color-2" data-y="500" data-scale="0.4" data-rotate-x="30">
                        <div class="jms-content">
                            <h3>New Course, New Semester</h3>
                            <blockquote>
                                <p>If there is anything not user friendly, just tell me.</p>
                                <small>Cyinf UX Designer - Kura</small>
                            </blockquote>
                        </div>
                    </div>
                    <div class="step" data-color="color-3" data-x="2000" data-z="3000" data-rotate="170">
                        <div class="jms-content">
                            <h3>No time to waste !</h3>
                            <blockquote>
                                <p>Let's go to try the 3-D animation in the search page we made !<br /> Where is the next meal ? ROCK !</p>
                                <small>Cyinf Programmer - Din</small>
                            </blockquote>
                        </div>
                    </div>
                    <div class="step" data-color="color-4" data-x="3000">
                        <div class="jms-content">
                            <h3>Supercool!</h3>
                            <blockquote>
                                <p>The Mobile Web is online ! Check your mobile device to touch the new version design !</p>
                                <small>Cyinf Programmer - Snow Cracker</small>
                            </blockquote>
                        </div>
                    </div>
                    <div class="step" data-color="color-5" data-x="4500" data-z="1000" data-rotate-y="45">
                        <div class="jms-content">
                            <h3>Did you know that...</h3>
                            <blockquote>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                <small>Cyinf Programmer - Ren</small>
                            </blockquote>
                        </div>
                    </div>
                </section><!-- /Slide Frame -->

    <article role="main" class="">
        <!--div class="homeArea">
            <span class="home">HOME /</span>
            <a href="#step1" class="scroll"><img src="img/start-white.png" title="getstart" alt="getstart"/></a>
        </div-->
        <div class="indexHead">
            <blockquote>
                <p>This is a fair and anonymous online judge course system for students in NSYSU.</p>
                <small>For all students in Nsysu since 2012 Oct.</small>
            </blockquote>
        </div>

        <br />

        <h3 class="titleText">The Latest Comment / （ Total：{{ $total }} ）</h3><br />
        <div data-spy="scroll" data-target="#navbarExample" data-offset="0" class="scrollspy-example" style="height:200px">
            <div id="refreshArea">
                <table class="table table-hover showSearchTable">
                    <thead>
                        <th>#</th>
                        <th>Course</th>
                        <th>Professor</th>
                        <th>Department</th>
                        <th>Grade</th>
                        <th>Judge People</th>
                        <th>Rank</th>
                        <th>DateTime</th>
                        <th>Pin</th>
                    </thead>
                    <tbody>
                    @inject('commentPresenter' , 'Cyinf\Presenters\CommentPresenter')
                    @foreach( $latest_comments as $key => $comment )
                        <tr>
                            {!! $commentPresenter->getCourseTableByCollection( $key + 1 ,$comment ) !!}
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div><!-- /scrollspy -->

        <br />

        <div data-spy="scroll" data-target="#navbarExample" data-offset="0" class="scrollspy-example" >
            <h3>Notification /</h3>
            <p>
                本網站創立動機發心於提供國立中山大學同學一個課程好壞的查詢管道，並同時提供教授們檢視自己在學生心目中的形象與教學狀況，評分必須經過學校郵箱認證的帳號進行，意味著只有中山的學生能夠評鑑，並且每一個人對每一門課只能評鑑一次，以確保資料客觀性。本站亦提供在每次評鑑時有一次對該課程進行詳細評價說明的機會，但禁止各種涉及色情、暴力、侮辱等攻擊性質的言語，如有發現，該留言將進行刪除，本站以全力控管治安，希望各位中山的同學能夠以客觀的角度來評價每一門課，讓自己與其他同學均能受惠，同時本站不負任何留言項的法律責任。留言均為匿名。<br /><br /><strong>p.s. 評鑑前需註冊會員，但瀏覽課程不受限制。</strong>
            </p>
            <br />
            <h3>How To Rank /</h3>
            <p>
                每一門課的各項起始分數均為 50%，總評分的起始分數為 1200 分，各項評價與總評分會隨著同學每一次的評價而作更動，總評分的調整幅度不會大以確保單筆資料的影響範圍。再次強調，希望每個中山的同學能夠以客觀的角度來面對每一次的評鑑，一旦評鑑後便不能修改，如果希望這是一個只屬於中山大學不同於其他學校與PTT的課程查詢文化，盼望各位秉持公平正義之精神來為各位的課程與後輩努力，在此感謝大家的支持。
            </p>
        </div><!-- /scrollspy -->
    </article><!-- /article -->

    <section class="start">
        <h2>Getting Start</h2>

        <section class="getting" id="step1">
            <div class="step-left">
                <a href="#step1" class="scroll"><img src="img/step1-white.png" class="step1" title="step1" alt="step1" /></a>
            </div>
            <div class="separator1"></div><h3>REGISTER</h3>
            <p>Go to <a href="register">Register Page</a>.（ Nsysu Student Mailbox is Required ）</p>
            <p>請至<a href="register">此頁面</a>註冊。（需中山大學學生信箱）</p>
        </section>

        <section class="getting" id="step2">
            <div class="step-right">
                <a href="#step2" class="scroll"><img src="img/step2-white.png" class="step2" title="step2" alt="step2" /></a>
            </div>
            <div class="separator2"></div><h3>FIND COURSE</h3>
            <p>Find the course you want in the <a href="search#slide-main">Search Page</a>.</p>
            <p>至<a href="search#slide-main">課程搜尋頁面</a>尋找想要評鑑的課程。</p>
        </section>

        <section class="getting" id="step3">
            <div class="step-left">
                <a href="#step3" class="scroll"><img src="img/step3-white.png" class="step3" title="step3" alt="step3" /></a>
            </div>
            <div class="separator3"></div><h3>COMMENT AND JUDGE</h3>
            <p>Send a comment and the judgement of each option for ranking course.</p>
            <p>對每個細項做出評分，並撰寫評論以評價課程。</p>
        </section>

        <section class="getting" id="step4">
            <div class="step-right">
                <a href="#step4" class="scroll"><img src="img/step4-white.png" class="step4" title="step4" alt="step4" /></a>
            </div>
            <div class="separator4"></div><h3>SEE THE RANK</h3>
            <p>The <a href="rank">Rank Page</a> will show the result and the statistic information.</p>
            <p><a href="rank">排名頁面</a>會顯示評鑑結果與統計資料以供參考。</p>
        </section>

    </section><!-- /start -->

@endsection

@section('scriptArea')
    <script  type="text/javascript">
        $(function() {

            var jmpressOpts	= {
                animation		: { transitionDuration : '0.8s' }
            };

            $( '#jms-slideshow' ).jmslideshow( $.extend( true, { jmpressOpts : jmpressOpts }, {
                autoplay	: true,
                bgColorSpeed: '1s',
                arrows		: false
            }));

        });
    </script>
@endsection