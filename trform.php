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
  <link rel="stylesheet" href="styles/trform.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<script>
function validateForm1()
{
var z=document.forms["myForm1"]["title"].value;
if (z==null || z=="")
  {
  alert("Title must be filled out");
  return false;
  }

 <!---->
  var w=document.forms["myForm1"]["name"].value;
if (w==null || w=="")
  {
  alert("Author name can't be empty");
  return false;
  }
  var rno=document.forms["myForm1"]["regno"].value;
if (rno==null || rno=="")
  {
  alert("Enter your reg-number");
  return false;
  }
  


var n = rno.length;
  
  var str = rno.toLowerCase();
  var c1 = str.charAt(0);
  var c2 = str.charAt(7); 
  var c3 = str.charAt(8);
  
  if(n!=9 || (c1!='b' && c1!='m' && c1!='p') || c2!='c' || c3!='s')
  {
    alert("Please enter valid reg-number");
    return false;
  }

  var y=document.forms["myForm1"]["email"].value;
var atpos=y.indexOf("@");
var dotpos=y.lastIndexOf("@nitc.ac.in");
if (y==null || y=="")
  {
  alert("please enter mail-id");
  return false;
  }
if (atpos<1 || dotpos+11!=y.length)
  {
  alert("Invalid:specify nitc mail address");
  return false;
  }
   var prg=document.forms["myForm1"]["programme"].value;
  if (prg==null || prg=="")
  {
  alert("programme field can't be empty");
  return false;
  }
  var r=document.forms["myForm1"]["field"].value;
if (r==null || r=="")
  {
  alert("Research area can't be empty");
  return false;
  }
  var k=document.forms["myForm1"]["keywords"].value;
if (k==null || k=="")
  {
  alert("Please enter keywords");
  return false;
  }
  var a=document.forms["myForm1"]["abstract"].value;
if (a==null || a=="")
  {
  alert("Abstract can't be empty");
  return false;
}
  var f=document.forms["myForm1"]["file"].value;
if (f==null || f=="")
  {
  alert("Please choose a pdf file");
  return false;
  }  
  var allowed_extensions = "pdf";
    var file_extension = f.split('.').pop(); 
    if(allowed_extensions!=file_extension)
        {
            alert("Please upload a pdf file");
            return false;
        }
}
</script>

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
 

  <div class="homephp">
    <h3><font color="#8B008B">Submit Technical Report</font></h3>
     
    <div class="form">
    <form action="emailtoeditor.php" name="myForm1" onsubmit="return validateForm1();" method="post" enctype="multipart/form-data"> 
    <br/>  
  <?php
    $un = $_SESSION['user'];
    $secnt = mysqli_query($con,"select * from author where username='$un'");
    $res = mysqli_fetch_array($secnt);
    $a = $res['authorname'];
    $r = $res['regno'];
    $e = $res['emailid'];
  ?>
       
  <b>Title of Publication</b><br/><br/> <input type="text" name="title" style="width: 280px;"><br/><br/>
  <b> Name of Author</b><br/><br/> <input type="text" style="width: 280px;" name="name"><br/><br/>
  <b> Registration Number </b><br/><br/><input type="text" name="regno"><br/><br/>
     <b>Email</b><br/><br/> <input type="text" style="width: 280px;" name="email" ></br><br/>
     <b>Programme</b><br/><br/> <input type="radio" name="programme" value="btech"> BTech &emsp;
                  <input type="radio" name="programme" value="mtech"> MTech  &emsp;
                  <input type="radio" name="programme" value="mca"> MCA     &emsp;
                  <input type="radio" name="programme" value="phd"> PhD    &emsp;
              <br/> <br/>
     <b>Research Area</b><br/><br/><input type = "text" name="field"></br><br/>
     <b>Keywords </b></br><br/><textarea name="keywords" rows="5" columns="10"></textarea><br/><br/>
     <b>Abstract</b><br/><br/><textarea style="width:300px ; height:150px" name="abstract" rows="10" columns="100"></textarea></br><br/>
     <b>UPLOAD REPORT</b><br/><br/>
     <input type="file" id="file" name="fileToUpload"/><br/><br/><br/><br/>
     <button id="but" type="submit" name="submit" value="Submit">Submit</button> 
</form>
</div>
</div>
  
 

</div>
<!--   <div class="footer"><br/><br/> </div> -->
</div>  

</body>
</html>