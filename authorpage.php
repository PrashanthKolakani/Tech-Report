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
  <link rel="stylesheet" href="styles/athorpage.css">
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

    <div class="row" style="height:50px;background-color:#B0B0B0;">
   <div class="head1 col-sm-10">
      <h4 style="float:left;font-size:22px;color:white;margin-left:25px;">Welcome <?php 
         $us = $_SESSION['user'];
         $res=mysqli_query($con,"select * from author where username='$us'");
         $val = mysqli_fetch_array($res);
         $name = $val['authorname'];
      echo $name;?></h4></div>
   <div class="head2 col-sm-2">
      <a href="logout.php" style="font-size:22px;color:white;float:right;margin-right:20px;">logout</a>
   </div>
   </div>    

<div class="homephp col-sm-9">
    <h3><font color='#8B008B'>My Successful Submissions</font></h3><br>
    <?php
       $un = $_SESSION['user'];
       $techrep = mysqli_query($con,"select * from author,techreport where author.username='$un' and author.authorid = techreport.authorid and status ='P'");

       if(!mysqli_num_rows($techrep)){
        echo "<b style='padding-left:4%'>No tech reports submitted</b>";
       }
       else{
      echo "<ul>";
     while($res = mysqli_fetch_array($techrep))
     {
      echo "<li style='margin-left:50px;'><h4>".$res['title']."</h4></li>"; 
      $path = $res['reportpath'];
      $url = "http://localhost/bootstrap/".$path;
      echo "<a style='margin-left:50px;' href=$url target='_blank'><span class='btn-primary'>PDF</span></a>"; 
      echo "<br/>";
      $st = $res['status'];
     }
      echo "</ul>";}
      echo "<br/>";echo "<br/>";echo "<br/>";
      
      echo "<h3><font color='#8B008B'>Reports Under Progress</font></h3>";
      $techrep = mysqli_query($con,"select * from author,techreport where author.username= '$un' and 
                         author.authorid = techreport.authorid and status in ('SP','SR','A','R','M')");
       echo "<br/>";
       if(mysqli_num_rows($techrep)){
      echo "<ul>";
      while($res = mysqli_fetch_array($techrep))
     {
      $path = $res['reportpath'];
      $url = "http://localhost/bootstrap/".$path;
      echo "<li style='margin-left:50px;'><h4>".$res['title']."&nbsp; <a href=$url target='_blank'><span class='btn-primary'>PDF</span></a></h4></li>"; 
      
      //echo "<a style='margin-left:50px;' href='$url' target='_blank'><span class='btn-primary'>PDF</span></a>"; 
      $st = $res['status'];
      //echo "<br/>";
      if($st == 'SP'){
            echo "<i style='margin-left:50px; '>Submitted for publishing</i><br/>";
      }elseif($st == 'SR'){
            echo "<i style='margin-left:50px; '>Submitted for reviewing</i><br/>";
      }elseif($st == 'A' ||$st == 'R' ||$st == 'M'){
            echo "<i style='margin-left:50px; '>Report has been reviewed, status will be conveyed soon</i><br/>";
     }
     echo "<br>"; 
    }
    echo "</ul>";
  }
      ?>

    </div>
   

<div class="login col-sm-3">
  <h3 ><font color='#8B008B'> Settings </font></h3>
<p>Submit a new Technical Report Below</p>
 <br>
    <span id="rep_sub"><a href="trform.php"><button id="but1">Submit A New Tech Report</button></a></span>
   
   <p>Change Username/Password Below</p>
 <br>
  <span id="rep_sub"><a href="authordetails.php"><button id="but1">Change Profile</button></a></span>
 </div>
 </br></br>
</div>
 <!-- <div class="footer"><br/><br/> </div> -->
</div>
 

</body>
</html>