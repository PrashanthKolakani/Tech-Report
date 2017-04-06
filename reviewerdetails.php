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
  <link rel="stylesheet" href="styles/details.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
         $res=mysqli_query($con,"select * from reviewer where username='$us'");
         $val = mysqli_fetch_array($res);
         $name = $val['name'];
      echo $name;?></font>
   </div>
   <div class="head2 col-sm-2">
      <font size='5%' color='white'><a href="logout.php">logout</a></font>
   </div>
   </div>  

<div class="homephp">
<br/><br/><br/>
<h3><font color='#8B008B'>Edit Your Profile</font></h3><br>
<br>
     <div class="form">
     <form action="" name="form2" onsubmit="" method="post" enctype="multipart/form-data"> 
     <?php
      $un = $_SESSION['user'];
      $result1 = mysqli_query($con,"select * from reviewer where username = '$un'");
      $test1 = mysqli_fetch_array($result1);
      if (!$result1) 
        {
          echo "Error: Reviewer not found..";
        }
      else{  
      $runame=$test1['username'];
      $result2 = mysqli_query($con,"select * from login where username = '$un' and privilege=2");
      $test2 = mysqli_fetch_array($result2);
      if (!$result2) 
        {
          echo "Error: Data not found in login table..";
        }
      else
       $rpwd=$test2['password'];
      }
    ?>

  <b>Username : &nbsp;</b>     <input type="text" name="currentun" value="<?PHP echo $runame ?>" disabled/> <br/> <br/>
  <b>Change password : &nbsp;</b>     <input type="password" name="newpswd" value="<?PHP echo $rpwd ?>"><br/> <br/>

   <button type="submit" name="change" value="Change">Change</button> <br/> <br/>

  <?php 
      if(isset($_POST['change'])){
        $un = $_SESSION['user'];
        $newpass = $_POST['newpswd'];
        $c_un = $_POST['currentun'];
        if(!$newpass)
        {
          echo "<script>alert('password cannot be empty');</script>";
        }
        else{
        
        if($newpass)
        {
      $res = mysqli_query($con,"update login set password='$newpass' where username='$un' and privilege=2");

      if(mysqli_affected_rows($con))
      {
        echo "<script>alert('profile updated successfully');</script>";
        echo "<script>alert('Session expired: please relogin');</script>";
        echo "<script>window.location.href='login.php';</script>";
      }
      else
         echo " ok updated!!";
      }
      
      }
    }    
  ?>
 </form>

<h3><font color='#8B008B'>Add a Specialization</font></h3><br>
<form action="" method="POST" name="form_spec">
<input type="text" name="spec">
<button type="submit" name="addspec" value="add_spec">Add Specialization</button> <br/> <br/>
</form>

<?php
if(isset($_POST['addspec']))
{
  
 $spec = $_POST['spec'];
 $s1 = strtolower($spec);
 $que = mysqli_query($con,"select * from specialization where lower(specializationname)='$s1'");
 if(mysqli_num_rows($que)==0)
 {

  $val = mysqli_query($con,"insert into specialization(specializationname) values('$spec')");
  if(mysqli_affected_rows($con)>0)
   {
    
   $spnm = mysqli_query($con,"select * from specialization where specializationname = '$spec'");
   $sp = mysqli_fetch_array($spnm);
   $specid = $sp['specializationid'];
   $un = $_SESSION['user'];
   $getdet = mysqli_query($con,"select * from reviewer where username='$un'");
   $var = mysqli_fetch_array($getdet);
   $name = $var['name'];
   $cntno = $var['contactno'];
    $design = $var['designation'];
    $resp = mysqli_query($con,"insert into reviewer(name,specializationid,contactno,designation,username) values('$name',$specid,$cntno,'$design','$un')");
    if(mysqli_affected_rows($con) > 0)
     {
      echo "<script>alert('Specialization added');</script>";

     }
   }
 }
 else
 {
     $spnm = mysqli_query($con,"select * from specialization where specializationname = '$spec'");
     $sp = mysqli_fetch_array($spnm);
   $specid = $sp['specializationid'];
   $un = $_SESSION['user'];
   $getdet = mysqli_query($con,"select * from reviewer where username='$un'");
   $var = mysqli_fetch_array($getdet);
   $name = $var['name'];
   $cntno = $var['contactno'];
    $design = $var['designation'];
    $resp = mysqli_query($con,"insert into reviewer(name,specializationid,contactno,designation,username) values('$name',$specid,$cntno,'$design','$un')");
    if(mysqli_affected_rows($con) > 0)
     {
      echo "<script>alert('Specialization added');</script>";
     }
 }
}
?>


 </div>
 </div>
 </div></br>
 <!--  <div class="footer"><br/><br/> </div> -->
 </div>
 </body>
 </html>
