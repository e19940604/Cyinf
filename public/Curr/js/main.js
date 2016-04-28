(function(){
    var m_sideBtn = $('#m-side');
    var sideMenu = $('#sideMenu');
    var bg = $('#blackBG');
    var sideMenuStatus = false;
    var bgStatus = false;

    m_sideBtn.on('click', function(){
        if( sideMenuStatus ){
            sideMenuHide();
            blackBGHide();
        }
        else{
            sideMenuShow();
            blackBGShow();
        }
    });

    bg.on('click', function(){
        if( sideMenuStatus === true )
            sideMenuHide();
        blackBGHide();
    })

    function sideMenuHide(){
        sideMenu.css('right', '-320px');
        sideMenuStatus = false;
    }

    function sideMenuShow(){
        sideMenu.css('right', '0'); 
        sideMenuStatus = true;
    }

    function blackBGHide(){
        bg.css('opacity', '0');
        bg.css('visbility', 'hidden');
    }

    function blackBGShow(){
        bg.css('opacity', '1');
        bg.css('visbility', 'visible');
    }

})();