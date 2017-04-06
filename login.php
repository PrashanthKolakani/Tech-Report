<!DOCTYPE html>
<?php   include("db.php");
?>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login page</title>
  
  
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>

      <link rel="stylesheet" href="loginstyle.css">
 <script>
function validateForm1()
{
var z=document.forms["myForm1"]["user"].value;
if (z==null || z=="")
  {
  alert("email must be filled out");
  return false;
  }

 <!---->
  var w=document.forms["myForm1"]["pass"].value;
if (w==null || w=="")
  {
  alert("password must be filled out");
  return false;
  }

  <!---->
  var e = document.forms["myForm1"]["sel"].value;
if(e==-1)
{
alert("Please select a user");
return false;
}
}
</script>

<script>
function validateForm2()
{

	var p=document.forms["myForm2"]["nuser"].value;
if (p==null || p=="")
  {
  alert("Name must be filled out");
  return false;
  }
	var y=document.forms["myForm2"]["email"].value;
var atpos=y.indexOf("@");
var dotpos=y.lastIndexOf("@nitc.ac.in");
if (y==null || y=="")
  {
  alert("please enter mail-id");
  return false;
  }
if (atpos<1 || dotpos+11!=y.length)
  {
  alert("Invalid:specify nitc mail address");
  return false;
  }
 
  cno= /^\d{10}$/;
  if(!(document.forms["myForm2"]["phno"].value.match(cno)))
 {
     alert("Not a valid Phone Number");
     return false;
  }
  
  var e = document.forms["myForm2"]["degre"].value;
if(e==-1)
{
alert("Please select a user");
return false;
}

var z=document.forms["myForm2"]["birthday"].value;
if (z==null || z=="")
  {
  alert("Date of birth must be filled out");
  return false;
  }

var split = z.split('-');
var yr = split[0];
var d = new Date();
var n = d.getFullYear();
if(yr > (n-17) || yr < 1960)
{
    alert("Error: Enter valid date of birth");
    return false;
}

var z=document.forms["myForm2"]["user"].value;
if (z==null || z=="")
  {
  alert("email must be filled out");
  return false;
  }


  var w=document.forms["myForm2"]["pass"].value;
if (w==null || w=="")
  {
  alert("password must be filled out");
  return false;
  }

  var cp=document.forms["myForm2"]["cpass"].value;
if (cp==null || cp=="")
  {
  alert("Re-enter your password");
  return false;
  }
 if (cp!=w)
 	{
  alert("password doesn't match");
  return false;
  }

  var sn=document.forms["myForm2"]["sup"].value;
if (sn==null || sn=="")
  {
  alert("Supervisor field can't be empty");
  return false;
  }
	var semail=document.forms["myForm2"]["supemail"].value;
	if (semail==null || semail=="")
  {
  alert("please enter supervisor mail-id");
  return false;
  }
var atpos=semail.indexOf("@");
var dotpos=semail.lastIndexOf("@nitc.ac.in");
if (atpos<1 || dotpos+11!=semail.length)
  {
  alert("Invalid:specify nitc mail address");
  return false;
  }
 



}
</script>
  
</head>

<body>
  <div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
		<div class="login-form">
			<div class="sign-in-htm">
        <?php
        if(isset($_POST['submit_login'])){
        $ur = $_POST['user'];
        $pwd = $_POST['pass'];
        $selectval = $_POST['sel'];}
        else{
        $ur = '';
        $pwd = '';
        $selectval = -1;
        }
        ?>
			<form action="" name="myForm1"onsubmit="return validateForm1();" method="POST">
				<div class="group">
					<label for="user" class="label">Email</label>
					<input id="user" name="user" type="text" value="<?PHP echo $ur?>" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" name="pass" type="password" value="<?PHP echo $pwd?>" class="input" data-type="password">
				</div>
				<div class="select">
					<select name="sel" value="<?PHP echo $selectval?>">
						<option value="-1">Select</option>
						<option value="0">Author</option>
						<option value="1">Editor</option>
						<option value="2">Reviewer</option>
            <option value="5">Administrator</option>
					 </select>
				</div>
        <br/>
				<!--<div class="group">
					<input id="check" type="checkbox" class="check" checked>
					<label for="check"><span class="icon"></span> Keep me Signed in</label>
				</div> -->
				<div class="group">
					<input type="submit" name="submit_login" value="Sign In">
				</div>
				<div class="hr"></div>
				 <div class="foot-lnk">
					<a href="forgotpswd.php">Forgot Password?</a>
				</div>
			</form>
			</div>
			<div class="sign-up-htm">
			
			<form action="" name="myForm2"onsubmit="return validateForm2();" method="POST">
				<div class="group">
					<label for="user" class="label">Name</label>
					<input id="nuser" name="name" type="text" class="input">
				</div>

				<div class="group">
					<label for="pass" class="label">Mobile Number</label>
					<input id="phno" type="text" class="input">
				</div>

				<div class="select">
					<label for="pass" class="label">Programme</label>
					<select name="degre">
						<option value="-1">Select</option>
						<option value="btech">B.Tech</option>
						<option value="mtech">M.tech</option>
						<option value="mca">MCA</option>
						<option value="phd">Ph.D</option>
					 </select>
				</div>

      <div class="group">
          <label for="dob" class="label">Date of birth</label>
          <input id="dob" name="birthday" type="date" class="input">
        </div>
				<div class="group">
					<label for="user" class="label">Email</label>
					<input id="user" name="username" type="text" class="input">
				</div>

				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" name="pass" type="password" class="input" data-type="password">
				</div>

				<div class="group">
					<label for="pass" class="label">Confirm Password</label>
					<input id="cpass" type="password" class="input" data-type="password">
				</div>

				<div class="group">
					<label for="pass" class="label">Name of Supervisor</label>
					<input id="sup" name="supname" type="text" class="input">
				</div>

				<div class="group">
					<label for="pass" class="label">Supervisor's EmailId</label>
					<input id="supemail" name="supemail" type="text" class="input">
				</div>

				<div class="group">
					<input type="submit" name="submit_signup" value="Sign Up">
				</div>

				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Already Member?</a>
				</div>
			 </form>
			</div>
		</div>
	</div>
</div>

  <?php
  include("db.php");
   if(isset($_POST['submit_signup']))
   {
   	$name = $_POST['name'];
    $username = $_POST['username'];
    echo $username;
    $password = $_POST['pass'];
   $bday= $_POST['birthday'];
  $supemail= $_POST['supemail'];
  $supname=$_POST['supname'];

  if($username && $password)
  {
  $code = rand();
   $res = mysqli_query($con,"insert into login values('$username','$password','0','0','$code','$bday')");
   if(!mysqli_affected_rows($con)){
          echo "insertion into login table failed!";
   }
   else{
   $message = 
   "
    This is mail to verify the account.
    click the link to Confirm
    http://localhost/bootstrap/emailconfirm.php?username=$username&code=$code
   ";
   
   require 'PHPmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'techreport.2017@gmail.com';                 // SMTP username
$mail->Password = 'nitc1234admin';                           // SMTP password

$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to
                                  // TCP port to connect to

$mail->setFrom($email, $name);
$mail->addAddress($supemail, $supname);     // Add a recipient
$mail->addAddress($supemail);               // Name is optional
$mail->addReplyTo('techreport.2017@gmail.com', 'admin');
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'E-mail Account Verification';
$mail->Body    = $message;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo "<script>confirm('Email sent for verification')</script>";
     echo "<script>confirm('You may login when supervisor confirms')</script>";
    echo "<script>window.location.href='home.php';</script>";
}

  } 
}
   }
  ?>

  <?php
  if(isset($_POST['submit_login']))
 {
  $user = $_POST['user'];
  $pass = $_POST['pass'];
  $pri = $_POST['sel'];
  
  if($pri == 0)
  {
   $usercheck = mysqli_query($con,"select * from login where username='$user' and password='$pass' and privilege='$pri'");
   if(mysqli_num_rows($usercheck)==0)
     echo "<script>confirm('Invalid username or password')</script>";
   else  {
   $newres = mysqli_query($con,"select * from login where username='$user' and password='$pass' 
   	   and confirmation='1' and privilege = 0");

   if(mysqli_num_rows($newres)==0)
   	  echo "<script>confirm('Your request for account is in verification')</script>";
   else{
   	  $res=mysqli_fetch_array($newres);
      $name=$res['username'];
   	  echo "<script>window.location.href='authorpage.php?username=$name'</script>";
   }
    }
  }
 else if($pri == 1)
    {   
    	$usercheck = mysqli_query($con,"select * from login where username='$user' and password='$pass' and privilege=1");
    	if(mysqli_num_rows($usercheck)==0)
    		 echo "<script>confirm('Invalid username or password')</script>";
        else{
   	  $res=mysqli_fetch_array($usercheck);
      $name=$res['username'];
   	  echo "<script>window.location.href='editorpage.php?username=$name'</script>";
   }
    }
      
else if($pri == 2){
	$usercheck = mysqli_query($con,"select * from login where username='$user' and password='$pass' and privilege=2");
      if(mysqli_num_rows($usercheck)==0)
         echo "<script>confirm('Invalid username or password')</script>";
        else{
   	  $res=mysqli_fetch_array($usercheck);
      $name=$res['username'];
   	  echo "<script>window.location.href='reviewerpage.php?username=$name'</script>";
   }
 }

 else if($pri == 5)
 {
    $usercheck = mysqli_query($con,"select * from login where username='$user' and password='$pass' and privilege=5");
     if(mysqli_num_rows($usercheck)==0)
         echo "<script>confirm('Invalid username')</script>";
        else{
   	  $res=mysqli_fetch_array($usercheck);
      $name=$res['username'];
   	  echo "<script>window.location.href='admin.php?username=$name'</script>";
   }
 }
}
  ?>
  
</body>
</html>
