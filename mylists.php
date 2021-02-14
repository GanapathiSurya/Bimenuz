<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<head>
	<title>Mylists</title>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  .main:hover{opacity: 0.6; transition: 4.3s}
  .date
  {
  	background-color: rgb(77,166,255);
  	/*border-bottom-right-radius:7%;
  	border-top-right-radius:7%;*/
  }
  a
  {
    text-decoration: underline;
  }
  </style>
</head>
<body class="w3-white">
  <?php
  require 'titlebar.php';
  ?>
<?php
if(!empty($_SESSION))
{
$uid=$_SESSION['userid'];
$myname=$_SESSION['firstname'];
$listorders="select * from list where userid='$uid'";
$listordersresult=mysqli_query($con,$listorders);
if (mysqli_num_rows($listordersresult)>0) 
{
    ?>
    <center>
    <?php
  while ($row=mysqli_fetch_assoc($listordersresult)) 
  {
   $listreceiverid=$row['sellerid'];
   $listimage=$row['list'];
   $listdate=$row['datetime'];
    $statusbuy=$row['status'];
   $listdetails="select shopname,fname,profile,datetime from seller,list where seller.userid='$listreceiverid'";
   $listdetailsresult=mysqli_query($con,$listdetails);
   if(!$listdetailsresult)
   {
    echo mysqli_error($con);
   }
   while ($row=mysqli_fetch_assoc($listdetailsresult)) 
   {
    $sellershopname=$row['shopname'];
    $sellerfirstname=$row['fname'];
    $sellerprofile=$row['profile'];
   } 
  if($statusbuy=='notdelivered')
  {
    $buy='yes';
  }
  else
  {
    $buy='delivered';
  }
  echo "<form action='uploadlist.php' method='post'>";
  echo "<input type='text' name='orderlistdate' style='display: none;' value='$listdate'>";
  echo "<table class='w3-table w3-border-left w3-border-right' style='width:250px;'>";
  echo "<tr class='w3-border-bottom'><td colspan='2'><b class='w3-padding '>".$listdate."</b></td></tr>";
  echo "<tr class='w3-border-0'>";
  echo "<td>$sellershopname<br>$sellerfirstname</td><td class='w3-padding'><img src='lists/$listimage' class='w3-border main' width='100' height='100' onclick='fullimage(this)'></td>";
  echo "</tr>";
  echo "<tr class='w3-border-bottom'><td colspan='2'>Delivered? <button type='submit'  class='w3-button w3-round w3-margin-left w3-green w3-text-white w3-padding-small' name='yes_list'>$buy</button></td></tr>";
  echo "</table>";
  echo "</form>";
  }
 ?>
 </center>
 <?php
}
else
{
echo "<div class='w3-pale-red w3-panel w3-large w3-padding w3-margin w3-leftbar w3-border-red'>No lists Yet.</div>";
}
}//empty
else
{
  echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}    
?>

  <div id="modal01" class="w3-modal w3-black" style="padding-top:0" onclick="this.style.display='none'">
    <span class="w3-button w3-black w3-xlarge w3-display-topright">×</span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
      <img id="img01" class="w3-image">
      <p id="caption"></p>
    </div>
  </div>
<script type="text/javascript">
function fullimage(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}

</script>
<!--<img src='sellerprofiles/$sellerprofile' class='w3-round-xxlarge w3-button' width='50' height='50'><br>-->
</body>
</html>
