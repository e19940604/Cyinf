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

        <!-- add modal area --> 

 <!--   <div id="add-modal" class="pinkModal mod" >
        <img src="/Curr/img/close.png" class="closeBtn">
        <div class="mod-content">
            <div class="mod-title">
                <h4 class="mod-title-text">搜尋課程</h4>
            </div>

            <div class="mod-add mod-item">
                <div class="mod-add-inputGroup">
                    <span class="mod-text mod-add-text">條件</span>
                    <div class="mod-add-inputBlock" > 
                        <select class="form-control mod-add-input mod-add-select">
                                <option value=""></option>
                                <option value="de">系所</option>
                                <option value="ti1">星期</option>
                                <option value="ti2">節次</option>
                                <option value="gr">年級</option>
                                <option value="pl">教室(大樓)</option>
                                <option value="di">向度(通識教育)</option>
                        </select>
                        <input type="text" class="form-control mod-add-input mod-add-input-text">
                        <span class="mod-add-icon glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
                    </div>
                </div>

                <div class="mod-add-inputGroup">
                    <span class="mod-text mod-add-text">條件</span>
                    <div class="mod-add-inputBlock" > 
                        <select class="form-control mod-add-input mod-add-select">
                                <option value=""></option>
                                <option value="de">系所</option>
                                <option value="ti1">星期</option>
                                <option value="ti2">節次</option>
                                <option value="gr">年級</option>
                                <option value="pl">教室(大樓)</option>
                                <option value="di">向度(通識教育)</option>
                        </select>
                        <input type="text" class="form-control mod-add-input mod-add-input-text">
                        <span class="mod-add-icon glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
                    </div>
                </div>

                <div class="mod-add-inputGroup">
                    <span class="mod-text mod-add-text">條件</span>
                    <div class="mod-add-inputBlock" > 
                        <select class="form-control mod-add-input mod-add-select">
                                <option value=""></option>
                                <option value="de">系所</option>
                                <option value="ti1">星期</option>
                                <option value="ti2">節次</option>
                                <option value="gr">年級</option>
                                <option value="pl">教室(大樓)</option>
                                <option value="di">向度(通識教育)</option>
                        </select>
                        <input type="text" class="form-control mod-add-input mod-add-input-text">
                        <span class="mod-add-icon glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="mod-add-inputGroup">
                    <div class="mod-add-inputBlock" > 
                        <span class="mod-add-icon glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                    </div>
                </div>

                <div class="mod-add-inputGroup">
                    <div class="mod-add-inputBlock">
                        <i class="mod-add-icon mod-add-btn fa fa-arrow-circle-right" aria-hidden="true"></i>
                    </div>
                </div>
                
            </div>

            <div class="mod-add-result">
                <table id="mod-add-table">
                    <thead>
                        <tr>
                            <th class="col">課程名稱</th>
                            <th class="col">授課教師</th>
                            <th class="col">開課系所</th>
                            <th class="col">上課時間</th>
                            <th class="col">上課星期</th>
                            <th class="col">上課地點</th>
                            <th class="col">加入課程</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-title="課程名稱">服務學習（三）：萬安部落原住民學童課輔服務</td>
                            <td data-title="授課教師">梁慧玫</td>
                            <td data-title="開課系所">服務學習</td>
                            <td data-title="上課星期">Tue,Fri</td>
                            <td data-title="上課時間">34,23</td>
                            <td data-title="上課地點">理SC 2001</td>
                            <td >
                                <span class="desk-only mod-result-icon glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                <button class="m-only add-result-btn">刪除課程</button>
                            </td>
                        </tr>
                        <tr>
                            <td data-title="課程名稱">服務學習（三）：萬安部落原住民學童課輔服務</td>
                            <td data-title="授課教師">梁慧玫</td>
                            <td data-title="開課系所">服務學習</td>
                            <td data-title="上課星期">Tue,Fri</td>
                            <td data-title="上課時間">34,23</td>
                            <td data-title="上課地點">理SC 2001</td>
                            <td >
                                <span class="desk-only mod-result-icon glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                <button class="m-only add-result-btn">刪除課程</button>
                            </td>
                        </tr>

                        <tr>
                            <td data-title="課程名稱">服務學習（三）：萬安部落原住民學童課輔服務</td>
                            <td data-title="授課教師">梁慧玫</td>
                            <td data-title="開課系所">服務學習</td>
                            <td data-title="上課星期">Tue,Fri</td>
                            <td data-title="上課時間">34,23</td>
                            <td data-title="上課地點">理SC 2001</td>
                            <td >
                                <span  class="desk-only mod-result-icon glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                                <button class="m-only add-result-btn">刪除課程</button>
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
-->

    <!-- config modal area --> 

<!--
    <div id="config-modal" class="blueModal mod">
        <img src="/Curr/img/close.png" class="closeBtn">
        <div class="mod-content">
            <div class="mod-title">
                <h4 class="mod-title-text">通知設定</h4>
            </div>

            <div class="mod-config mod-item">
                <span class="mod-text mod-config-text">上課通知</span>
                <div class="switch mod-config-text">
                    <div class="onoffswitch mod-switch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch1" >
                        <label class="onoffswitch-label" for="switch1">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                 </div>
            </div>

            <div class="mod-config mod-item">
                <span class="mod-text mod-config-text">點名通知</span>
                <div class="switch mod-config-text">
                    <div class="onoffswitch mod-switch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch2" checked>
                        <label class="onoffswitch-label" for="switch2">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                 </div>
            </div>

            <div class="mod-config mod-item">
                <span class="mod-text mod-config-text">考試通知</span>
                <div class="switch mod-config-text">
                    <div class="onoffswitch mod-switch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch3" checked>
                        <label class="onoffswitch-label" for="switch3">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                 </div>
            </div>


            <div class="mod-bg m-only">
                <img src="/Cyinf/img/CyinfLogo.png">
            </div>
        </div>
    </div>
-->

    <!-- link modal area -->
    
<!--
    <div id="link-modal" class="orangeModal mod">
        <img src="/Curr/img/close.png" class="closeBtn">
        <div class="mod-content">
            <div class="mod-title">
                <h4 class="mod-title-text">帳號連結</h4>
            </div>
            <div class="mod-item mod-link">
                <img class="mod-image" src="img/shortIcon.png">
                <span class="mod-text mod-link-text">連結中： Xgnid / 登出</span>
            </div>
            <div class="mod-item mod-link">
                <img class="mod-image" src="img/fb-blue.png">
                <span class="mod-text mod-link-text">連結中： Xgnid / 登出</span>
            </div>
            <div class="mod-bg m-only">
                <img src="/Cyinf/img/CyinfLogo.png">
            </div>
        </div>
    </div>-->
    <section id="container-wrap">

    </section>

    <footer id="footer">

    </footer>

@include('includes.scriptInclude')
<script type="text/javascript" src="/Curr/js/main.js"></script>
@yield('scriptArea')

</body>
</html>
