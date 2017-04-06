<!DOCTYPE html>
  <?php include("db.php"); ?>

<html lang="en">
<head>
  <title>CSED Technical Reports</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/home.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div style="height:100%">
<div class="container my-custom-container" style="border-style: ridge;border-color:violet;"> 
 <div class="row" style="height:100px;background-color:purple;">
   <div class="head1 col-sm-2">
  	 <img src="images/1.jpg" class="pull-right" width="85" height="85" alt="logo" style="padding-top:9%;">
   </div>
   <div class="head2 col-sm-10">
     <h3>Department of Computer Science and Engineering</h3>
     <h4><i>National Institute of Technology Calicut </i></h4>
   </div>
 </div>
 <div class="homephp col-sm-9">
  <br/>
 <h3><font color="darkblue">TECH REPORTS PUBLISHED </font></h3><br><br>
    <ul>
   
     <script type="text/javascript">
       var today = new Date();
      var yyyy;
      var year = [];
      var q = "id";
      var p = "Reports published in " ;
       for(var i=1;i<=6;i++)
        {
          yyyy = today.getFullYear();
          year[i] = yyyy;
          document.write("<a href='#t"+i+"'>");
          document.write(p+yyyy);
          document.write("</a>");
          document.write("<br/><br/>");
           today.setFullYear(today.getFullYear() - 1 );
        }
          
        document.write("<a href='#t"+i+"'>");
        document.write("Reports published before "+yyyy);
        document.write("</a>");
        document.write("<br/><br/>");

        var len = year.length;
        var sp = "P";
      </script>

     <?php
      $res =  mysqli_query($con,"select extract(year from curdate()) as year"); 
      if($y = mysqli_fetch_array($res)) 
        $curyear = $y['year'];
      echo "<br/>";echo "<br/>";
      for($i=1;$i<=6;$i++)
      {
      echo "<h4 id='t$i'>Reports Published in $curyear</h4>";
       $getyear = mysqli_query($con,"select * from techreport,author where techreport.authorid = author.authorid and
        year = '$curyear' and status='P'");
       if(!mysqli_num_rows($getyear))
         echo "No reports published";

       while($que = mysqli_fetch_array($getyear))
        {
        echo "<p>".$que['uniqueid'].",&nbsp &nbsp".$que['authorname'].",
           <em>"."&nbsp &nbsp".$que['title']."</em> <a href='".$que['reportpath']."'
           target='_blank' title='View this Tech Report.'> &nbsp PDF</a></p>";
        echo "<br/><br/>";
        }
         echo "<br/><br/>";
         $curyear=$curyear-1;
       }
       $curyear=$curyear+1;
       echo "<h4 id='t$i'>Reports Published before $curyear</h4>";
     ?>

      <?php
       {
        $con=mysqli_connect("localhost","root","password","csedtr");
        $tr = mysqli_query($con,"select * from techreport,author where techreport.authorid = author.authorid 
        and status='P' and year < 2012");
        if(!mysqli_num_rows($tr))
         echo "No reports published";

        while($rt = mysqli_fetch_array($tr))
         {
          echo "<p>NWU-EECS-06-13, <strong>".$rt['authorname']."</strong>
           <em>".$rt['title']."</em> <a href='".$rt['reportpath']."' 
           title='View this Tech Report.'>PDF</a></p>";
          echo "<br/><br/>";
        }
       }
      ?> 
      <br/> <br/> <br/>
   </div>

  <br/><br/><br/>
  <div class="login col-sm-3">    <br/>
    <p>To submit a Technical Report, please signup/login below with valid Supervisor credentials</p>
    <br>
    <a href = "login.php" style=""><button><b>Login/Signup here</b></button></a>
  </div>
 

</div></br>
 <!--  <div class="footer"><br/><br/> </div> -->
</div>  

</body>
</html>