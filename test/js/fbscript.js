/**
 * Created by sweet on 17/1/15.
 */


var fbAuthResp;
var album_single = '';
var userid = '';
var fb_user_info = '';

$(document).ready(function () {
$('.modal-trigger').leanModal();



//Click To logout
    $('.fb_signout').click(function () {
        FB.logout(function (response) {
            $.ajax({
                url: 'fbstatus.php',
                type: 'post',
                data: {
                    'removedir': userid
                },
                success: function (data) {
                    window.location.replace('index.php');

                }

            });


        });
    });




    //$('')
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    var fbAuthResp;
    window.fbAsyncInit = function () {
        FB.init({
            appId: '485247754943027',
            cookie: true, // enable cookies to allow the server to access
            // the session
            xfbml: true, // parse social plugins on this page
            version: 'v2.2' // use version 2.1
        });

        FB.getLoginStatus(function (response) {

            if (response.status === 'connected') {


                userinfo(response);

            } else if (response.status === 'not_authorized') {
                // The person is logged into Facebook, but not your app.
                // $('#fbstyle').show();
                //$('#fbstylelog').hide();
                console.log('Please log into this app.');
            } else {
                // The person is not logged into Facebook, so we're not sure if
                // they are logged into this app or not.
                // $('#fbstyle').hide();
                //$('#fbstylelog').show();
                console.log('Please log into facebook.');
            }
        });

    };

    $(".btn_fb_login").click(function () {
        FB.login(function (response) {
            userinfo(response);
            window.location.replace('home.php');

        }, {scope: 'email,user_photos'})
    });

    function userinfo(response)
    {
        if (response.authResponse) {
            fbAuthResp = response;
            //Set Accesstoken of user in session

            $.ajax({
                url: 'fbstatus.php',
                type: 'post',
                data: {
                    'fb_accesstoken': response.authResponse.accessToken
                },
                success: function (data) {

                }
            }).done(function () {
                getuserprofile(fbAuthResp)
            });
            // alert(response.authResponse.accessToken);


        }

    }


    function getuserprofile(response) {
        FB.api('/me', function (response) {
            $('.btn_fb_login').hide();
            $('.userinfo,.userout').show();
            $('.fb_img_loader').hide(400);
            $('#fbuserProfile').hide();
            $('username').text(response.first_name + '  ' + response.last_name)
            $('#fbuserProfile').attr('src', 'http://graph.facebook.com/' + response.id + '/picture');
            $('#fbuserProfile').fadeIn(800);
            $('.useraction').show();
            // $('#ProfilePic').css('width','100%');
            //document.getElementById('username').innerHTML = response.name;
            userid = response.id;
            console.log(response);
            fb_user_info = response;
            $.ajax({
                url: 'fbstatus.php',
                type: 'post',
                data: {
                    'fb_responce': response
                },
                success: function (data) {
                    //window.location.reload();
                    //console.log(response)
                }
            });




        });
        FB.api('/me/friends', function (response) {
            console.log(response);
        });



    }
    $(document).on('click', '.sendusermsg', function () {
        FB.ui({
            method: 'send',
            link: 'http://www.nytimes.com/interactive/2015/04/15/travel/europe-favorite-streets.html',
        });
    });
    $(document).on('click', '.userfeed', function () {
        FB.ui({
            method: 'feed',
            link: 'https://developers.facebook.com/docs/',
            caption: 'An example caption',
        }, function (response) {
        });
    });

    $('.searchUsers').click(function () {

        var whichuser = $('.whichuser');
        if (whichuser.val().trim() != '')
        {
            if (userid != '')
            {
                $('.fb_user_loader').addClass('active')
                // $srcs = FB.api('search?type=user&q=div&limit=500');
                FB.api('search?type=user&q=divy&limit=500', function (response) {
                    console.log(response)
                    // console.log(response.data.length)
                    if (response.data.length > 0)
                    {
                        $('.userlist').remove();

                        for (var i = 0; i < response.data.length; i++)
                        {

                            $('.fb_user_list').append('<div class="userlist">' +
                                    ' <img src="http://graph.facebook.com/' + response.data[i].id + '/picture">' +
                                    '<span class="user">' + response.data[i].name + '</span>' +
                                    '</div>');
                        }
                        $('.fb_user_loader').removeClass('active');
                    }



                });
            }
            else
            {
                $.ajax({
                    type: 'POST',
                    beforeSend: function (xhr) {
                        $('.tweet_user_loader').addClass('active');
                    },
                    url: "getTweetUser.php",
                    data: {'username': whichuser.val().trim()},
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        console.log(data.length)
                        if (data.length > 0)
                        {

                            $('.tweet_user_loader').addClass('active');
                            $('.userlist').remove();
                            for (var i = 0; i < data.length; i++)
                            {

                                $('.tweet_user_list').append('<div class="userlist">' +
                                        ' <img src=' + data[i].profile_image_url + '>' +
                                        '<span class="user">' + data[i].name + '</span>' +
                                        '</div>');
                            }
                            $('.fb_user_loader').removeClass('active');
                        }
                    },
                    complete: function (jqXHR, textStatus) {
                        $('.tweet_user_loader').removeClass('active')
                    }
                })
            }



        }
    });
    
    $('.postfeed').click(function (e){
        e.preventDefault();
        $('.spinserContainer').show();
        console.log($('#feedpost').serialize());
       // $('#feedpost').attr('action','fbpostfeed.php');
        //$('#feedpost').submit();
        $.ajax({
            type: 'POST',
            data:$('#feedpost').serialize(),
            dataType: 'json',
            url: "fbpostfeed.php",
            success: function (data, textStatus, jqXHR) {
                console.log(data)
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
                 $('.spinserContainer').hide();
            }
        }).done(function (data){
            if(data.id!='')
            {
                $('#modal1').closeModal();
                 $('.spinserContainer').hide();
            }
        })
        
        
    });


});

