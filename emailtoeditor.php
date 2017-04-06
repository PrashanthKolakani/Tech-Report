<!DOCTYPE html>
<?php include("db.php"); 
session_start();
?>
<html>
<head>
  <script>
    function curYear(){
       return new Date().getFullYear();
     }
   </script>
</head>
<body>
<?php

require 'PHPmailer/PHPMailerAutoload.php';

if(isset($_POST["submit"]))
{
	$title = $_POST["title"];
	$name = $_POST["name"];
	$regno = $_POST["regno"];
	$email = $_POST["email"];
	$programme = $_POST["programme"];
	$field = $_POST["field"];
  $keywords = $_POST["keywords"];
  $abstract = $_POST["abstract"];
 $un = $_SESSION['user'];
 //echo $name,$regno,$email,$programme,$un;
    
     $secnt = mysqli_query($con,"select * from author where username='$un'");
    
if(mysqli_num_rows($secnt)==0)
 {

  $rno = strtolower($regno);
  $trq = "insert into author(authorname,username,regno,programme)
    values('$name','$un','$rno','$programme')";
   $ch = mysqli_query($con,$trq);
    }
//if(isset($_FILES('fileToUpload')))
  $file = $_FILES["fileToUpload"];

$file_name = $file["name"];
$file_temp = $file["tmp_name"];
$file_size = $file["size"];
$file_error = $file["error"];

$file_ext = explode('.',$file_name);
$file_ext = strtolower(end($file_ext));

$allowed = array('pdf','txt');

if(in_array($file_ext, $allowed))
{
  echo $file_error;
    if($file_error === UPLOAD_ERR_OK)
    {
    // if($file_size < 1000000)
     //{
      $target_dir = "reports/";
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

$query = "select * from editor";
$result = mysqli_query($con,$query);

$val = mysqli_fetch_array($result);

$editorname = $val['editorname'];
$editoremail = $val['username'];

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication

$mail->Username = 'techreport.2017@gmail.com';                 // SMTP username
$mail->Password = 'nitc1234admin';                           // SMTP password

$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

echo $email;
echo $name;
echo "1111111111";
echo $editoremail;
$mail->setFrom($email, $name);
$mail->addAddress($editoremail, $editorname);     // Add a recipient
$mail->addAddress($editoremail);               // Name is optional
$mail->addReplyTo('techreport.2017@gmail.com', 'Information');

$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = "abcd";
$mail->Body    = "New Report Submitted";

if(!$mail->send())
{
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} 
else
{
   $uname = $_SESSION["user"];
   echo $uname;
   $getqid = "select * from author where username='$uname'";
   $res = mysqli_query($con,$getqid);
   if(mysqli_num_rows($res) == 0)
     echo "sorry!!!!!!!";
   else{
   while($val = mysqli_fetch_array($res))
     $aid = $val['authorid'];

    $y = date("Y");   
    if($title && $aid && $field && $y && $target_file){
   $mailque = "insert into techreport(title,authorid,researchfield,year,reportpath,privilege,status)
    values('$title','$aid','$field','$y','$target_file','1','SP')";
   $changepriv = mysqli_query($con,$mailque);
    
    echo "<script>confirm('Email has been sent');</script>";
    echo "<script>window.location.href='authorpage.php';</script>";
     }
   }
}
?>
</body>
</html>