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
  'app_id' => '2215689488649766',
  'app_secret' => 'b3e40f570e7f3b148a58412b6f1906e5',
  'default_graph_version' => 'v2.2',
  //'default_access_token' => '{access-token}', // optional
]);
  
  $helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://getinfino.com/fb-callback.php', $permissions);

include('config.php');

require_once __DIR__ . '/twitter/autoload.php'; 

use Abraham\TwitterOAuth\TwitterOAuth;
define('CONSUMER_KEY', 'EhLNvq8US8WbDOsVqNstsbr20'); 	// add your app consumer key between single quotes
define('CONSUMER_SECRET', 'XvYmv3pquCQEAvjMkT8jWjUrzMsqrqOixyLymiFpY8gCgl2ygI'); // add your app consumer 																			secret key between single quotes
define('OAUTH_CALLBACK', 'http://getinfino.com/twitter/callback.php'); // your app callback URL i.e. page 

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
        $emailer->addContent("text/plain", "Please click on link to verify email");
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

<!DOCTYPE html>
<html lang="en">



<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title -->
    <title>Index</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="images/fevicon.html">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Font awesome CSS -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!-- Magnific popup CSS -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <!-- Mobile Menu CSS -->
    <link rel="stylesheet" href="assets/css/meanmenu.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="assets/css/responsive.css">

    <!-- jQuery -->
    <script src="assets/js/jquery-1.11.3.min.js"></script>
    
</head>

<body>
    <!-- prelaoder start -->
    <div id="preloader-wrapper">
        <div class="preloader-wave-effect"></div>
    </div>
    <!-- prelaoder end -->
  
    <!--hero area start-->
    <div id="home" class="home-style-2 slider-area ">
        <div class="slider">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="slider-content">
                            <h2>Website Name <span>Are You Ready</span></h2>
                           
							
                            <form method="POST" class="subscrie-form">
							<div class="col-sm-12">
                               
                                <div class="input-group" style="width: 100%;">
                                    <input type="text" class="form-control" name="name" id="mc-email" placeholder="Please Enter Your Name...">
                                    
                                </div>
								
						    </div>

                            <div class="col-sm-12">
                               
                                <div class="input-group" style="width: 100%;margin-top: 20px;">
                                    <input type="email" class="form-control" name="email" id="mc-email" placeholder="Please Email...">
                                    
                                </div>
								
						    </div>	
							
							<div class="col-sm-12" style="margin-top: 20px;">
               <button type="submit" name="signup" class="btn btn-success" >Signup</button>	
                               </div>
              
                           <div class="col-sm-12" style="margin-top:10px;">
						   OR 
						   </div>
			  
			  <div class="col-md-12 text-center" style="margin-top:10px;">
                    <div class="social">
                        <div class="socials-icons">
                            <a href="   <?php  echo  htmlspecialchars($loginUrl); ?>"><i class="fa fa-facebook"></i></a>
                            <a href="<?php echo $url; ?>"><i class="fa fa-twitter"></i></a>
                            <a id="authorize-button" ><i class="fa fa-google"></i></a>
                              <a id="signout-button" style="display:none"><i class="fa fa-google"></i></a>
                           
                        </div>
                    </div>
                </div>
			  
                            </form>
						
						
						
                        </div>

                    </div>
					
					
					
                </div>
				
				
				
            </div>
        </div>
    </div>
    <!--Slider area End -->
   
    
   
  
    
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Mobile Menu JS -->
    <script src="assets/js/jquery.meanmenu.js"></script>
    <!-- Magnific popup -->
    <script src="assets/js/magnific-popup.min.js"></script>
    <!-- Magnific popup -->
    <script src="assets/js/jquery.scrollUp.js"></script>
    <!-- WOW JS -->
    <script src="assets/js/wow-1.3.0.min.js"></script>
    <!-- Easing JS -->
    <script src="assets/js/easing-min.js"></script>
    <!-- Waypoints JS -->
    <script src="assets/js/waypoints.js"></script>
    <!-- countdown JS -->
    <script src="assets/js/countdown.js"></script>
    <!-- ajaxchimp JS -->
    <script src="assets/js/ajaxchimp.js"></script>
     <!-- ajax-mail JS -->
    <script src="assets/js/ajax-mail.js"></script>
    <!-- Active JS -->
    <script src="assets/js/active.js"></script>
    
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
    
</body>



</html>