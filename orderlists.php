<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<head>
	<title>Orderlists</title>

<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta charset="utf-8">
  <style type="text/css">
  .main:hover{opacity: 0.6; transition: 4.3s;
      
  }
  .date
  {
  	background-color: rgb(77,166,255);
  	/*border-bottom-right-radius:7%;
  	border-top-right-radius:7%;*/
  }
  
@media screen and (max-width:320px)
{
  #brandsss
{
  width:100px;
  height:40px;
}
#logosss
{
  width:40px;
  height:40px;
}
}
  </style>
</head>
<body class="w3-white">
<?php
require 'connection.php';
require 'titlebar.php';
if(!empty($_SESSION))
{

$myname=$_SESSION['firstname'];
$listorders="select * from list where sellerid='$uid'";
$listordersresult=mysqli_query($con,$listorders);
if (mysqli_num_rows($listordersresult)>0) 
{
    ?>
    <center>
    <?php
	while ($row=mysqli_fetch_assoc($listordersresult)) 
	{
	 $listuploaderid=$row['userid'];
	 $listimage=$row['list'];
	 $listdate=$row['datetime'];
	 $statusbuy=$row['status'];
	 $listdetails="select firstname,phone,datetime from registration,list where registration.userid='$listuploaderid'";
	 $listdetailsresult=mysqli_query($con,$listdetails);
	 while ($row=mysqli_fetch_assoc($listdetailsresult)) 
	 {
	 	$userfirstname=$row['firstname'];
	 	$phone=$row['phone'];
	 }
  if($statusbuy=='notdelivered')
  {
    $buy='<b class="w3-text-red">not delivered.</b>';
  }
  else
  {
    $buy='<b class="w3-text-green">delivered.</b>';
  }
 	echo "<form action='' method='post'>";
 	echo "<table class='w3-table  w3-border-bottom w3-border-left w3-border-right' style='width:300px;'><tr class='w3-border-bottom'><td colspan='2' class='w3-padding'><b>".$listdate."</b></td></tr><tr><td>$userfirstname<br>$phone</td><td class='w3-padding'><img src='lists/$listimage' class='w3-border main' onclick='fullimage(this)' width='120' height='120'><br>$buy</td></tr>";
 	echo "</table>";
 	echo "</form></div>";
	}
?>
</center>
<?php
}
else
{
  echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>No Orders.</div>";
}   
}
else
{
echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";

}
?>
<!--<img src='userprofiles/$userprofile' class='w3-round-xxlarge main' width='50' height='50'>-->
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
</body>
</html>
