<!DOCTYPE html>
 <?php session_start();
   if(isset($_GET["username"]))
     $_SESSION['user'] = $_GET["username"];?>
 <?php include("db.php"); ?>

<html lang="en">
<head>
  <title>CSED Technical Reports</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/admin.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<script>
function validateForm1()
{

var z=document.forms["myForm1"]["name"].value;
if (z==null || z=="")
  {
  alert("Editor name must be filled out");
  return false;
  }
  
var y=document.forms["myForm1"]["email"].value;
var atpos=y.indexOf("@");
var dotpos=y.lastIndexOf("@nitc.ac.in");
if (y==null || y=="")
  {
  alert("please enter nitmail-id");
  return false;
  }

if (atpos<1 || dotpos+11!=y.length)
  {
  alert("Invalid:specify nitc mail address");
  return false;
  }

  var z=document.forms["myForm1"]["birthday"].value;
if (z==null || z=="")
  {
  alert("Date of birth must be filled out");
  return false;
  }

var split = z.split('-');
var yr = split[0];
var d = new Date();
var n = d.getFullYear();
if(yr < (n-70) || yr > (n+70))
{
    alert("Error: Enter valid date of birth");
    return false;
}

  var user=document.forms["myForm1"]["username"].value;
 if (user==null || user=="")
  {
  alert("username can't be empty");
  return false;
  }
  
 
 var w=document.forms["myForm1"]["pass"].value;
 if (w==null || w=="")
  {
  alert("password must be filled out");
  return false;
  }

  var cp=document.forms["myForm1"]["cpass"].value;
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
 }
</script>

</head>

<body>
<div style="height:100%">
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

   <div class="row" style="height:43px;background-color:#B0B0B0;">
    <div class="head1 col-sm-10">
      <font size='5%' color='white'>Welcome <?php echo "Admin";?></font>
    </div>
    <div class="head2 col-sm-2">
      <font size='5%' color='white'><a href="logout.php">logout</a></font>
    </div>
   </div>    

<div class="homephp col-sm-9">
  <br/>
  <h3><font color="#8B008B">Change Editor</font></h3><br/>
  
  <div class='form'>
  <form action="" name="myForm1" method="POST" onsubmit="return validateForm1();">
    <div id="pad">Editor's Name :   </div><input  type="text" name="name"><br/><br/>
    <div id="pad">Editor's Email :    </div><input type="text" name="email"><br/><br/>
    <div id="pad">Editor's dob : </div><input name="birthday" type="date"><br/><br/>
    <div id="pad">New Password :      </div><input type="password" name="pass"><br/><br/>
    <div id="pad">Confirm Password :  </div><input type="password" name="cpass"><br/><br/>
    <br/>
    <input id="but" type="submit" name="submit_add_editor" value="Add Editor"><br/><br/>
  </form>
  </div>

<?php
if(isset($_POST['submit_add_editor']))
{
   $name = $_POST['name']; 
   $email = $_POST['email']; 
   $dob = $_POST['birthday']; 
   $pass = $_POST['pass']; 
   $cpass = $_POST['cpass'];
 
    $res1 = mysqli_query($con,"delete from login where privilege = 1");
    if(mysqli_affected_rows($con) > 0)
     {
       $loen = mysqli_query($con,"insert into login(username,password,privilege,dob) 
                values('$email','$pass',1,'$dob')");
        if(mysqli_affected_rows($con) > 0)
          {
            $res2 = mysqli_query($con,"insert into editor(editorname,username) 
                    values('$name','$email')");
          if(mysqli_affected_rows($con)>0)
             {
              echo "<script>confirm('Editor has been added');</script>";
              echo "<script>window.location.href='admin.php';</script>";
             }
            else
              echo "Editor not inserted";
          }
        else
          echo "Login table not updated";
      }
   else
    {
    echo "<script>alert('deletion failed');</script>";
     }  
}
?>
  
</div>

 <div class="login col-sm-3">
  <h3><font color='#8B008B'> Settings </font></h3>
  <p>Change your username/password below</p>
 <br>
   <a href="admindetails.php"><button><b>Change Profile</b></button></a><br>
   <br/>
</div>

</div>
 <!-- <div class="footer"><br/><br/> </div> -->
</div>
 </body>
 </html>





