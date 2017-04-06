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
  <link rel="stylesheet" href="styles/editorpage.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<script>
function validateForm1()
{

var z=document.forms["myForm1"]["rname"].value;
if (z==null || z=="")
  {
  alert("Reviewer name must be filled out");
  return false;
  }
  
var y=document.forms["myForm1"]["remail"].value;
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

var z=document.forms["myForm1"]["rcntno"].value;
if (z==null || z=="")
  {
  alert("contact no cannot be empty");
  return false;
  }
  cno= /^\d{10}$/;
if(!(document.forms["myForm1"]["rcntno"].value.match(cno)))
  {
     alert("Not a valid Phone Number");
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

var desg=document.forms["myForm1"]["rdesg"].value;
if (desg==null || desg=="")
  {
  alert("designation cannot be empty");
  return false;
  }

  var spec=document.forms["myForm1"]["rspec"].value;
  if (spec==null || spec=="")
  {
  alert("specialization can't be empty");
  return false;
  }

  var user=document.forms["myForm1"]["ruser"].value;
 if (user==null || user=="")
  {
  alert("username can't be empty");
  return false;
  }
  
 
 var w=document.forms["myForm1"]["rpass"].value;
 if (w==null || w=="")
  {
  alert("password must be filled out");
  return false;
  }

  var cp=document.forms["myForm1"]["rcpass"].value;
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
      <font size='5%' color='white'>Welcome <?php 
         $us = $_SESSION['user'];
         $res=mysqli_query($con,"select * from editor");
         $val = mysqli_fetch_array($res);
         $name = $val['editorname'];
      echo $name;?></font>
    </div>
    <div class="head2 col-sm-2">
      <font size='5%' color='white'><a href="logout.php">logout</a></font>
    </div>
   </div>    

<div class="homephp col-sm-9">
   <h3><font color="#8B008B">Add a New Reviewer </font></h3><a href = "#addreviewer" style="font-size:18px; padding-left:15px;color:black;">Add New Reviewer</a>  <br/><br/><br/>
   <h3><font color="#8B008B">Remove a Reviewer </font></h3><a href = "#removereviewer" style="font-size:18px; padding-left:15px;color:black;">Remove reviewer</a> <br/><br/><br/> 

<h3 id="addreviewer"><font color="#8B008B">Add New Reviewer here:</font></h3><br/>
  <form action="" name="myForm1" method="POST" onsubmit="return validateForm1();">
    <div id="pad">Reviewer's Name :  </div><input style="float:right margin-right:450px;" type="text" name="rname"><br/><br/>
    <div id="pad">Reviewer's Email : </div><input style="float:right margin-right:450px" type="text" name="remail"><br/><br/>
    <div id="pad">Reviewer's Contactno : </div><input style="float:right margin-right:450px" type="text" name="rcntno"><br/><br/>
    <div id="pad">Reviewer's dob : </div><input style="float:right margin-right:450px" name="birthday" type="date"><br/><br/>
    <div id="pad">Designation : </div><input style="float:right margin-right:450px" type="text" name="rdesg"><br/><br/>
    <div id="pad">Specialization/(s) :</div><input style="float:right margin-right:450px" type="text" name="rspec"><br/><br/><br/>
    <p><i><b>(One or more can be entered,seperated by commas)</b></i></p><br/>
     <!--<div id="pad">Username : </div><input style="float:right margin-right:450px" type="text" name="ruser"><br/><br/> -->
    <div id="pad">New Password : </div><input style="float:right margin-right:450px" type="password" name="rpass"><br/><br/>
    <div id="pad">Confirm Password :  </div><input style="float:right margin-right:450px" type="password" name="rcpass"><br/><br><br/>
    <input type="submit" name="submit_add_reviewer" value="Insert new reviewer"><br/><br/>
  </form>
<br>
<?php
 if(isset($_POST['submit_add_reviewer']))
 {
   $rname = $_POST['rname']; 
   $remail = $_POST['remail']; 
   $desg = $_POST['rdesg'];
   $spec = $_POST['rspec'];
   $rcntno = $_POST['rcntno'];
   $dob = $_POST['birthday'];
   $rpass = $_POST['rpass']; 
   $rcpass=$_POST['rcpass']; 
   
 mysqli_query($con,"select * from login where username = '$remail' and privilege=2");
 if(mysqli_num_rows($con) > 0)
  { 
   echo "<script>alert('username already exists');</script>";
  }
  else
  { //echo $dob;echo $remail;
  $res = mysqli_query($con,"insert into login values('$remail','$rpass',2,NULL,'','$dob')");
   // $que = "insert into login(username,password,privilege) values('$remail','$rpass','2')";
    //$val =  mysqli_query($con,$que);
  //echo mysqli_affected_rows($con);
    if(mysqli_affected_rows($con)>0)
    {
     $field=explode(',', $spec);
     foreach($field as $sp)
      { 
        $sp1 = trim($sp," ");
        $sp2 = strtolower($sp1);
        $qres = mysqli_query($con,"select specializationid from specialization where 
        lower(specializationname)='$sp2'");
        if(!mysqli_num_rows($qres))
        {
         $p = mysqli_query($con,"insert into specialization(specializationname) values('$sp1')");
         $v = mysqli_query($con,"select * from specialization where specializationname='$sp1'");
         $res = mysqli_fetch_array($v);
         $fie = $res['specializationid'];
         mysqli_query($con,"insert into reviewer(name,specializationid,contactno,designation,username) 
         values('$rname','$fie','$rcntno','$desg','$remail')"); 
         if(mysqli_affected_rows($con) > 0)
         { 
          echo "<script>alert('Reviewer has been added')</script>";
          echo "<script>window.location.href='editorsettings.php';</script>";
         }
         else{
          echo "Reviewer insertion failed";
         }
        }
       else
       {
       if($qu = mysqli_fetch_array($qres))
         $specid = $qu['specializationid'];  
       if(mysqli_affected_rows($con)>0)
         {
     mysqli_query($con,"insert into reviewer(name,specializationid,contactno,designation,username) 
          values('$rname','$specid','$rcntno','$desg','$remail')");            
            if(mysqli_affected_rows($con) > 0)
              { 
              echo "<script>alert('Reviewer has been added')</script>";
              echo "<script>window.location.href='editorsettings.php';</script>";
               }
                else{echo "Reviewer insertion failed";}
            }
         }
       }
      }
       else
     echo "login error";
   }
 }
?>


<h3 id="removereviewer"><font color="#8B008B">Remove Reviewer here:</font></h3><br/>
  <?php
     $getflow="select distinct name,username from reviewer";
     $run_flow=mysqli_query($con,$getflow);
    while($row_flow=mysqli_fetch_array($run_flow))
      {
       $rewname=$row_flow['name'];
       //$rewid=$row_flow['idno'];
       $uname = $row_flow['username'];
       echo $rewname;
       echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  ";
       echo "<a href='editorsettings.php?username=$uname' style=' padding-left:15px;color:black;'>Remove the reviewer</a><br/><br/><br/>";
      }
      echo "<br/>";
    ?>


<?php
 if(isset($_GET['username']))
 {
  //$idno = $_GET['idno'];
  $un = $_GET['username'];
  $r1 = mysqli_query($con,"delete from reviewer where username = '$un'");

  if(mysqli_affected_rows($con) > 0)
  {
    $r2 = mysqli_query($con,"delete from login where username='$un' and privilege=2");
    if(mysqli_affected_rows($con)>0){
      echo "<script>confirm('Reviewer has been removed');</script>";
      echo "<script>window.location.href='editorsettings.php';</script>";}
    else{echo "login deletion failed";}  
  }
  else{echo "Reviewer deletion failed";}
 }
?>

</div>
</div>
<!-- <div class="footer"><br/><br/> </div> -->
</div>
 </body>
 </html>