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

<div class="homephp col-sm-9"><br/>
  <h3><font style='margin-left: 40%' color = '#8B008B'>Fill the Review details below</font></h3><br/><br/>
  <div class="form">
 <form action='' method='POST' enctype= 'multipart/form-data'>
  <b>Review  :</b> <br/><div style="padding:1%"><input type = "radio" name = "status" value = "Accept"> Accept <br/></div>
            <div style="padding:1%"> <input type = "radio" name = "status" value = "Reject"> Reject <br/></div>
             <div style="padding:1%"> <input type = "radio" name = "status" value = "Modify"> Modify<br><br></div>
  <b>Comment :   </b><br/> <br/><input style="padding-left:10%;"type="file" id="file" name="fileToUpload"/><br/>
              (<i>Upload Comments as a file(eg.pdf or .txt)</i>)<br/><br/>
 <input id="but" type = 'submit' value="submit" name='submit'>
   </form>
   </div>
</div>



<?php
    if(isset($_POST['submit']))
    {$q = "select * from editor";
     $res = mysqli_query($con,$q);
     $row=mysqli_fetch_array($res);
    $editorid = $row['username'];
    $stat = $_POST['status'];
    //echo $stat;
  //$comm = $_POST['Comment'];  
   
   if($stat=="Modify")
     $val='M';
   elseif($stat=="Accept")
     $val='A';
   else
     $val='R';

//echo $val;

  if($val=='M'){
   $file = $_FILES["fileToUpload"];
  // echo $file;


$file_name = $file["name"];
$file_temp = $file["tmp_name"];
$file_size = $file["size"];
$file_error = $file["error"];
$file_ext = explode('.',$file_name);
$file_ext = strtolower(end($file_ext));

$allowed = array('pdf','txt');
if(in_array($file_ext, $allowed))
{
  
    if($file_error === UPLOAD_ERR_OK)
    {
    // if($file_size < 1000000)
     //{
      $target_dir = "comments/";
      $target_file = $target_dir . basename($file_name);  
      if (move_uploaded_file($file_temp, $target_file)) 
       {
        echo "The file ". basename($file_name). " has been uploaded.";
       }
      else 
       {
        echo "Sorry, there was an error uploading your file.";
       }
    // }
    // else
      // echo "file execeeded limit";
    }
    else
      echo "sorry";
}
else
  echo "no ext found";
   
  }
  $reportid = $_GET['id'];
  
  $upque = "update techreport set status = '$val' where reportid = $reportid";
  $upres = mysqli_query($con,$upque);
  $cnt = mysqli_affected_rows($con);
  //echo $cnt;
  if($cnt > 0)
  {
  require_once 'PHPmailer/PHPMailerAutoload.php';

  $mail = new PHPMailer;
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication

  
  $revieweremail = $_GET['username'];
  $subject = "A review for report have been submitted";
  $message = "Please Login to your account to see review of the report";

$mail->Username = 'techreport.2017@gmail.com';                 // SMTP username
$mail->Password = 'nitc1234admin';                           // SMTP password

$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

//$mail->setFrom($senderemail, $sendername);
//$mail->addAddress($receiveremail, $name);     // Add a recipient


$mail->addAddress($editorid);               // Name is optional
$mail->addReplyTo('techreport.2017@gmail.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML
$mail->addAttachment($target_file);         // Add attachments
//$mail->addAttachment($target_file, techreport.pdf);    // Optional name
$mail->isHTML(true);   

$mail->Subject = $subject;
$mail->Body    = $message;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
   
   if($val=="A" || $val=='R'){
     echo "<script>confirm('Email has been sent');</script>";
     echo "<script>window.location.href='reviewerpage.php';</script>";}
   if($val=="M"){
    $que = "update techreport set comment = '$target_file' where reportid = $reportid";
    $res = mysqli_query($con,$que);
    $cnt2 = mysqli_affected_rows($con);
    if($cnt2 == 1){
      //echo "updated in db";
      echo "<script>confirm('Email has been sent');</script>";
      echo "<script>window.location.href='reviewerpage.php';</script>";}
    else
      echo "error in updating db";
    }
   } 
}
else {
  echo "sorry";
}

 }

 ?>

 </div>


 
</div>
 </body>
 </html>

