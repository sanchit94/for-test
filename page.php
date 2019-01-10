<?php
session_start();
include('config.php');

$email = $_SESSION['user'];

require_once __DIR__ . '/sendgrid/autoload.php'; 

if(!isset($_SESSION['user']))
{
    header("location:index.php");
}


$f = mysqli_query($con,"select * from users where email='$email'");
$gy = mysqli_fetch_array($f);

$ref = mysqli_query($con,"select * from refer where inviter='$email'");

if(mysqli_num_rows($ref)==2)
{
    $fg = mysqli_query($con,"select * from reward where email='$email'");
    if(mysqli_num_rows($fg)==0)
    {
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
    
        $sendgrid = new \SendGrid('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');
        try {
            $response = $sendgrid->send($emailer);
        //    print $response->statusCode() . "\n";
        //    print_r($response->headers());
        //    print $response->body() . "\n";
        } catch (Exception $e) {
        //    echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }
}

$t = mysqli_query($con,"select * from users order by sn ASC");

$in = 1;
while($ca = mysqli_fetch_array($t))
{
    if($ca['email']==$email)
    {
        $my = $in;
    }
    $in++;
}
?>

<!DOCTYPE html>
<html lang="en">



<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title -->
    <title>Page1</title>
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
                            <h3><b>Thank You <span><?php echo $gy['name']; ?> !</b></span></h3>
                            
							 <h5>Thanks For Join The Waitlist.</h5>
							
							
                            <form id="mc-form" class="subscrie-form">
							<div class="row">
							<div class="col-sm-5"> 
							 <div class="input-group">
							     <lable>People Ahead of you</lable>
                                    <input type="email" class="form-control" id="mc-email" value="<?php echo $my-1; ?>" readonly>
                                    
                            </div>
							</div>
							<div class="col-sm-2">
                               
                               
								
						    </div>
							<div class="col-sm-5">
							    <lable>Your number in queue</lable>
							  <div class="input-group">
                                    <input type="email" class="form-control" id="mc-email" value="<?php echo $my; ?>" readonly>
                                    
                                </div>   
							    
							</div>
                            </div>
                           </form>
                           
                             <form id="mc-form" class="subscrie-form">
							<div class="row">
							<div class="col-sm-12"> 
							 <div class="input-group">
							     <lable>Your total referrals </lable>
                                    <input type="email" class="form-control" id="mc-email" value="<?php echo mysqli_num_rows($ref); ?>" readonly>
                                    
                            </div>
							</div>
						
						
                            </div>
                           </form>
						   
						   <div class="col-sm-12" style="margin-top:10px;">
						    <h4><b>You're just <?php if(mysqli_num_rows($ref)==0) { echo '2'; }else if(mysqli_num_rows($ref)==1) { echo '1'; } else { echo '0'; }  ?> referrals away from a free card !</b></h4>
							
							 <h5>Thanks For Join The Waitlist.</h5>
						   </div>
						   
						   <div class="container" style="margin-top:20px;">
						       <div class="row">
						           <div class="col-sm-2"></div>
						   <div class="col-sm-8">
						   <div class="progress">
						       <?php if(mysqli_num_rows($ref)==0) { ?>
  <div class="progress-bar progress-bar-danger" role="progressbar" style="width:100%">
    2 referral pending to get gift card
  </div>
  <?php } else if(mysqli_num_rows($ref)==1) { ?>
   <div class="progress-bar progress-bar-warning" role="progressbar" style="width:50%">
    1 referral pending to get gift card
  </div>
  <?php } else { ?>
  <div class="progress-bar progress-bar-success" role="progressbar" style="width:100%">
    Congrats you earned gift card, Please check your email
  </div>
  <?php } ?>
  
</div>
						   </div>
						   <div class="col-sm-2"></div>
						   </div>
						   </div>
						   
						   
						    <div class="col-md-12 text-center" style="margin-top:10px;">
                    <div class="social">
                        <div class="socials-icons">
                            <a href="#" onClick="MyWindow=window.open('http://www.facebook.com/sharer.php?u=http://getinfino.com/index.php?invite=<?php echo $gy['id']; ?>','MyWindow',width=600,height=300); return false;" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" onClick="MyWindow=window.open('https://twitter.com/share?url=http://getinfino.com/index.php?invite=<?php echo $gy['id']; ?>','MyWindow',width=600,height=300); return false;" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" onClick="MyWindow=window.open('https://plus.google.com/share?url=http://getinfino.com/index.php?invite=<?php echo $gy['id']; ?>','MyWindow',width=600,height=300); return false;" target="_blank"><i class="fa fa-google"></i></a>
                            <a href="#"  onClick="MyWindow=window.open('whatsapp://send?text=http://getinfino.com/index.php?invite=<?php echo $gy['id']; ?>','MyWindow',width=600,height=300); return false;" target="_blank"><i class="fa fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
				
				<div class="col-sm-12" style="margin-top:20px;">
				or you can share the unique link
				</div>
				
				<div class="col-sm-12">
				
				 <form id="mc-form" class="subscrie-form">
                                <label class="mt10" for="mc-email"></label>
                                <div class="input-group">
                                    <input type="email" class="form-control"  value="http://getinfino.com/index.php?invite=<?php echo $gy['id']; ?> " id="myInput" readonly>
                                    <div class="input-group-btn">
                                        <button class="btn btn-info" type="button" onclick="myFunction()">copy</button>
                                    </div>
                                </div>
                            </form>
				</div>
				
				<div class="col-sm-12" style="margin-top:20px;">
				    <a onclick="logout()"><button type="button" class="btn btn-success">Logout</button></a>
				</div>    
						
						
                        </div>

                    </div>
					
					
					
                </div>
				
				
				
            </div>
        </div>
    </div>
    <!--Slider area End -->
   
    <script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>
   
  
    
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
    //  var authorizeButton = document.getElementById('authorize-button');
     // var signoutButton = document.getElementById('signout-button');
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
       //   authorizeButton.onclick = handleAuthClick;
        //  signoutButton.onclick = handleSignoutClick;
        });
      }
      function updateSigninStatus(isSignedIn) {
        if (isSignedIn) {
        //  authorizeButton.style.display = 'none';
       //   signoutButton.style.display = 'block';
     //     makeApiCall();
        } else {
        //  authorizeButton.style.display = 'block';
      //    signoutButton.style.display = 'none';
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
      
      function logout()
      {
          gapi.auth2.getAuthInstance().signOut();
          window.location.href = "logout.php";
      }
    </script>
    
    
    
    <script async defer src="https://apis.google.com/js/api.js" 
      onload="this.onload=function(){};handleClientLoad()" 
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>
</body>



</html>