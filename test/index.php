<?php
session_start();
ini_set("display_errors", "1");
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>Facebook Users</title>

        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/flaticon.css">
        <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
    <body>
        <nav class="light-blue lighten-1" role="navigation">
            <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Logo</a>
            </div>
        </nav>
        <div class="section no-pad-bot" id="index-banner">
            <div class="container">
                <div class="row margin-top-5p">
                    <div class="col s12 m12">
                        <div class="icon-block center">
                            <div class="col s12 center userinfo " style="display: none;">
                                <div class="preloader-wrapper  active fb_img_loader">
                                    <div class="spinner-layer spinner-blue-only">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div><div class="gap-patch">
                                            <div class="circle"></div>
                                        </div><div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div>
                                <img src="" id="fbuserProfile">
                            </div>
                            <div class="col s12 center userout" style="display: none;">
                                WelCome <username></username><br>
                                <a href="javascript:void(0);" class="fb_signout">Logout</a>
                            </div>
                            <button class="btn waves-effect waves-light  light-blue darken-4 btn_fb_login">
                                <div class="glyph-icon flaticon-facebook31 "> Connect with Facebook</div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row margin-top-5p useraction" style="display: none">
                    <div class="col s12 m4">
                        <div class="icon-block center">
                            <a class="btn importusers">Import Users</a>
                        </div>
                    </div>
                    <div class="col s12 m4">
                        <div class="icon-block center">
                            <a class="btn sendusermsg">Send Message</a>
                        </div>
                    </div>
                    <div class="col s12 m4">
                        <div class="icon-block center">
                            <a class="modal-trigger waves-effect waves-light btn" href="#modal1">Modal</a>

                            <!-- Modal Structure -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal1" class="modal modal-fixed-footer">
            <form method="post" id="feedpost">


                <div class="modal-content" style="overflow: auto">
                    <h4>Post to your wall</h4>
                    <hr>
                    <div class="center spinserContainer" style="display: none">
                        <div class="spins">
                            <div class="preloader-wrapper  active ">
                                <div class="spinner-layer spinner-yellow-only">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div><div class="gap-patch">
                                        <div class="circle"></div>
                                    </div><div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input  id="first_name"  name="title_feed" type="text" class="validate">
                            <label for="first_name">Title of feed</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="last_name" name="msg_feed" type="text" class="validate">
                            <label for="last_name">Message to wall</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="uriRedirection" name="uriRedirection" type="text" class="validate">
                            <label for="uriRedirection">Uri for redirection</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="desc" name="desc" type="text" class="validate">
                            <label for="desc">Description</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="imgurl" name="imgurl" type="text" class="validate">
                            <label for="imgurl">Image Url</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="actname" name="actname" type="text" class="validate">
                            <label for="actname">Action Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="actlink" name="actlink" type="text" class="validate">
                            <label for="actlink">Action Link</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="modal-action  waves-effect waves-green btn-flat postfeed">Post</a>
                </div>

            </form>

        </div>



        <!--  Scripts-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script>
            fbuserid = '<?php echo @$_SESSION["fb_responce"]['id'] ?>';

            console.log(fbuserid);
            if (fbuserid != 0)
            {
                //window.location.replace('home.php');
            }

        </script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
        <script src="js/fbscript.js"></script>


    </body>
</html>
