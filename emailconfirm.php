<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
include("db.php");
 $username = $_GET['username'];
 echo $username;
 $code  = $_GET['code'];
 echo $code;
$result = mysqli_query($con,"select * from login where username='$username' and privilege='0' and confcode='$code'");
 echo mysqli_num_rows($result);
while($row = mysqli_fetch_array($result))
{
  $dbcode = $row['confcode'];
}
if($dbcode == $code)
{
 $res = mysqli_query($con,"update login set confirmation='1' where username='$username' and 
 	privilege='0' and confcode='$code'");
 echo "<script>confirm('Thanks for Verifying');</script>";
}
else
{
 echo "Username and code dont match";	
}
?>
</body>
</html>
