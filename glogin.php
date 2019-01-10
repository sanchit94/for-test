  <?php
  session_start();
  include('config.php');
  
    $email = $_COOKIE['gemail'];
     $code = $_REQUEST['invite'];
     $name = $_COOKIE['gname'];
    
      $t= mysqli_query($con,"select * from users where email='$email'");
    if(mysqli_num_rows($t)==0)
    {
        $ref = $_REQUEST['invite'];
        $gb= mysqli_query($con,"select * from users where id='$ref'");
        $ftf = mysqli_fetch_array($gb);
        $em = $ftf['email'];
        $id = rand(10000000,99999999);
        mysqli_query($con,"insert into users (email,id,name) values ('$email','$id','$name') ");
        mysqli_query($con,"INSERT INTO `refer`(`inviter`, `refer`) VALUES ('$em','$email')");
    }
   
       $_SESSION['user'] = $email;
        header("location:page.php");
    
    
    ?>