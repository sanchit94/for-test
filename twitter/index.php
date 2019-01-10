<?php

session_start();

$con = mysqli_connect("localhost","getinfino_datab79","datab797979","getinfino_datab79");
if(!$con)
{
    echo 'connection problem';
}


require 'autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
define('CONSUMER_KEY', 'EhLNvq8US8WbDOsVqNstsbr20'); 	// add your app consumer key between single quotes
define('CONSUMER_SECRET', 'XvYmv3pquCQEAvjMkT8jWjUrzMsqrqOixyLymiFpY8gCgl2ygI'); // add your app consumer 																			secret key between single quotes
define('OAUTH_CALLBACK', 'http://getinfino.com/twitter/callback.php'); // your app callback URL i.e. page 																			you want to load after successful 																			  getting the data
//define('oauth_token', '842987337353052160-LL8z2AHxYRP7lHo8iDaq8cLNzeSu8OP');
//define('oauth_token_secret', '6eZZno5qC6d8E5Gtc9jakmhEgvP07F3MfxOBwJ5ysLm8x');
if (!isset($_SESSION['access_token'])) {
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
	//echo $url;
	echo "<a href='$url'><img src='twitter-login-blue.png' style='margin-left:4%; margin-top: 4%'></a>";
} else {
	$access_token = $_SESSION['access_token'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	$user = $connection->get("account/verify_credentials", ['include_email' => 'true']);
	
	$username = $user->screen_name."@twitter.com";
 $name = $user->name;
 
  $t= mysqli_query($con,"select * from users where email='$username'");
    if(mysqli_num_rows($t)==0)
    {
     
$ref = $_COOKIE['ref'];
        $gb= mysqli_query($con,"select * from users where id='$ref'");
        $ftf = mysqli_fetch_array($gb);
        $em = $ftf['email'];
        $id = rand(10000000,99999999);
        mysqli_query($con,"insert into users (email,id,name) values ('$username','$id','$name') ");
        mysqli_query($con,"INSERT INTO `refer`(`inviter`, `refer`) VALUES ('$em','$username')");
    }
  
        $_SESSION['user'] = $username;
        header("location:../page.php");
        
        
//    $user1 = $connection->get("https://api.twitter.com/1.1/account/verify_credentials.json", ['include_email' => true]);
    echo "<img src='$user->profile_image_url'>";echo "<br>";		//profile image twitter link
    echo $user->name;echo "<br>";									//Full Name
    echo $user->location;echo "<br>";								//location
    echo $user->screen_name;echo "<br>";							//username
    echo $user->created_at;echo "<br>";
//    echo $user->profile_image_url;echo "<br>";
    echo $user->email;echo "<br>";									//Email, note you need to check permission on Twitter App Dashboard and it will take max 24 hours to use email 
    echo "<pre>";
    print_r($user);
    echo "<pre>";								//These are the sets of data you will be getting from Twitter 												Database 
}