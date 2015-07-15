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
        <title>Starter Template - Materialize</title>

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
                    <div class="col s12 m4">
                        <div class="icon-block center">


                            <?php
                            if (isset($_SESSION["fb_responce"])) {
                                ?>
                                <div class="col s12 center">
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
                                <div class="col s12 center">

                                    WelCome <?php echo $_SESSION["fb_responce"]['name'] ?><br>
                                    <?php
                                    if ($_SESSION["fb_responce"]['name'] != '') {
                                        ?>
                                        <a href="javascript:void(0);" class="fb_signout">Logout</a>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <?php
                                // echo '<pre>';
                                // print_r($_SESSION["fb_responce"]);
                                // echo '</pre>';
                            } else {
                                ?>
                                <button class="btn waves-effect waves-light  light-blue darken-4 btn_fb_login">
                                    <div class="glyph-icon flaticon-facebook31 "> Connect with Facebook</div>
                                </button>
                                <?php
                            }
                            ?>



                        </div>
                    </div>

                   
             

            
            </div>
          

        </div>
    </div>





    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script>
        fbuserid = '<?php echo @$_SESSION["fb_responce"]['id'] ?>';
        console.log(fbuserid);
       
    </script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    <script src="js/fbscript.js"></script>


</body>
</html>
