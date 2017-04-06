<!DOCTYPE html>
 
 <?php include("db.php"); 
   require 'PHPmailer/PHPMailerAutoload.php';
 ?>


<html lang="en">
<head>
  <title>CSED Technical Reports</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/forgot.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script>

function validateForm1()
{
var z=document.forms["myForm1"]["user"].value;
if (z==null || z=="")
  {
  alert("Username must be filled out");
  return false;
  }
   
var atpos=z.indexOf("@");
var dotpos=z.lastIndexOf("@nitc.ac.in");
if (atpos<1 || dotpos+11!=z.length)
  {
  alert("Invalid:specify nitc mail address");
  return false;
  }

var z=document.forms["myForm1"]["dob"].value;
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

var e = document.forms["myForm1"]["sel"].value;
if(e==-1)
 {
  alert("Please select a user");
  return false;
 }

}
  </script>
</head>

<body>
<div style="height:100%;">
  <div class="container my-custom-container"> 

    <div class="row" style="height:100px;background-color:purple;">
      <div class="head1 col-sm-2">
        <img src="images/1.jpg" class="pull-right" width="85" height="85" alt="logo" style="padding-top:9%;">
       </div>
      <div class="head2 col-sm-10">
       <h3>Department of Computer Science and Engineering</h3>
       <h4><i>National Institute of Technology Calicut </i></h4>
      </div>
    </div>
   
   <div class="homephp">
     <h3><font color='#8B008B'>Please Enter The Details</font></h3><br>
    <div class="form">
      <?php
        if(isset($_POST['submit'])){
        $ur = $_POST['user'];
        $dob = $_POST['dob'];
        $selectval = $_POST['sel'];}
        else{
        $ur = '';
        $date = '';
        $selectval = -1;
        }
      ?>

    <form action="" name="myForm1" onsubmit="return validateForm1();" method="post" enctype="multipart/form-data"> 
    <br/>     
  <b>Enter Email&nbsp;:&nbsp;</b><input type="email" name="user" value="<?PHP echo $ur?>"><br/><br/>
  <b>Enter Date of Birth&nbsp;:&nbsp;</b> <input type="date" name="dob" value="yyyy-mm-dd"><br/><br/>
  <select name="sel" value="<?PHP echo $selectval?>">
            <option value="-1">Select</option>
            <option value="0">Author</option>
            <option value="1">Editor</option>
            <option value="2">Reviewer</option>
            <option value="5">Administrator</option>
  </select><br/><br/>
 
 <button type="submit" name="submit" value="Submit">Submit</button>
  </form>
  </div>

  </div>

  </div>
    
  </div>

  <?php
  if(isset($_POST['submit']))
 {
  $user = $_POST['user'];
  $dob = $_POST['dob'];
  $pri = $_POST['sel'];

  if($pri == 0)
  {
   $usercheck = mysqli_query($con,"select * from login where username='$user' and privilege='$pri' and confirmation='1'");
   }

  else if($pri == 1)
       $usercheck = mysqli_query($con,"select * from login where username='$user' and privilege=1");
  elseif($pri == 2)
        $usercheck = mysqli_query($con,"select * from login where username='$user' and privilege=2");
  elseif($pri == 5)
        $usercheck = mysqli_query($con,"select * from login where username='$user' and privilege=5");

      if(mysqli_num_rows($usercheck)==0)
      echo "<script>confirm('please enter correct details')</script>";
       else
       {
      $res=mysqli_fetch_array($usercheck);
      $dateofbirth=$res['dob'];
      if($dateofbirth==$dob){
         $pass=$res['password'];
         $name=$res['username'];
         
         $mail = new PHPMailer;
         $mail->isSMTP();                                      // Set mailer to use SMTP
         $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
         $mail->SMTPAuth = true;                               // Enable SMTP authentication

         $mail->Username = 'techreport.2017@gmail.com';                 // SMTP username
         $mail->Password = 'nitc1234admin';                           // SMTP password

        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

      $mail->setFrom('techreport.2017@gmail.com', 'techreport');
      $mail->addAddress($user, $name);     // Add a recipient
      $mail->addAddress($user);               // Name is optional
      $mail->addReplyTo('techreport.2017@gmail.com', 'Information');

      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = "login password";
      $mail->Body    = $pass;
if(!$mail->send())
{
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}else
{ 
    echo "<script>confirm('Email has been sent');</script>";
    echo "<script>window.location.href='login.php';</script>";

}

    }
    else
        echo "<script>confirm('Wrong Date of birth')</script>";
   }
        
}
  ?>

  </body>
  </html>