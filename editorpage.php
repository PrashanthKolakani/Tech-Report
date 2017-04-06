<!DOCTYPE html>
 <?php
 include("db.php"); 
  session_start();
  if(isset($_GET["username"])){
  $_SESSION["user"] = $_GET["username"];
  $un = $_SESSION["user"];}
  $comment="";
?>


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

function loadDoc(rid,aid,sid){
  if(window.XMLHttpRequest){
    var xhttp = new XMLHttpRequest();
  }else{
    var xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    confirm("Email has been sent");
    window.location.href = "editorpage.php";  
    }
  };

  xhttp.open("GET", "editormail.php?reportid="+rid+"&authorid="+aid+"&st="+sid, true);
  xhttp.send();
  
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
         $res=mysqli_query($con,"select * from editor where username='$us'");
         $val = mysqli_fetch_array($res);
         $name = $val['editorname'];
      echo $name;?></font>
    </div>
    <div class="head2 col-sm-2">
      <font size='5%' color='white'><a href="logout.php">logout</a></font>
    </div>
   </div>    

<div class="homephp col-sm-9">
    <h3><font color='#8B008B'>List of New Technical Reports Submitted</font></h3><br>
    <?php
      $res = mysqli_query($con,"select * from techreport where status='SP'");
     echo "<ul>";
     if(mysqli_num_rows($res)==0)
       echo "<h5><i>No Newly Submitted Technical Reports</i></h5><br/><br/>";
     else{
     while($row = mysqli_fetch_array($res))
     { 
      //global $reportid;
      $ti = $row['title'];
      $reportid = $row['reportid'];
      echo "<div class='st'>";
      echo "<li><h4>$ti</h4></li>";
      $rf = $row['researchfield'];
      echo "<i>$rf</i>";
      echo "&nbsp;&nbsp;";
      $path = $row['reportpath'];
      $url = "http://localhost/bootstrap/".$path;
      echo "<a href=$url target='_blank'><span class='btn-primary'>PDF</span></a>";
      echo "<a style='color:black;margin-left:20%;text-decoration:none' href = 'editor_sub.php?username=$un&id=$reportid'>&nbsp; &nbsp; Assign for Reviewing</a>
        ";
        /* <a href='editor_sub.php' target='popup' onclick='window.open(\"editor_sub.php?username=$un&
        id=$reportid\",\"_blank\",\"width=400,height=400\"); return false;'> Assign for Reviewing </a></button>";*/
      echo "</div>";
      }
    echo "</ul>";}
   ?>

  <?php
     global $comment;
     echo "<br/><br/>"; echo "<br/>"; 
     echo "<h3><font color='#8B008B'>Recently Reviewed Technical Reports</font></h3>";
     echo "<i>(Status of technical reports is expected to be conveyed to author before publishing the accepted reports)</i></br></br>";
     $res = mysqli_query($con,"select * from techreport where status='A' or status='M' or status='R'");
     if(!mysqli_num_rows($res))
      echo "<h5><i>No Recently Reviewed Tech Reports</i></h5>";
    else{
      echo "<ul>";
     while($row = mysqli_fetch_array($res))
     {
      $st = $row['status'];
      if($st=='A')
         $st_val = 0;
      elseif($st=='R')
         $st_val = 1;
      elseif($st=='M')
         $st_val = 2;
      
      $ti = $row['title'];
      $reportid = $row['reportid'];
      $authorid=$row['authorid'];
      $comment = $row['comment'];
      echo "<div class='st'>";
      echo "<li><h4>$ti</h4></li>";
      $rf = $row['researchfield'];
      echo "<i>$rf</i>";
      echo "&nbsp;&nbsp;";
      $path = $row['reportpath'];
      $url = "http://localhost/bootstrap/".$path;
      echo "<a href=$url target='_blank'><span class='btn-primary'>PDF</span></a>";
     // echo "<a href='editormail.php?reportid=$reportid&authorid=$authorid&st=$st_val'>click me</a>";
      echo "<button id='but1' style='margin-left:20px;' onclick='loadDoc($reportid,$authorid,$st_val)'> Convey Review Status to Author
      </button>";

      if($st=='A'){
        echo "<a style='color:black; margin-left:15%;' href = 'publish.php?id=$reportid'>Publish</a>";
      }
      
      echo "</div>";
      }
    echo "</ul>";
    } 

  ?>
 
<?php
if(isset($_GET['id']))
{
 require_once 'PHPmailer/PHPMailerAutoload.php';

 global $comment;
 $que = myssqli_query($con,"select * from editor where username='$un'");

 
 $authid = $_GET['autid'];
 $repid = $_GET['id'];

 $mail = new PHPMailer;

 $mail->isSMTP();                                      // Set mailer to use SMTP
 $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
 $mail->SMTPAuth = true;                               // Enable SMTP authentication

 $mail->Username = 'techreport.2017@gmail.com';                 // SMTP username
 $mail->Password = 'nitc1234admin';                           // SMTP password

 $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
 $mail->Port = 465;                                    // TCP port to connect to

 $mail->setFrom($senderemail, $sendername);
$mail->addAddress($receiveremail, 'Joe User');     // Add a recipient
$mail->addAddress($receiveremail);               // Name is optional
$mail->addReplyTo('techreport.2017@gmail.com', 'Information');

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $subject;
$mail->Body    = $message;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo "<script>confirm('Email has been sent');</script>";
    echo "<script>window.location.href='editorpage.php';</script>";
}
  }
?>
 <br> <br> <br>

 </div>

 <div class="login col-sm-3">
  <h3 style="margin-left:25%;"><font color='#8B008B'> Settings </font></h3>
  <p>Change your username / password below</p>
 
   <a href="editordetails.php"><button id="but2"><b>Change Profile</b></button></a>
   <br/><br/>
   <p>Add or Remove a Reviewer below</p>

   <a href = 'editorsettings.php'><button id="but2"><b>Settings</b></button></a>

</div>

 </div>
 <!-- <div class="footer"><br/><br/> </div> -->
</div>
 </body>
 </html>