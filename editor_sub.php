<!DOCTYPE html>
 <?php session_start();
   if(isset($_GET["username"]))
     $_SESSION['user'] = $_GET["username"];
   if(isset($_GET["id"]))
       $id = $_GET["id"];
 ?>
 <?php include("db.php"); ?>

<html lang="en">
<head>
  <title>CSED Technical Reports</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/editor_sub.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
 <br/><br/>
  <h3><font color='#8B008B'>Select the reviewer to assign the report</font></h3><br/>
   <div class="form">
   <form action='' method='POST'>
    <select class='dropdown' name='getspec'>
    <option value =' ' id='option'>
  
   <?php
     $getflow="select * from specialization";
     $run_flow=mysqli_query($con,$getflow);
    while($row_flow=mysqli_fetch_array($run_flow))
      {
       $specid=$row_flow['specializationid'];
       $specname=$row_flow['specializationname'];
       echo "<option value='$specname' id='option'/>$specname";
      }

    ?>
   </select>
    <br>
   <input id = "but" type = 'submit' value="Get Reviewers" name='submit'>
  
   </form>
   </div>

<?php
    if(isset($_POST['submit']))
    {
      echo "<br>";
      echo "<br>";
      $spec = $_POST['getspec'];

       $getname="select * from specialization,reviewer where
          specialization.specializationid = reviewer.specializationid and specializationname = '$spec'";
       

      $query=mysqli_query($con,$getname);
       if(!mysqli_num_rows($query)){
           echo "<i>No reviewers for this specialization</i>";
       } else{
       
    while($result=mysqli_fetch_array($query))
      {
       $reviewer_name = $result['name'];
       $reviewer_id = $result['idno'];
       
       
       
       $getemail = "select * from reviewer where idno='$reviewer_id'";
       $inter=mysqli_query($con,$getemail);
      // while($revemail = mysqli_fetch_array($inter))
       if(mysqli_num_rows($inter)==0)
         echo "No Emailid Available";
         $revemail = mysqli_fetch_array($inter);
         $em = $revemail['username'];
         $name = $revemail['name'];
     /*echo "<input type = 'button' name='button' value = 'Assign' onclick='<?php echo mailfun();?>'*/
    echo "<b style='padding-left:10%'><i>$reviewer_name</i></b> <a style='color:black;margin-left:10%' href='editor_sub.php?email=$em&id=$id&reviewer=$reviewer_id'>Assign</a>";       
       //echo "<b><i style='padding-left:45%'>$reviewer_name</i></b>";
       echo "<br/>";
       echo "<br/>";
      }
    }
    }
    if(!isset($_POST['submit1']))
      ;
   ?>

 <?php

   function mailfun()
  {
  $con=mysqli_connect("localhost","root","password","csedtr");
  $reportid = $_GET['id'];
  $reviewerid = $_GET['reviewer'];

  echo $reportid; echo "fdsfd";
  echo $reviewerid;

  $upque = "update techreport set reviewerid = $reviewerid , status = 'SR' where reportid = $reportid";
  $upres = mysqli_query($con,$upque);
  
  $cnt = mysqli_affected_rows($con);
 
  if($cnt > 0)
{
  require_once 'PHPmailer/PHPMailerAutoload.php';

  $mail = new PHPMailer;
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication

  /*$edidet = "select * from editor";
  $res = mysqli_query($con,$edidet);
  $sendername  = $res['editorname'];
  $senderemail = $res['editoremail'];*/
  $receiveremail = $_GET['email'];
  $subject = "New Report for Reviewing";
  $message = "Please Login to your account to see further details of TechReport Submitted";

$mail->Username = 'techreport.2017@gmail.com';                 // SMTP username
$mail->Password = 'nitc1234admin';                           // SMTP password

$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

//$mail->setFrom($senderemail, $sendername);
//$mail->addAddress($receiveremail, $name);     // Add a recipient
$mail->addAddress($receiveremail);               // Name is optional
$mail->addReplyTo('techreport.2017@gmail.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $subject;
$mail->Body    = $message;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    
    echo "<script>confirm('Email has been sent');</script>";
    echo "<script>window.location.href='editorpage.php';</script>";
   // echo "<script>setTimeout('window.close()', 200);</script>";
    }
}
else {
  echo "sorry";
}
}
 if (isset($_GET['email'])) {
    mailfun();
  }

 ?>
 </div>
 </div>

 
</div>
 </body>
 </html>