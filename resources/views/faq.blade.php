@extends('layout')

@section('title' , "Favorite Courses" )
@inject( 'coursePresenter' , 'Cyinf\Presenters\CoursePresenter' )

@section('content')
    <article role="main">
        <h1>F.A.Q. /</h1><br />
        <div class="panel panel-default">
            <div class="panel-heading">Ｑ：我沒有收到認證信，怎麼辦？</div>
            <div class="panel-body">
                Ａ：請登入後進入 <a href="member">Account</a> 頁面，點選「重發認證信」。
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Ｑ：我點了重新寄送驗證信，可是還是收不到TAT？</div>
            <div class="panel-body">
                Ａ：有可能是被學生信箱的隔離區檔下來了，請到 <a href="http://140.117.11.135:8000/cgi-mod/index.cgi">
                    信件隔離區</a> 頁面。帳號請輸入學生信箱的電子郵件 ( 學號@student.nsysu.edu.tw )，如果是第一次使用隔離區請在輸入完帳號後點選「重寄新密碼」，新密碼可以在學生信箱中收到，取得密碼後就可以登入，並且把被攔截的郵件送出。在上方參數選擇的隔離區設定也可以把隔離區功能關閉，以免之後有重要信件也被隔離區阻擋。
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Ｑ：我想評鑑卻一直被導向到會員頁面怎麼辦？</div>
            <div class="panel-body">
                Ａ：這是因為您的帳戶還沒有通過認證喔，請去中山大學學生信箱認證身分。
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Ｑ：我忘記密碼了怎麼辦ＱＡＱＱＱＱＱＱＱＱＱＱ？</div>
            <div class="panel-body">
                Ａ：請至 <a href="loginView">Login</a> 頁面，點選「忘記密碼」。
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Ｑ：我有問題想問或發現一些問題想回報該怎麼做？</div>
            <div class="panel-body">
                Ａ：請至 <a href="https://docs.google.com/forms/d/1LMkwDuMIwNF9aZ4yq9nTvVUmUKphklhxQP1cIpnHd6U/viewform">Contact</a> 頁面發問或進行回報。
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Ｑ：請問我可以用這個選課嗎？</div>
            <div class="panel-body">
                Ａ：不行喔，請在這裡查完資料後至「選課系統」選課＞＿０。
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Ｑ：可是我覺得學校的選課系統很難用。</div>
            <div class="panel-body">
                Ａ：我們也覺得很難用／＿＞＼。
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Ｑ：請問我可以在這邊試排課表嗎？</div>
            <div class="panel-body">
                Ａ：這是我們預定未來會完成的功能，敬請期待ＯｗＯ。
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Ｑ：這邊可以幫我做畢業學分審查嗎？</div>
            <div class="panel-body">
                Ａ：抱歉現在還沒有，我們會努力完成＼Ｏ口Ｏ／。
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Ｑ：為什麼我同學用這個網站時都有翻轉、滑動一類的特效，我卻沒有？</div>
            <div class="panel-body">
                Ａ：你是否是使用Internet Explorer（IE，Windows預設瀏覽器）呢？建議使用其它瀏覽器（例：<a href="https://www.google.com/intl/en/chrome/browser/">Google Chrome</a>、<a href="http://www.mozilla.org/en-US/firefox/new/">Mozila Firefox</a>、Safari）以獲得最佳瀏覽體驗喔！
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Ｑ：我的瀏覽器是Firefox，為什麼Menu裡的圖示都出不來？</div>
            <div class="panel-body">
                Ａ：請更改您的設定，至選項／內容／進階，將「優先使用網頁指定字型」一項勾起，按下確定後就可以了！（附註：Firefox不支援搜尋頁面的3D翻轉特效）
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Ｑ：為什麼在我的電腦上瀏覽網站，一堆東西都疊在一起了？</div>
            <div class="panel-body">
                Ａ：請將您瀏覽器的顯示比例改為100%。如您不確定怎麼做，請按快捷鍵ctrl+0（Mac請按command+0）。
            </div>
        </div>
    </article><!-- /article -->
@endsection

@section('scriptArea')
    <script  type="text/javascript">

    </script>
@endsection