<?php
if (!session_id()) {
    session_start();
}

require_once __DIR__ . '/facebook/autoload.php'; 

$fb = new \Facebook\Facebook([
  'app_id' => '2215689488649766',
  'app_secret' => 'b3e40f570e7f3b148a58412b6f1906e5',
  'default_graph_version' => 'v2.2',
  //'default_access_token' => '{access-token}', // optional
]);
  
  $helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://getinfino.com/fb-callback.php', $permissions);


?>

<HTML>
    
    <body>
      <?php  echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>'; ?>
      <button onclick='ab()'>Google signin</button>
      </body>
      
      <script src="https://www.gstatic.com/firebasejs/5.7.2/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBdVNY-ODNBpMSagkjqu5MOtJfJRkL8Zt8",
    authDomain: "downloadapp-5df56.firebaseapp.com",
    databaseURL: "https://downloadapp-5df56.firebaseio.com",
    projectId: "downloadapp-5df56",
    storageBucket: "downloadapp-5df56.appspot.com",
    messagingSenderId: "1062387898380"
  };
  firebase.initializeApp(config);
  
  var provider = new firebase.auth.GoogleAuthProvider();
  
  provider.addScope('https://www.googleapis.com/auth/contacts.readonly');
  
  function ab()
  {
      firebase.auth().signInWithPopup(provider).then(function(result) {
  // This gives you a Google Access Token. You can use it to access the Google API.
  var token = result.credential.accessToken;
  // The signed-in user info.
  var user = result.user;
  console.log(user);
  // ...
}).catch(function(error) {
  // Handle Errors here.
  var errorCode = error.code;
  var errorMessage = error.message;
  // The email of the user's account used.
  var email = error.email;
  // The firebase.auth.AuthCredential type that was used.
  var credential = error.credential;
  // ...
});
      
      
  }
</script>
    
</HTML>