<?php

if (!session_id()) {
    session_start();
}

if(isset($_SESSION['user']))
{
    header("location:page.php");
}

 $ref = $_REQUEST['invite'];
 
 setcookie("ref", $ref, time()+3600);  /* expire in 1 hour */

require_once __DIR__ . '/facebook/autoload.php'; 

require_once __DIR__ . '/sendgrid/autoload.php'; 

$fb = new \Facebook\Facebook([
  'app_id' => '834325736910363',
  'app_secret' => 'e177b2e2fa18036a1fec5db95e327b52',
  'default_graph_version' => 'v2.2',
  //'default_access_token' => '{access-token}', // optional
]);
  
  $helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://www.getinfino.com/fb-callback.php', $permissions);

include('config.php');

require_once __DIR__ . '/twitter/autoload.php'; 

use Abraham\TwitterOAuth\TwitterOAuth;
define('CONSUMER_KEY', 'LTmPF81PIFNF26t4rBZ95tObq'); 	// add your app consumer key between single quotes
define('CONSUMER_SECRET', '3kCLGjvokJrTPEpxJjXVn61SLCVQvPWYwOwr0geBMb1tP2LmcA'); // add your app consumer 																			secret key between single quotes
define('OAUTH_CALLBACK', 'https://www.getinfino.com/twitter/callback.php'); // your app callback URL i.e. page 

if (!isset($_SESSION['access_token'])) {
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
	//echo $url;
//	echo "<a href='$url'><img src='twitter-login-blue.png' style='margin-left:4%; margin-top: 4%'></a>";
} else {
	$access_token = $_SESSION['access_token'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	$user = $connection->get("account/verify_credentials", ['include_email' => 'true']);
//    $user1 = $connection->get("https://api.twitter.com/1.1/account/verify_credentials.json", ['include_email' => true]);
//    echo "<img src='$user->profile_image_url'>";echo "<br>";		//profile image twitter link
  //  echo $user->name;echo "<br>";									//Full Name
  //  echo $user->location;echo "<br>";								//location
//    echo $user->screen_name;echo "<br>";							//username
 //   echo $user->created_at;echo "<br>";
//    echo $user->profile_image_url;echo "<br>";
 //   echo $user->email;echo "<br>";									//Email, note you need to check permission on Twitter App Dashboard and it will take max 24 hours to use email 
//    echo "<pre>";
 //   print_r($user);
 //   echo "<pre>";								//These are the sets of data you will be getting from Twitter 												Database 
 

    
}

if(isset($_REQUEST['signup']))
{
    extract($_REQUEST);
    
    $t= mysqli_query($con,"select * from users where email='$email'");
    if(mysqli_num_rows($t)==0)
    {
        
      
        $ref = $_REQUEST['invite'];
        $gb= mysqli_query($con,"select * from users where id='$ref'");
        $ftf = mysqli_fetch_array($gb);
        $em = $ftf['email'];
        
        $token = "VER".rand(100000000000,999999999999)."d3cOdeGenteP".$ftf['sn'];
        
        $id = rand(10000000,99999999);
        mysqli_query($con,"insert into users (email,id,name,verify) values ('$email','$id','$name','0') ");
        mysqli_query($con,"INSERT INTO `verify`(`email`, `otp`) VALUES ('$email','$token')");
        $emailer = new \SendGrid\Mail\Mail(); 
        $emailer->setFrom("codegente@gmail.com", "codegente");
        $emailer->setSubject("Verification Email");
        $emailer->addTo($email, "Example User");
        $emailer->addContent("text/html", '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html data-editor-version="2" class="sg-campaigns" xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" /><!--[if !mso]><!-->
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" /><!--<![endif]-->
    <!--[if (gte mso 9)|(IE)]>
    <xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <!--[if (gte mso 9)|(IE)]>
    <style type="text/css">
      body {width: 600px;margin: 0 auto;}
      table {border-collapse: collapse;}
      table, td {mso-table-lspace: 0pt;mso-table-rspace: 0pt;}
      img {-ms-interpolation-mode: bicubic;}
    </style>
    <![endif]-->

    <style type="text/css">
      body, p, div {
        font-family: arial;
        font-size: 14px;
      }
      body {
        color: #000000;
      }
      body a {
        color: #1188E6;
        text-decoration: none;
      }
      p { margin: 0; padding: 0; }
      table.wrapper {
        width:100% !important;
        table-layout: fixed;
        -webkit-font-smoothing: antialiased;
        -webkit-text-size-adjust: 100%;
        -moz-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
      }
      img.max-width {
        max-width: 100% !important;
      }
      .column.of-2 {
        width: 50%;
      }
      .column.of-3 {
        width: 33.333%;
      }
      .column.of-4 {
        width: 25%;
      }
      @media screen and (max-width:480px) {
        .preheader .rightColumnContent,
        .footer .rightColumnContent {
            text-align: left !important;
        }
        .preheader .rightColumnContent div,
        .preheader .rightColumnContent span,
        .footer .rightColumnContent div,
        .footer .rightColumnContent span {
          text-align: left !important;
        }
        .preheader .rightColumnContent,
        .preheader .leftColumnContent {
          font-size: 80% !important;
          padding: 5px 0;
        }
        table.wrapper-mobile {
          width: 100% !important;
          table-layout: fixed;
        }
        img.max-width {
          height: auto !important;
          max-width: 480px !important;
        }
        a.bulletproof-button {
          display: block !important;
          width: auto !important;
          font-size: 80%;
          padding-left: 0 !important;
          padding-right: 0 !important;
        }
        .columns {
          width: 100% !important;
        }
        .column {
          display: block !important;
          width: 100% !important;
          padding-left: 0 !important;
          padding-right: 0 !important;
          margin-left: 0 !important;
          margin-right: 0 !important;
        }
      }
    </style>
    <!--user entered Head Start-->
    
     <!--End Head user entered-->
  </head>
  <body>
    <center class="wrapper" data-link-color="#1188E6" data-body-style="font-size: 14px; font-family: arial; color: #000000; background-color: #ffffff;">
      <div class="webkit">
        <table cellpadding="0" cellspacing="0" border="0" width="100%" class="wrapper" bgcolor="#ffffff">
          <tr>
            <td valign="top" bgcolor="#ffffff" width="100%">
              <table width="100%" role="content-container" class="outer" align="center" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td width="100%">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td>
                          <!--[if mso]>
                          <center>
                          <table><tr><td width="600">
                          <![endif]-->
                          <table width="100%" cellpadding="0" cellspacing="0" border="0" style="width: 100%; max-width:600px;" align="center">
                            <tr>
                              <td role="modules-container" style="padding: 0px 0px 0px 0px; color: #000000; text-align: left;" bgcolor="#ffffff" width="100%" align="left">
                                
    <table class="module preheader preheader-hide" role="module" data-type="preheader" border="0" cellpadding="0" cellspacing="0" width="100%"
           style="display: none !important; mso-hide: all; visibility: hidden; opacity: 0; color: transparent; height: 0; width: 0;">
      <tr>
        <td role="module-content">
          <p></p>
        </td>
      </tr>
    </table>
  
    <table class="wrapper" role="module" data-type="image" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
      <tr>
        <td style="font-size:6px;line-height:10px;padding:0px 0px 0px 0px;" valign="top" align="center">
          <img class="max-width" border="0" style="display:block;color:#000000;text-decoration:none;font-family:Helvetica, arial, sans-serif;font-size:16px;max-width:40% !important;width:40%;height:auto !important;" src="https://marketing-image-production.s3.amazonaws.com/uploads/d2d313ee62fc7320a1f8f85b08b098ef08e84138b6c5a9754506bd15b243e3a43498e352e083d83af1eb9b7e2168f0168aa8257fbc9dba378c38e4d7938638b0.jpg" alt="" width="240">
        </td>
      </tr>
    </table>
  
    <table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
      <tr>
        <td style="padding:18px 0px 18px 0px;line-height:22px;text-align:inherit;"
            height="100%"
            valign="top"
            bgcolor="">
            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tincidunt elementum sem non luctus. Ut dolor nisl, facilisis non magna quis, elementum ultricies tortor. In mattis, purus ut tincidunt egestas, ligula nulla accumsan justo, vitae bibendum orci ligula id ipsum. Nunc elementum tincidunt libero, in ullamcorper magna volutpat a.</div>
        </td>
      </tr>
    </table>
  <table border="0" cellPadding="0" cellSpacing="0" class="module" data-role="module-button" data-type="button" role="module" style="table-layout:fixed" width="100%"><tbody><tr><td align="center" bgcolor="" class="outer-td" style="padding:0px 0px 0px 0px"><table border="0" cellPadding="0" cellSpacing="0" class="button-css__deep-table___2OZyb wrapper-mobile" style="text-align:center"><tbody><tr><td align="center" bgcolor="#333333" class="inner-td" style="border-radius:6px;font-size:16px;text-align:center;background-color:inherit"><a href="http://getinfino.com/verify.php?token='.$token.'" style="background-color:#333333;border:1px solid #333333;border-color:#333333;border-radius:6px;border-width:1px;color:#ffffff;display:inline-block;font-family:arial,helvetica,sans-serif;font-size:16px;font-weight:normal;letter-spacing:0px;line-height:16px;padding:12px 18px 12px 18px;text-align:center;text-decoration:none" target="_blank">Verify Me</a></td></tr></tbody></table></td></tr></tbody></table>
    <table class="wrapper" role="module" data-type="image" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
      <tr>
        <td style="font-size:6px;line-height:10px;padding:0px 0px 0px 0px;" valign="top" align="center">
          <img class="max-width" border="0" style="display:block;color:#000000;text-decoration:none;font-family:Helvetica, arial, sans-serif;font-size:16px;max-width:100% !important;width:100%;height:auto !important;" src="https://marketing-image-production.s3.amazonaws.com/uploads/e8d4e9b944bb27c7f4d5a2af73774d2e2f29c11c43198155d8730892d88acd1e25ee0ef0dca5ed4fbd441ded58b106b30769acf1e9163d69f0e31b92af2df077.jpg" alt="" width="600">
        </td>
      </tr>
    </table>
  <div data-role="module-unsubscribe" class="module unsubscribe-css__unsubscribe___2CDlR" role="module" data-type="unsubscribe" style="color:#444444;font-size:12px;line-height:20px;padding:16px 16px 16px 16px;text-align:center"><div class="Unsubscribe--addressLine"><p class="Unsubscribe--senderName" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:20px">[Sender_Name]</p><p style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:20px"><span class="Unsubscribe--senderAddress">[Sender_Address]</span>, <span class="Unsubscribe--senderCity">[Sender_City]</span>, <span class="Unsubscribe--senderState">[Sender_State]</span> <span class="Unsubscribe--senderZip">[Sender_Zip]</span> </p></div><p style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:20px"><a class="Unsubscribe--unsubscribeLink" href="<%asm_group_unsubscribe_raw_url%>">Unsubscribe</a> - <a class="Unsubscribe--unsubscribePreferences" href="<%asm_preferences_raw_url%>">Unsubscribe Preferences</a></p></div>
                              </td>
                            </tr>
                          </table>
                          <!--[if mso]>
                          </td></tr></table>
                          </center>
                          <![endif]-->
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </div>
    </center>
  </body>
</html>');
        $emailer->addContent(
          "text/html", "<strong>http://getinfino.com/verify.php?token=".$token."</strong>"
        );
        $sendgrid = new \SendGrid('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');
        try {
            $response = $sendgrid->send($emailer);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
        
     //     $_SESSION['user'] = $email;
          header("location:email.php?email=".$email);
        
            }
           else {
               $ds = mysqli_fetch_array($t);
           if($ds['verify']==0){
             //  $_SESSION['user'] = $email;
                header("location:email.php?email=".$email);
           }
           else
           {
                  $_SESSION['user'] = $email;
                header("location:page.php");
           }
           }
        }

?>

<html xmlns="https://www.getinfino.com" xmlns:og="http://ogp.me/ns#" class="gr__webupdate_website"><head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Infino ⚡ A Card that doesn't suck</title>
	<meta property="og:title" content="Infino ⚡ Card that doesn't suck.">
	<meta property="og:type" content="article">
	<meta property="og:description" content="An AI-powered card that adapts to your spending habits and needs. Designed for Millennials, by Millennials.">
	<meta property="og:url" content="http://www.getinfino.com">
	<meta property="og:image" content="http://www.getinfino.com/asset/img/landing-page/infino.png">
	<link rel="shortcut icon" href="./asset/img/logo/favicon.ico">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:600,800" rel="stylesheet">
	<link rel="stylesheet" href="asset/css/addSlider.css">
<!--	<link rel="stylesheet" href="asset/css/animate.min.css"/>-->
	<link rel="stylesheet" href="asset/css/applify.min.css">
	<link rel="stylesheet" href="asset/css/additional.style.css">
	<script src="https://apis.google.com/_/scs/apps-static/_/js/k=oz.gapi.en.COaYzTRXlXk.O/m=auth2,client/rt=j/sv=1/d=1/ed=1/am=QQ/rs=AGLTcCMWUg7n4WrJDPw_obRv3Lg7jd5-FA/cb=gapi.loaded_0" async=""></script><script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script><script src="https://connect.facebook.net/signals/config/2274560892821825?v=2.8.37&amp;r=stable" async=""></script><script async="" src="https://connect.facebook.net/en_US/fbevents.js"></script><script src="asset/js/smarlook.js"></script><script async="" type="text/javascript" charset="utf-8" src="https://rec.smartlook.com/recorder.js"></script>
	
		<!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window,document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	 fbq('init', '2274560892821825'); 
	fbq('track', 'PageView');
	</script>
	<noscript>
	 <img height="1" width="1" 
	src="https://www.facebook.com/tr?id=2274560892821825&ev=PageView
	&noscript=1"/>
	</noscript>
	<!-- End Facebook Pixel Code -->
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-131901484-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-131901484-1');
	</script>
	<script src="https://wchat.freshchat.com/js/widget.js"></script>
	
<link href="https://wchat.freshchat.com/css/widget.css?t=1547034076472" rel="stylesheet"><script async="" crossorigin="anonymous" type="text/javascript" charset="utf-8" src="https://rec.smartlook.com/analytics-20181120122343.js"></script><script async="" crossorigin="anonymous" type="text/javascript" charset="utf-8" src="https://rec.smartlook.com/bundle-20181120122343.js"></script></head>
<body data-gr-c-s-loaded="true">

<!-- Navbar Fixed + Default -->
<nav class="navbar navbar-fixed-top navbar-light bg-white">
	<div class="container mt-1 mb-1">

		<!-- Navbar Logo -->
		<a class="ui-variable-logo navbar-brand" href="index.html" title="Transaqt - transact on the Go" style="width: 160px;">
			<!-- Default Logo -->
			<img class="logo-default" src="asset/img/logo/logo.png" alt="Transaqt - transact on the Go" data-uhd="">
		</a><!-- .navbar-brand -->


		<!-- Navbar Button -->
		<a href="mailto:support@getinfino.com" class="btn btn-sm ui-gradient-green pull-right">Get In Touch<span class="fa fa-rocket ml-1"></span></a>
        
        <!-- Navbar Toggle -->
<!--		<a href="#" class="ui-mobile-nav-toggle pull-right"></a>-->

	</div><!-- .container -->
</nav> <!-- nav -->

<!-- Main Wrapper -->
<div class="main" role="main">

	<!-- Hero -->
	<div class="ui-hero hero-lg hero-center neg-marg-btm-3-sm">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1>
						All your finances in one card
					</h1>
					<p class="paragraph">An AI-powered card that adapts to your spending habits and needs.<br> Designed for Millennials, by Millennials.</p>
<!--
					<h4 class="mt-4">
						Supercharge your payments with Infino!
					</h4>
					<p class="paragraph">Reserve your card before we run out.</p>
-->
					<div class="actions">
					    <form method="POST" class="subscribe-form" id="main-form" autocomplete="on">
					        <div class="row">
							<div class="col-sm-4">
                               
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" id="mc-email" placeholder="Please Enter Your Name...">
                                    
                                </div>
								
						    </div>

                            <div class="col-sm-4">
                               
                                <div class="input-group" style="width: 100%;">
                                    <input type="email" class="form-control" name="email" id="mc-email" placeholder="Please Email...">
                                    
                                </div>
								
						    </div>
						    <div class="col-sm-4">
               <button type="submit" name="signup" class="btn ui-gradient-peach no-marg">Signup <span class="fa fa-rocket ml-1"></span></button>	
                               </div>
						    
							</div>
							
              
                          
			  
			  <div class="col-md-12 text-center" style="margin-top:20px;">
                    <div class="row">
                        <div class="col-sm-4">
                            <a href="https://www.facebook.com/v2.2/dialog/oauth?client_id=2215689488649766&amp;state=ff0ae43802f0d2740440a9bb6d14e821&amp;response_type=code&amp;sdk=php-sdk-5.7.0&amp;redirect_uri=https%3A%2F%2Fwebupdate.website%2Frefer%2Ffb-callback.php&amp;scope=email" style="background: linear-gradient(45deg, #fe60a1 0%, #ff8765 100%);
    padding: 5px 5px 5px 5px;
    color: white;">Login With <i class="fa fa-facebook"></i></a>
                        </div>
                        <div class="col-sm-4">
                            <a href="https://api.twitter.com/oauth/authorize?oauth_token=4iekQwAAAAAA9OGdAAABaDJqlzo" style="background: linear-gradient(45deg, #fe60a1 0%, #ff8765 100%);
    padding: 5px 5px 5px 5px;
    color: white;">Login With <i class="fa fa-twitter"></i></a>
                        </div>
                        <div class="col-sm-4">
                             <a id="authorize-button" style="background: linear-gradient(45deg, #fe60a1 0%, #ff8765 100%);
    padding: 5px 5px 5px 5px;
    color: white;">Login With <i class="fa fa-google"></i></a>
                           
                        </div>    
                              <a id="signout-button" style="display:none"><i class="fa fa-google"></i></a>
                           
                    </div>   
                </div>
			  
                            </form>
					    
							

<!--
						<div class="sub-text mt-1">
							<a href="#awesomeModal" class="btn-link btn-arrow modal-link">Explore More</a>
						</div>
-->
					</div>
				</div>
				<div class="col-12 visible-sm">
					<img src="asset/img/landing-page/BG-Mobile.png" alt="Infino - All your cards in one card">
				</div>
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .ui-hero -->
	
	<!-- Showcase Section -->
	<div class="section works bg-white pb-6">
		<div class="container">
			<div class="section-heading center">
				<h2 class="heading text-indigo">
					How does it work?
				</h2>
			</div><!-- .section-heading -->
			<div class="row text-center">
				<div class="col-md-4 pb-5 push-up">
					<img class="img-responsive" src="asset/img/landing-page/works/first.png" data-uhd="" alt="Applify - App Landing HTML Template">
					<h5 class="text-dark-gray">Link Your Finances</h5>
					<p class="mb-0">
						Add your existing payment methods (Banks, Wallets &amp; Cards).
					</p>
				</div>
				<div class="col-md-4 pb-5 direction dir-1">
					<img class="img-responsive" src="asset/img/landing-page/works/second.png" data-uhd="" alt="Applify - App Landing HTML Template">
					<h5 class="text-dark-gray">Personalize Them</h5>
					<p class="mb-0">
						Set up your preferences: 
						Limits, Automation, classification of cards.
					</p>
				</div>
				<div class="col-md-4 pb-5 pull-down direction dir-2">
					<img class="img-responsive" src="asset/img/landing-page/works/third.png" data-uhd="" alt="Applify - App Landing HTML Template"><br><br>
					<h5 class="text-dark-gray">Transact With Your Infino Card</h5>
					<p class="mb-0">
						Link your Infino card to the application and start transacting.
					</p>
				</div>
			</div>
		</div><!-- .container -->
	</div>
	
	  
	<!-- Features Section -->
	<div class="section bg-light ui-showcase-section">
		<div class="container">
			<!-- Section Heading -->
			<div class="row">				
				<!-- Text Column -->
				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="section-heading text-left">
						<h2 class="heading text-indigo">
							What's included?
						</h2>
						<p class="paragraph">
							These are just some of the benefits you get with an Infino card. We're working our 🍑 off to provide you with more!
						</p>
					</div>
				</div>
				<!-- Image Column -->
				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="benefit-cards">
						<div class="container-fluid" onload="changePos()">
							<ul class="ultra">
								<li class="tab-2" style="transform: translateY(78px) scale(0.9);">
									<div>
										<div class="icon mb-3">🤑</div><br>
										Manage all your finances, track balances, cashbacks and offers on one Application.
									</div>
								</li>
								<li class="tab-3" style="transform: translateY(86px) scale(0.8);">
									<div>
										<div class="icon mb-3">🤓</div><br>
										Track your spending, identify patterns and set-up budgets. Take control of your finances!
									</div>
								</li>
								<li class="tab-4" style="transform: translateY(148px) scale(0.7);"> 
									<div>
										<div class="icon">🖖</div><br>
										Split your bill between different cards, wallets and bank accounts instantly.
									</div>
								</li>
								<li class="tab-0" style="transform: translateY(-64px) scale(1.08);">
									<div>
										<div class="icon">😎</div><br>
										Paid using the wrong card? Go back in time and swap your past payment methods with Infino!
									</div>
								</li>
								<li class="tab-1" style="transform: scale(1);">
									<div>
										<div class="icon">💪</div><br>
										Securely pay online with Infino’s disposable virtual cards.
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .section -->


	<div class="section checklist bg-white">
		<div class="container">
			<div class="section-heading center mb-2">
				<h2 class="heading text-success">
					A Card that doesn't suck 🔥 
				</h2>
<!--
				<p class="paragraph">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
					et dolore magna aliqua. Ut enim ad minim veniam, quis
				</p>
-->
			</div><!-- .section-heading -->
			<div class="row">
				<div class="col-md-8 col-sm-12 centered">
					<ul>
						<li>
							<p>
								<span class="head">All your finances in one card</span><br>
								<span>Works with most of your existing finances.</span>
							</p>
						</li>
						<li>
							<p>
								<span class="head">Personalization done right</span><br>
								<span>Card that understands your lifestyle and spending habits.</span>
							</p>
						</li>
						<li>
							<p>
								<span class="head">Manage your card on-the-go</span><br>
								<span>One click block, Pin change &amp; Limit change.</span>
							</p>
						</li>
						<li>
							<p>
								<span class="head">Budgeting</span><br>
								<span>Track Spending Patterns on-the-go.</span>
							</p>
						</li>
						<li>
							<p>
								<span class="head">Split Payments</span><br>
								<span>Split bills between different bank accounts, wallets &amp; cards.</span>
							</p>
						</li>
						<li>
							<p>
								<span class="head">Time Travel</span><br>
								<span>Go Back in time to change the payment method.</span>
							</p>
						</li>
						
						
						
						
						<li class="special">
							<p>
								<span class="head"><b>Absolutely FREE!</b></span><br>
								<span>You heard it right. Infino card is free!</span>
							</p>
						</li>
					</ul>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-12">
					<div class="centered fit-width">
									<a href="mailto:support@getinfino.com" class="btn btn-lg ui-gradient-green no-marg">Get In Touch<span class="fa fa-rocket ml-1"></span>
									</a>
						</div>
				</div>
			</div>
		</div>
	</div>
	<footer>
		<div class="footer-copyright bg-light">
   				<div class="container">
					<div class="row">
						<!-- Copyright -->
						<div class="col-12">
							<p>
								Made With ❤️ In India<br>
								© 2019 Chained Ventures Pvt Ltd. All rights reserved. Patents pending.
							</p>
						</div>
					</div>
   				</div><!-- .container -->
   			</div><!-- .footer-copyright -->
		</footer><!-- .ui-footer -->
	
</div><!-- .main -->
<!--
<div id="awesomeModal">

	<div id="btn-close-modal" class="close-awesomeModal"> 
			CLOSE MODAL
	</div>
	<div id="modal-container" class="modal-content">
		<h2>Working</h2>

	</div>
</div>
-->

<!-- Scripts -->
<script src="asset/js/libs/jquery/jquery-3.2.1.min.js"></script>
<!--
# Google Maps
# Add Your Google Maps API Key Below !!
-->
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5B2iXEELo6aIReGYLJdVKBlzHnrM0YLU"></script>-->
<!--<script src="asset/js/applify/ui-map.js"></script>-->
<script src="asset/js/libs/form-validator/form-validator.min.js"></script>
<script src="asset/js/libs/bootstrap.js"></script>
<script src="asset/js/applify/build/applify.js"></script>
<!--<script src="asset/js/libs/animatedModal.min.js"></script>-->
<script src="asset/js/benefits.js"></script>
<script>
  window.fcWidget.init({
    token: "5020288b-73b8-4cc4-9a46-c13bd2f6cb28",
    host: "https://wchat.freshchat.com"
  });
</script><div id="fc_frame" class="fc-widget-normal"><iframe id="fc_widget" name="fc_widget" title="Chat" frameborder="0"></iframe></div>

     <script type="text/javascript">
      // Enter an API key from the Google API Console:
      //   https://console.developers.google.com/apis/credentials
      var apiKey = 'AIzaSyA1jwUwTb0d2kQhitO8O2pTI35gk75KCww';
      // Enter the API Discovery Docs that describes the APIs you want to
      // access. In this example, we are accessing the People API, so we load
      // Discovery Doc found here: https://developers.google.com/people/api/rest/
      var discoveryDocs = ["https://people.googleapis.com/$discovery/rest?version=v1"];
      // Enter a client ID for a web application from the Google API Console:
      //   https://console.developers.google.com/apis/credentials?project=_
      // In your API Console project, add a JavaScript origin that corresponds
      //   to the domain where you will be running the script.
      var clientId = '382582544864-bm3cuud02r2g5rgv0sjeqaoj8mf6kth4.apps.googleusercontent.com';
      // Enter one or more authorization scopes. Refer to the documentation for
      // the API or https://developers.google.com/people/v1/how-tos/authorizing
      // for details.
      var scopes = 'email';
      var authorizeButton = document.getElementById('authorize-button');
      var signoutButton = document.getElementById('signout-button');
      function handleClientLoad() {
        // Load the API client and auth2 library
        gapi.load('client:auth2', initClient);
      }
      function initClient() {
        gapi.client.init({
            apiKey: apiKey,
            discoveryDocs: discoveryDocs,
            clientId: clientId,
            scope: scopes
        }).then(function () {
          // Listen for sign-in state changes.
          gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);
          // Handle the initial sign-in state.
          updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
          authorizeButton.onclick = handleAuthClick;
          signoutButton.onclick = handleSignoutClick;
        });
      }
      function updateSigninStatus(isSignedIn) {
        if (isSignedIn) {
        //  authorizeButton.style.display = 'none';
       //   signoutButton.style.display = 'block';
          makeApiCall();
        } else {
          authorizeButton.style.display = 'block';
          signoutButton.style.display = 'none';
        }
      }
      function handleAuthClick(event) {
        gapi.auth2.getAuthInstance().signIn();
      }
      function handleSignoutClick(event) {
        gapi.auth2.getAuthInstance().signOut();
      }
      
      // Load the API and make an API call.  Display the results on the screen.
      function makeApiCall() {
          
          gapi.client.load('oauth2', 'v2', function() {
  gapi.client.oauth2.userinfo.get().execute(function(resp) {
    // Shows user email
    console.log(resp.email);
    
    console.log(resp.name);
    
    setCookie("gemail",resp.email,1);
    
    setCookie("gname",resp.name,1);
    
    
    window.location.href = "glogin.php?invite=";
  
  
  })
});
  function setCookie(c_name,value,exdays)
{
   var exdate=new Date();
   exdate.setDate(exdate.getDate() + exdays);
   var c_value=escape(value) + ((exdays==null) ? "" : ("; expires="+exdate.toUTCString()));
   document.cookie=c_name + "=" + c_value;
}
      }
    </script>
    <script async="" defer="" src="https://apis.google.com/js/api.js" onload="this.onload=function(){};handleClientLoad()" onreadystatechange="if (this.readyState === 'complete') this.onload()" gapi_processed="true">
    </script>
    
    
    
        <script type="text/javascript">
      // Enter an API key from the Google API Console:
      //   https://console.developers.google.com/apis/credentials
      var apiKey = 'AIzaSyA7TBxi-MJDrGWaBJmGuU0CUZcfr9JPudU';
      // Enter the API Discovery Docs that describes the APIs you want to
      // access. In this example, we are accessing the People API, so we load
      // Discovery Doc found here: https://developers.google.com/people/api/rest/
      var discoveryDocs = ["https://people.googleapis.com/$discovery/rest?version=v1"];
      // Enter a client ID for a web application from the Google API Console:
      //   https://console.developers.google.com/apis/credentials?project=_
      // In your API Console project, add a JavaScript origin that corresponds
      //   to the domain where you will be running the script.
      var clientId = '862458779212-b14u5shfq29gmt4nuikccjiqab3km69g.apps.googleusercontent.com';
      // Enter one or more authorization scopes. Refer to the documentation for
      // the API or https://developers.google.com/people/v1/how-tos/authorizing
      // for details.
      var scopes = 'email';
      var authorizeButton = document.getElementById('authorize-button');
      var signoutButton = document.getElementById('signout-button');
      function handleClientLoad() {
        // Load the API client and auth2 library
        gapi.load('client:auth2', initClient);
      }
      function initClient() {
        gapi.client.init({
            apiKey: apiKey,
            discoveryDocs: discoveryDocs,
            clientId: clientId,
            scope: scopes
        }).then(function () {
          // Listen for sign-in state changes.
          gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);
          // Handle the initial sign-in state.
          updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
          authorizeButton.onclick = handleAuthClick;
          signoutButton.onclick = handleSignoutClick;
        });
      }
      function updateSigninStatus(isSignedIn) {
        if (isSignedIn) {
        //  authorizeButton.style.display = 'none';
       //   signoutButton.style.display = 'block';
          makeApiCall();
        } else {
          authorizeButton.style.display = 'block';
          signoutButton.style.display = 'none';
        }
      }
      function handleAuthClick(event) {
        gapi.auth2.getAuthInstance().signIn();
      }
      function handleSignoutClick(event) {
        gapi.auth2.getAuthInstance().signOut();
      }
      
      // Load the API and make an API call.  Display the results on the screen.
      function makeApiCall() {
          
          gapi.client.load('oauth2', 'v2', function() {
  gapi.client.oauth2.userinfo.get().execute(function(resp) {
    // Shows user email
    console.log(resp.email);
    
    console.log(resp.name);
    
    setCookie("gemail",resp.email,1);
    
    setCookie("gname",resp.name,1);
    
    
    window.location.href = "glogin.php?invite=<?php echo $ref; ?>";
  
  
  })
});
  function setCookie(c_name,value,exdays)
{
   var exdate=new Date();
   exdate.setDate(exdate.getDate() + exdays);
   var c_value=escape(value) + ((exdays==null) ? "" : ("; expires="+exdate.toUTCString()));
   document.cookie=c_name + "=" + c_value;
}
      }
    </script>
    <script async defer src="https://apis.google.com/js/api.js" 
      onload="this.onload=function(){};handleClientLoad()" 
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>

<iframe id="apiproxybf54ff4f44c13f336ea3593d1df1b90279bb9bf00.2097649267" name="apiproxybf54ff4f44c13f336ea3593d1df1b90279bb9bf00.2097649267" src="https://content-people.googleapis.com/static/proxy.html?usegapi=1&amp;jsh=m%3B%2F_%2Fscs%2Fapps-static%2F_%2Fjs%2Fk%3Doz.gapi.en.COaYzTRXlXk.O%2Fam%3DQQ%2Frt%3Dj%2Fd%3D1%2Frs%3DAGLTcCMWUg7n4WrJDPw_obRv3Lg7jd5-FA%2Fm%3D__features__#parent=https%3A%2F%2Fwebupdate.website&amp;rpctoken=244850695" tabindex="-1" aria-hidden="true" style="width: 1px; height: 1px; position: absolute; top: -100px; display: none;"></iframe><iframe id="ssIFrame_google" sandbox="allow-scripts allow-same-origin" aria-hidden="true" frame-border="0" src="https://accounts.google.com/o/oauth2/iframe#origin=https%3A%2F%2Fwebupdate.website&amp;rpcToken=684919170.1020774" style="position: absolute; width: 1px; height: 1px; left: -9999px; top: -9999px; right: -9999px; bottom: -9999px; display: none;"></iframe><div id="fc_push_frame"><iframe id="fc_push" src="https://infino.webpush.freshchat.com/index.html?ref=aHR0cHM6Ly93ZWJ1cGRhdGUud2Vic2l0ZQ==" frameborder="0"></iframe></div></body></html>