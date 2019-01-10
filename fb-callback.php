<?php
if (!session_id()) {
    session_start();
}

$ref = $_REQUEST['code'];

include('config.php');

require_once __DIR__ . '/facebook/autoload.php'; 

$fb = new \Facebook\Facebook([
  'app_id' => '2215689488649766',
  'app_secret' => 'b3e40f570e7f3b148a58412b6f1906e5',
  'default_graph_version' => 'v2.2',
  //'default_access_token' => '{access-token}', // optional
]);


$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());


  try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,name,email', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

 $email = $user['email'];
 $name = $user['name'];

    $t= mysqli_query($con,"select * from users where email='$email'");
    if(mysqli_num_rows($t)==0)
    {
        $ref = $_COOKIE['ref'];
        $gb= mysqli_query($con,"select * from users where id='$ref'");
        $ftf = mysqli_fetch_array($gb);
        $em = $ftf['email'];
        $id = rand(10000000,99999999);
        mysqli_query($con,"insert into users (email,id,name) values ('$email','$id','$name') ");
        mysqli_query($con,"INSERT INTO `refer`(`inviter`, `refer`) VALUES ('$em','$email')");
    }
   
       $_SESSION['user'] = $email;
        header("location:page.php");

echo 'Name: ' . $user['name'];

echo 'Email: ' . $user['email'];
// OR
// echo 'Name: ' . $user->getName();

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
//echo '<h3>Metadata</h3>';
//var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId('{app-id}'); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
    exit;
  }

//  echo '<h3>Long-lived</h3>';
  



//  var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;

// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');




?>