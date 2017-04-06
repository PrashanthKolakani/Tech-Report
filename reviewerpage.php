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
  <link rel="stylesheet" href="styles/reviewerpage.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
function myFunction()
{
  var myWindow = window.open("mailpage.php?email='<?php echo $em;?>'","","width=800,height=800");
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

 <div class="homephp col-sm-9">
 
 <h3><font color="#8B008B">List of New Technical Reports Submitted</font></h3><br/>

  <?php
    
     $res = mysqli_query($con,"select * from techreport where status='SR'");
     echo "<ul>";
     if(!mysqli_num_rows($res))
     {
      echo "<i style= 'padding-left:40px;'>No reports submitted yet for review</i>";
     }
     else{
     while($row = mysqli_fetch_array($res))
     {
      $ti = $row['title'];
      $reportid = $row['reportid'];
      echo "<div>";
      echo "<li><h4>$ti</h4></li>";
      $rf = $row['researchfield'];
      echo "<i>$rf,</i>";
      echo "&nbsp;&nbsp;";
      $path = $row['reportpath'];
      $url = "http://localhost/techreport/".$path;
      //echo "<a style='margin-left:50px;' href=$url target='_blank'><span class='btn-primary'>PDF</span></a>"; 
      echo "<a href=$url target='_blank'><span class='btn-primary'>PDF</span></a>";
      $un = $_SESSION["user"];
      //echo "<a href='editormail.php?username=$un&id=$reportid'>clickme</a>";
      //echo "<div class='but'><a href = 'reviewer_sub.php?username=$un&id=$reportid' 
      //style='color:black;text-decoration:none;'>Review the report</a></div>";
      //echo "<button type='button' class='btn' ><a href = 'reviewer_sub.php?username=$un&id=$reportid' 
      //style='color:black;'>Review the report</a>";

      echo "<a href='reviewer_sub.php?username=$un&id=$reportid' style='text-decoration:none;color:black;margin-left:20%;'><b>Review the report</b></a><br>";
      echo "</div>";
      }
    }
    echo "</ul>";
  ?>

 </div>

<div class="login col-sm-3">
  <h3><font color='#8B008B'> Settings </font></h3>
  <p>Change your username/password below</p>
 <br>
   <a href="reviewerdetails.php"><button><b>Change Profile</b></button></a><br>
   <br/>

 </div>

</div>
 <!-- <div class="footer"><br/><br/> </div>  -->
</div>
 </body>
 </html>