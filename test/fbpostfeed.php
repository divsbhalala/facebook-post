<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Initialize facebook sdk

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once("lib/facebook.php");
require_once("fbCredentials.php");
$config = array();
$config['appId'] = $AppId;
$config['secret'] = $AppSecret;
$config['fileUpload'] = true;
$facebook = new Facebook($config);


if (!isset($_SESSION["fb_accesstoken"])) {
    $facebook->getAccessToken();
} else
    $facebook->setAccessToken($_SESSION["fb_accesstoken"]);

$uid = $facebook->getUser();
if ($uid == 0) {
    header('location:index.php');
}
$_SESSION["fb_accesstoken"]= $facebook->getAccessToken();
//echo '<pre>';
//print_r($_POST);

$msg = @$_POST['title_feed'];
$title = @$_POST['msg_feed'];
$uri = @$_POST['uriRedirection'];
$desc = @$_POST['desc'];
//$pic = 'http://blog.phpinfinite.com/wp-content/uploads/2012/11/post_to_facebook_from_php.jpg';
//$pic = 'https://upload.wikimedia.org/wikipedia/en/1/11/Varkala_Beach_High_Res.jpg';
//$pic = 'http://www.hd-wallpapers9.com/gallery/Flowers/Flowers%20High%20Resolution%20Wallpapers/Flowers%20High%20Resolution%20Wallpapers-017.jpg';
//$pic = 'http://www.hd-free-wallpapers.org/wp-content/uploads/2014/09/widescreen-wallpapers-high-resolution-470x300.jpg';
//$pic = 'http://www.adecco.com/MediaLibrary/HonoraryPresidents/PhilippeFDestezet01_LowRes.jpg';
$pic =@$_POST['imgurl'];
$action_name = @$_POST['actname'];
$action_link = @$_POST['actlink'];

$attachment1 = array(
 'access_token' =>$_SESSION["fb_accesstoken"],
 'message' => $msg,
 'name' => $title,
 'link' => $uri,
 'description' => $desc,
 'picture'=>$pic,
 'actions' => json_encode(array('name' => $action_name,'link' => $action_link))
 );
$status = $facebook->api("/me/feed", "post", $attachment1);

//print_r($status);
echo json_encode($status);


