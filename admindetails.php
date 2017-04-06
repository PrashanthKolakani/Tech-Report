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
      <font size='5%' color='white'>Welcome <?php echo "Admin";?></font>
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
      //echo $un;
      

      $result2 = mysqli_query($con,"select * from login where username = '$un' and privilege=5");
      $test2 = mysqli_fetch_array($result2);
      if (!$result2) 
        {
          echo "Error: Data not found..";
        }
  
    $epwd=$test2['password'];
    //echo $apwd;
    ?>

  <b>Username : &nbsp;</b>   <input type="text" name="currentun" value="<?PHP echo $un ?>"> <br/> <br/>
  <b>Change password : &nbsp;</b>      <input type="password" name="newpswd" value="<?PHP echo $epwd ?>"><br/> <br/>



  <button type="submit" name="change" value="Change">Change</button> <br/> <br/>
  <?php 
      if(isset($_POST['change'])){
        $un = $_SESSION['user'];
        $c_un = $_POST['currentun'];
        $newpass = $_POST['newpswd'];

        if(!$c_un || !$newpass)
        {
          echo "<script>alert('username and password cannot be empty');</script>";
        }
        else{
        
        if($newpass)
        {
      $res = mysqli_query($con,"update login set username='$c_un',password='$newpass' where username='$un' and privilege=5");

      if(mysqli_affected_rows($con))
      {
        echo "<script>alert('profile updated successfully');</script>";
        echo "<script>alert('Session expired: please relogin');</script>";
        echo "<script>window.location.href='login.php';</script>";
      }
      else
         echo "ok updated";
      }
      
      }
    }    
  ?>

 </form>
 </div>
 </div>
</div>
 <!--  <div class="footer"><br/><br/> </div> -->
</div>  

</body>
</html>
