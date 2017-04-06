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
  <link rel="stylesheet" href="styles/template.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <script>
function validateForm1()
{
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
</head>

<body>
<div style="height:100%;background-color:#D3D3D3;">
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
      <font size='5%'><a style="color:white;" href="logout.php">logout</a></font>
    </div>
   </div>
   <div class="homephp">
   <h3><font color="#8B008B">Download Header Page here</font></h3>
   <b><a href="merge.php?id=<?php echo $_GET['id']; ?>" target="_blank" style="color:black;  font-size:15px;">Click here to Download</a></b><br/><br/>

  <?php 
    $id = $_GET['id'];
    $queres = mysqli_query($con,"select * from techreport where reportid='$id'");
    if($re = mysqli_fetch_array($queres))
      $path = $re['reportpath'];  
    ?>
   <h3><font color="#8B008B">Download Technical Report here</font></h3>
   <a href='<?php echo $path; ?>' target="_blank" style="color:black;  font-size:15px;">Click here to download</a><br/><br/>
  
 <h3><font color="#8B008B">Merge the above PDFs</font></h3>
 <a href="http://www.ilovepdf.com/merge_pdf" target="_blank" style="color:black;  font-size:15px;">Merge here</a><br/>
 <br/>
  
  
  <h3><font color="#8B008B">Upload The Downloaded File To Publish</font></h3><br/>
  <form action="" name="myForm1" method="POST" enctype="multipart/form-data"> 
     <input type="file" id="file" name="fileToUpload"/><br/><br/>
    <button id="but" type="submit" name="submit" value="Submit">Submit</button> 
  </form>
 
   </div>

<?php
global $id;
if(isset($_POST["submit"]))
{
  
  $file = $_FILES['fileToUpload'];

$file_name = $file["name"];

$file_temp = $file["tmp_name"];
$file_size = $file["size"];
$file_error = $file["error"];


$file_ext = explode('.',$file_name);
$file_ext = strtolower(end($file_ext));

$allowed = array('pdf');

if(in_array($file_ext, $allowed))
{
  //echo $file_error;
    if($file_error === UPLOAD_ERR_OK)
    {
    // if($file_size < 1000000)
     //{
      $target_dir = "publishedreports/";
      $target_file = $target_dir . basename($file_name); 
      //echo $target_file; 
      if (move_uploaded_file($file_temp, $target_file)) 
       {
        //echo "The file ". basename($file_name). " has been uploaded.";
        echo "<script>alert('uploaded successfully');</script>";
        $que = mysqli_query($con,"update techreport set status='P',reportpath='$target_file' where reportid='$id'");
        if(mysqli_affected_rows($con)>0)
        {
          echo "<script>alert('Report Published');</script>";
          echo "<script>window.location.href='editorpage.php';</script>";
        }
        else
        {
          echo "<script>alert('error in publishing repo');</script>";
        }
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

?>
  </div>    
 
 <div class="footer"><br/><br/> </div> 
</div>
 </body>
 </html>