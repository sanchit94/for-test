<?php
include('config.php');

$otp = $_REQUEST['token'];
//echo "select * from verify where otp='$otp'";
$d = mysqli_query($con,"select * from verify where otp='$otp'");
if(mysqli_num_rows($d)>0)
{
$dd = mysqli_fetch_array($d);
$email = $dd['email'];

mysqli_query($con,"update users set verify='1' where email='$email'");

$rf = explode("P",$otp);

$sn = $rf[1];

 $gb= mysqli_query($con,"select * from users where sn='$sn'");
        $ftf = mysqli_fetch_array($gb);
        $em = $ftf['email'];

mysqli_query($con,"INSERT INTO `refer`(`inviter`, `refer`) VALUES ('$em','$email')");

header('location:index.php');
}
else
{
    echo '<h3>Invalid token please recheck mail link again</h3>';
}

?>