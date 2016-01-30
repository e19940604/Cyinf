var department;
var oneUI;
var fourUI;
var searchURL;
var courseShow;

function init(){
    courseShow = $("#courseShow");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

function logoChangeMouseOut() 
{
    $("#logo").attr( "src", "img/facing-white.png" );
}

function countDirect( $sec ) 
{
    setTimeout( "countDirect(" +sec+ ")", 1000 ); 
}

function toHome() 
{
    location.href = "/";
}

function mobileOnclick( $target )
{
    location.href = $target;
}

function mLogoutAjax()
{
    var data = "";
    
    $.post( "logout", data, function() {
        
    });
}

function mloginAjax() 
{
    var data = $("#loginForm").serialize();

    $.post( "login", data, function(result) {
        if( result == "success" ) {
            $("#loginForm").empty();
            $("#loginForm").append( "Welcome Back<br />" );
        }
        else if ( result == "fail" ) {
            var message = '* Wrong Information. Try Again.';
            $("#loginMessage").html( message );
            $("#password").val('');
        }
    } ); 
}

function loginAjax() 
{
    var data = $("#loginForm").serialize();
    
    $.post( "/login", data, function(result) {
        if( result == "success" ) {
            $("#loginForm").empty();
            $("#loginForm").append( "<legend>Welcome Back</legend><br />" );
            setTimeout(toHome, 1000);
        }
        else if ( result == "fail" ) {
            var message = '* Wrong Information. Try Again.';
            $("#loginMessage").html( message );
            $("#password").val('');
        }
    } ); 
}

function showNsysuForm()
{
    $("#registerForm").fadeIn();
    $("#forgetForm").fadeIn();
    $("#registerBack").fadeIn();
    $("#checkIdentity").hide();
}

function showTeacherForm()
{
    $("#teacherForm").fadeIn();
    $("#registerBack").fadeIn();
    $("#checkIdentity").hide();
}

function showOtherForm()
{
    $("#othersForm").fadeIn();
    $("#registerBack").fadeIn();
    $("#checkIdentity").hide();
}

function registerBack()
{
    $("#registerForm").hide();
    $("#teacherForm").hide();
    $("#othersForm").hide();
    $("#forgetForm").hide();
    $("#checkIdentity").fadeIn();
    $("#registerBack").hide();
}

function registerAjax( $register ) 
{
    $("#registerBtn").attr("disabled",true);
    
	var target , datas;
	
    if( $register == 1 )
        target = $("#registerForm");
    else if( $register == 2 )
        target = $("#teacherForm");
    else if( $register == 3 )
        target = $("#othersForm");
    else{
        location.href = "register";
    } 
    
	datas = target.serialize();
    var login = "#loginMessage" + $register;
    $.post( "/register", datas, function(json) {

            if ( json.status == "fail" ) {
                $("#registerBtn").attr("disabled",false);
                $(login).empty();
                $(login).html( json.message );
                $("#"+json.filed).addClass('error_field');
                $("#"+json.filed).focus();
            }
            else if (json.status == "success" ) {
                //$("#registerBack").hide();
                $(".registerLaw").empty();
                target.empty();
                target.html( json.message );
            }

        /*$.each( json.data, function() {
            if ( this['status'] == "fail" ) {
                $("#registerBtn").attr("disabled",false);
                $(login).empty();
                $(login).html( this['message'] );
            }
            else if ( this['status'] == "success" ) {
                //$("#registerBack").hide();
                $(".registerLaw").empty();
                target.empty();
                target.html( this['message'] );
            }
        } );*/
        
    }, "json" );
}

function setDepartment( $value ) 
{
    department = $value;
    $("#back").attr( "href", "#slide-3" );
    
    // Web
    
    var general = '<a href="#searching" onclick="departmentSearch(6)">全年級</a>';
    var total = '<a href="#searching" onclick="departmentSearch(1)">一年級</a><a href="#searching" onclick="departmentSearch(2)">二年級</a><a href="#searching" onclick="departmentSearch(3)">三年級</a><a href="#searching" onclick="departmentSearch(4)">四年級</a><a href="#searching" onclick="departmentSearch(5)">研究所</a><a href="#searching" onclick="departmentSearch(6)">全年級</a>';
    
    if ( ($value >= 0 && $value <= 4) || ($value >= 6 && $value <= 17) ) {
        // General Class
        $("#gradeContent").empty();
        $("#gradeContent").html( general );
    }
    else if ( $value == 22 || $value == 25 || $value == 30 || $value == 31 || $value == 36 || $value == 40 || $value == 41 || $value == 43 || $value == 44 || $value == 45 || $value == 47 || $value == 48 || ($value >= 53 && $value <= 59) ) {
        // Master
        $("#gradeContent").empty();
        $("#gradeContent").html( general );   
    }
    else {
        $("#gradeContent").empty();
        $("#gradeContent").html( total ); 
    }
    
    // Mobile
    $("#four").css( "visibility", "visible" );
    $("#one").parent().append(fourUI);
    oneUI = $("#one");
    $("#one").remove();
}

function returnLastPage() 
{
    location.href = document.referrer;
}

function mMemberAjax() 
{
    var data = $("#memberForm").serialize();
    
    $.post( "memberUpdateAjax", data, function(json) {
        
        $.each( json.data, function() {
            if ( this['status'] == "fail" ) {
                alert(this['message']);
                $("#loginMessage").empty();
                $("#loginMessage").html( this['message'] );
            }
            else if ( this['status'] == "login" ) {
                
            }
            else if ( this['status'] == "success" ) {
                location.href= "mmember";
            }
        } );
    }, "json" );
}

function memberAjax() 
{
    var data = $("#memberForm").serialize();
    data = data + "&stu_id=" + $("#studnet_id").html().trim();
    $.post( "/users/update", data, function(json) {
        if ( json.status == "fail"  || json.status == "success") {
            $("#loginMessage").empty();
            $("#loginMessage").html( json.message );
        }
    }, "json" );
}

function commentJudge ( comment, option )
{
    var url = "/love/" + comment + "/" + option;
    var like = $("#loveArea" + comment);
    var dislike = $("#dislikeArea" + comment);

    $.ajax( url ,{
        type: "post",
        dataType: "json",
        content: null,
        statusCode: {
            401: function() {
                swal({
                    title: "請先登入",
                    text: "釘選前請先登入。",
                    type: "warning",
                }, function(){
                    location.href = "/users/login";
                });

            }
        },
        success: function( data ){
            if( data.status == "success" ){
                if ( option == 1 ) {
                    var count = document.getElementById('loveArea'+comment).innerHTML;
                    like.empty();
                    like.html( (parseInt( count, 10 ) + 1) );
                }
                else {
                    var count = document.getElementById('dislikeArea'+comment).innerHTML;
                    dislike.empty();
                    dislike.html( (parseInt( count, 10 ) + 1) );
                }
            }
            else{
                swal( "" , data.msg , "warning");
            }
        }
    });
    /*
    $.post( "loveAjax", data, function(json) {
        $.each( json.data, function() {
            if ( this['status'] == "fail" ) {
                alert(this['message']);
            }
            else if ( this['status'] == "login" ) {
                alert(this['message']);
            }
            else if ( this['status'] == "success" ) {
                if ( $option == 1 ) {
                    var count = document.getElementById('loveArea'+$comment).innerHTML;
                    $("#loveArea" + $comment).empty();
                    $("#loveArea" + $comment).html( (parseInt( count, 10 ) + 1) );
                }
                else {
                    var count = document.getElementById('dislikeArea'+$comment).innerHTML;
                    $("#dislikeArea" + $comment).empty();
                    $("#dislikeArea" + $comment).html( (parseInt( count, 10 ) + 1) );
                }
            }
        } );
    }, "json" );*/
}

function favoriteAjax( course )
{
    var url = "/pin/" + course + "/0";

    $.ajax( url ,{
        type: "post",
        dataType: "json",
        content: null,
        statusCode: {
            401: function() {
                swal({
                    title: "請先登入",
                    text: "釘選前請先登入。",
                    type: "warning",
                }, function(){
                    location.href = "/users/login";
                });

            }
        },
        success: function( data ){
            $("#courseArea"+course).remove();
        }
    });
}

function pinAjax( course, option )
{
    var clickedItem = this;
    var url = "/pin/" + course + "/" + option;

    var success = "<a href='#searching' class='glyphicon glyphicon-ok' onclick='pinAjax(" + course + ", 0)'></a>";
    var cancel = "<a href='#searching' class='glyphicon glyphicon-pushpin' onclick='pinAjax(" + course + ", 1)'></a>";
    var pined_course = $("#pinArea"+course);

    console.log(clickedItem );
    $.ajax( url ,{
        type: "post",
        dataType: "json",
        content: null,
        statusCode: {
            401: function() {
                swal({
                    title: "請先登入",
                    text: "釘選前請先登入。",
                    type: "warning",
                }, function(){
                    location.href = "/users/login";
                });

            }
        },
        success: function( data ){
            if( data.status == "success" ){
                console.log( "XD") ;
                pined_course.empty();
                if( option == 1)
                    pined_course.html( success );
                else
                    pined_course.html( cancel );

                swal( "ＯＫ" , data.msg , "success");
            }
            else{
                swal( "錯誤" , data.msg , "error");
            }

        }
    });
}

function mPinAjax( $course, $option ) 
{
    var data = "id=" + $course;
    var success = "PIN：<a href='#searching' class='glyphicon glyphicon-ok' onclick='mPinAjax(" + $course + ", 0)'></a>";
    var cancel = "PIN：<a href='#searching' class='glyphicon glyphicon-pushpin' onclick='mPinAjax(" + $course + ", 1)'></a>";
    
    $(this).html("<img src='../img/ajax-loader.gif' alt='loading...' />");
    
    if ( $option == 1 ) {
        $.post( "pinAjax", data, function(json) {

            $.each( json.data, function() {
                if ( this['status'] == "fail" ) {
                    alert(this['message']);
                }
                else if ( this['status'] == "hack" ) {
                    alert(this['message']);
                }
                else if ( this['status'] == "success" ) {
                    $("#pinArea"+$course).empty();
                    $("#pinArea"+$course).html( success );
                }
            } );
            
        }, "json" );
    }
    else if ( $option == 0 ) {
        $.post( "unPinAjax", data, function(json) {

            $.each( json.data, function() {
                if ( this['status'] == "fail" ) {
                    alert(this['message']);
                }
                else if ( this['status'] == "hack" ) {
                    alert(this['message']);
                }
                else if ( this['status'] == "success" ) {
                    $("#pinArea"+$course).empty();
                    $("#pinArea"+$course).html( cancel );
                }
            } );
            
        }, "json" );
    }

}

/* by Ding */
/* THIS SHOULD IMPROVE IN THE FUTURE !!!! */
function courseSearch()
{
    var courseName = $("#courseForm").serialize().substr(11);

    var url = "/search/course/" + courseName;

    $.post( url , null , function(result) {
        courseShow.empty();
        courseShow.append( result );
        $('#courseInput').val('');
        location.href = "search#searching";
    });
}


/* THIS SHOULD IMPROVE IN THE FUTURE !!!! */
function professorSearch()
{
    var professor = $("#professorForm").serialize().substr(14);

    var url = "/search/professor/" + professor;
    
    $.post( url , null, function(result) {
        courseShow.empty();
        courseShow.append( result );
        $("#professorInput").val('');
	    location.href = "search#searching";
    } );
}

function mDepartmentSearch( $grade ) 
{
    // Reset UI
    fourUI = $("four");
    $("#four").parent().append( oneUI );
    $("#four").remove();
    location.href = "mSearchResult?department=" + department + "&grade=" + $grade + "&type=3";
}

function departmentSearch( grade )
{
    var dep_grade = department + "," + grade;
    var url = "/search/department/" + dep_grade;
 
    $.post( url , null, function(result) {
        courseShow.empty();
        courseShow.append( result );
    } );
}

function courseJudgeAjax()
{
    $("#commentDetails").submit();
}

function mCourseJudgeAjax() 
{
    var data = $("#commentDetails").serialize();
    
    $.post( "judgeResult", data, function(json) {
        
        $.each( json.data, function() {
            if ( this['status'] == "fail" ) {
                $("#loginMessage").empty();
                $("#loginMessage").html( this['message'] );
            }
            else if ( this['status'] == "already" ) {
                alert(this['message']);
                location.href = "mcourseDetail?id=" + $("#course_id").val();
            }
            else if ( this['status'] == "login" ) {
                alert(this['message']);
                location.href = "mcourseDetail?id=" + $("#course_id").val();
            }
            else if ( this['status'] == "success" ) {
                alert(this['message']);
                location.href = "mcourseDetail?id=" + $("#course_id").val();
            }
        } );
        
    }, "json" );
}

function backRemind() 
{
    $("#back").attr( "href", "#slide-main" );
}

/* by snowcookie */

function ranksearch()
{
	for( var number = 1 ; number <= 12 ; number++ ){
		rankAjax( number );
	}	
}

function rankAjax( $number )
{	
	var data = "rank_order=" + $number;
	$.post( "rankAjax" , data , function ( result ){
		$("table:nth-of-type("+$number+") tbody").append( result );
	} );
}

function resentmail(){
    
    var message;
    message = "<p>sending mail</p>";
    $("#mailMessage").empty();
    $("#mailMessage").append(message);
	var data = "stu_id=" + $("#studnet_id").html().trim();
	$.post( "/users/resendActiveMail" , data , function( result ){
			$('#mailMessage').empty();
			$('#mailMessage').append( result );
	} );
}

function forgetAjax( $type ) 
{
    if( $type == 1 )
        target = $("#forgetForm");
    else if( $type == 2 )
        target = $("#teacherForm");
    else if( $type == 3 )
        target = $("#othersForm");
    else{
        location.href = "register";
    } 
    
	datas = target.serialize() + "&type=" + $type;
    var login = "#loginMessage" + $type;
    
    if( $type == 1){
        $("#sentPasswd").attr("disabled",true);
    
        $.post( "forgetAjax", datas, function(json) {
            
            $.each( json.data, function() {
                if ( this['status'] == "fail" ) {
                    $("#sentPasswd").attr("disabled",false);
                    $(login).empty();
                    $(login).html( this['message'] );
                }
                else if ( this['status'] == "success" ) {
                    $(target).empty();
                    $("#registerBack").hide();
                    $(target).html( this['message'] );
                }
            } );
            
        }, "json" );
    }
    else if( $type == 2 || $type == 3){
        alert(datas);
        $.post( "forgetOthersAjax", datas, function(json) {
            
            $.each( json.data, function() {
                if ( this['status'] == "fail" ) {
                    $("#sentPasswd").attr("disabled",false);
                    $(login).empty();
                    $(login).html( this['message'] );
                }
                else if ( this['status'] == "success" ) {
                    $(target).empty();
                    goResetPwd( this['email']);
                    $("#resetForm").show();
                    $("#registerBack").hide();
                }
            } );
            
        }, "json" );
    }
    else{
        location.href = "register";
    }
}

function goResetPwd( $email ){
    tmp_email = $email;
}

function resetOthers(){
    var data = $("#resetForm").serialize() + "&email=" + tmp_email;
    
    $.post( "resetOthersAjax", data, function(json) {
            $.each( json.data, function() {
                if ( this['status'] == "fail" ) {
                    $("#sentPasswd").attr("disabled",false);
                    $("#loginView").empty();
                    $("#loginView").html( this['message'] );
                }
                else if ( this['status'] == "success" ) {
                    alert("更改密碼成功!!");
                    location.href = "loginView";
                }
            } );
            
        }, "json" );
}
               
/* by yao-ming */

function goReset(){
	location.href = "resetPassword";
}

function resetPassword(){
	var data = $("#resetForm").serialize();

    $.post( "resetPasswordFunc", data, function(json) {
		$.each( json.data, function() {
            if ( this['status'] == "fail" ) {
                $("#loginMessage").empty();
                $("#loginMessage").html( this['message'] );
            }else if ( this['status'] == "login" ) {
                alert(this['message']);
                location.href = "loginView";
            }
            else if ( this['status'] == "success" ) {
                location.href = "logout";
            }
        } );
    } , "json" );
}

/* by ding */
function addToPK( courseID ){
    var data = "courseID=" + courseID;
    var btn = $("#PKbtn");
    $.post( "addToPK", data , function(json) {
        $.each( json, function(){
            alert( this['msg'] );
            console.log( this['status']);
            if( this['status'] === "notlogin"){

                location.href = "loginView";
            }
            else{
                btn.removeClass('btn-danger');
                btn.addClass('btn-warning');
                btn.attr('onclick','deleteFromPK(' + courseID + ')');
                btn.text('從P.K.列表中移除');
            }
        }); 
    } , "json");
}

function deleteFromPK( courseID ){
    var data = "courseID=" + courseID;
    var btn = $("#PKbtn");
    $.post( "deleteFromPK", data , function(json) {
        $.each( json, function(){
            alert( this['msg'] );
            btn.removeClass('btn-warning');
            btn.addClass('btn-danger');
            btn.attr('onclick','addToPK(' + courseID + ')');
            btn.text('新增至P.K.列表中');
        });
    } , "json");
}

function deleteFromPKonPage( courseID ){
    var data = "courseID=" + courseID;
    var btn = $("#PKbtn");
    $.post( "deleteFromPK", data , function(json) {
        $.each( json, function(){
            alert( this['msg'] );
            if( this['status'] === 'success'){
                if( this['empty'] === true ){
                    $('table').remove();
                    $('#errors').html('<h3>目前並沒有任何課程存於列表中，快去<a href="search#slide-main">評鑑系統</a>中挑選吧！</h3>');
                }
                else{
                    $('.' + courseID).remove();
                }
            }
            else
                location.reload();
        });
    } , "json");
}

/* moving page */

var url = document.URL;

if( ( url.match('140.117.202.154') || url.match('studio.cdpa.tw') ) && url.match('moving') == null ){
	location.href = "http://140.117.202.154/moving";
}