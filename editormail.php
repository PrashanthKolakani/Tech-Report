

<?php
{
 include("db.php");
 
 session_start();
 $un = $_SESSION['user'];

 require_once 'PHPmailer/PHPMailerAutoload.php';

  $rid = $_GET['reportid'];
  $aid = $_GET['authorid'];
  $st1 = $_GET['st'];
  
  echo $st1;

  if($st1==0)
    $status = 'Accepted';
  elseif($st1==1)
    $status = 'Rejected';
  else
    $status = 'Modify some corrections are required';

 $que = mysqli_query($con,"select * from editor where username='$un'");
 
 while($res = mysqli_fetch_array($que))
{
  $edi_email = $res['username'];
  $edi_name = $res['editorname'];
}


$auque = mysqli_query($con,"select * from author where authorid = '$aid'");
while($res = mysqli_fetch_array($auque))
{
  $auth_email = $res['username'];
  $auth_name = $res['authorname'];
}

 
 $mail = new PHPMailer;

 //$mail->SMTPDebug = 3;                               // Enable verbose debug output

 $mail->isSMTP();                                      // Set mailer to use SMTP
 $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
 $mail->SMTPAuth = true;                               // Enable SMTP authentication

 $mail->Username = 'techreport.2017@gmail.com';                 // SMTP username
 $mail->Password = 'nitc1234admin';                           // SMTP password

 $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
 $mail->Port = 465;                                    // TCP port to connect to

 $mail->setFrom($edi_email, $edi_name);
$mail->addAddress($auth_email, $auth_name);     // Add a recipient
$mail->addAddress($auth_email);               // Name is optional
$mail->addReplyTo('techreport.2017@gmail.com', 'Information');


//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
 $res = mysqli_query($con , "select * from techreport where reportid='$rid'");
 if($var = mysqli_fetch_array($res)){
   $path = $var['comment'];
   $aid = $var['authorid'];
 }else{
  $path = NULL;
 }
 
$mail->addAttachment($path);         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

$mail->isHTML(true);                                  // Set email format to HTML
$subject = "Report Review";
$mail->Subject = $subject;
$mail->Body    = $status;
$mail->send();


  if($st1 == 0){
    //echo $rid;
    //mysqli_query($con, "update techreport set status='P' where status='A' and reportid='$rid'");
    
     //if(mysqli_affected_rows($con) > 0)
       // {
          
          $res = mysqli_query($con, "select * from author where authorid='$aid'");
          if($var = mysqli_fetch_array($res)){
            $regno = $var['regno'];
            //echo $regno;
            $res =  mysqli_query($con,"select extract(year from curdate()) as year,extract(month from curdate()) as month,
                   extract(day from curdate()) as day,curtime() as time"); 
            if($y = mysqli_fetch_array($res)) 
              {   
                 $curyear = $y['year'];
                 $curmonth = $y['month'];
                 $curday = $y['day'];
                 $curtime = $y['time'];
                 $id = "NITC/CSED/TR/".$regno."/".$curyear."/".$curmonth."/".$curday."/".$curtime;
            
            
          mysqli_query($con, "update techreport set year=$curyear,uniqueid='$id' where reportid='$rid'");
          if(mysqli_affected_rows($con) > 0)
          {
              echo "updated successfully newid";
          }
        }
        //}
      }
      else
        echo "no1";
  }elseif($st1 == 1){
    $r = mysqli_query($con, "delete from techreport where status='R' and reportid='$rid'");
    if(mysqli_affected_rows($con) > 0)
        echo "yes2";
      else
        echo "no2";
  }elseif($st1==2){
    $q = mysqli_query($con, "delete from techreport where status='M' and reportid=$rid");
    //echo mysqli_affected_rows($con);
    if(mysqli_affected_rows($con))
        echo "yes3";
      else
        echo "no3";
  }
  
}
?>