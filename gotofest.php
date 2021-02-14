<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<head>
	<title>GoToFest</title>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
.festprofile
{
	border:2px solid rgb(77,166,255);
	width:70px;
	height:70px;
	border-radius:50%;
}
@media screen and (max-width:1000px)
{
   #festprofile
  {
    height:280px;
  }
}
@media screen and (max-width:600px)
{
  #festprofile
  {
    height:200px;
  }
}
@media screen and (min-width:1000px)
{
   #festprofile
  {
    height:280px;
  }
}
@media screen and (min-width:1000px)
{
#searchdiv
  {
    background-color:#f2f2f2;
  } 
}
@media screen and (max-width:800px)
{
  #searchdiv
  {
    background-color:rgb(77,166,255);
  }
  #name
  {
    display: none;
  }
}
#searchdiv
{
    top:0px;
    position:sticky;
}
/*
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
}*/
</style>
</head>
<body>
<?php
require 'titlebar.php';
if(!empty($_SESSION))
{
?>

<div class="row">
<div class="col-lg-4">
  <?php
$festprofile=$_GET['festprofile'];
  ?>
<img src="festprofiles/<?php echo $festprofile;?>" style="width: 100%;border:2px solid #f2f2f2;border-top:none;" id='festprofile'>
</div>
<div class="col-lg-8">
<?php
if (empty($_SESSION)) 
{
echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>"; 
}
else
{
$festerid=$_GET['festerid'];
 $festshops="select * from festshopperdetails where festerid='$festerid' and festshopname!='NULL'";
 $festshopsresult=mysqli_query($con,$festshops);
if (mysqli_num_rows($festshopsresult)>0) 
 {
 ?>
<div class="w3-padding w3-medium" id='searchdiv'>
  <center>
<input type="search" class='w3-border-0' id="searchshop" onkeyup="festssshops()" placeholder="Search shops..">
</center></div>
 <table class="table w3-border-0 w3-large" id="myTables">
 <?php
  while ($row=mysqli_fetch_assoc($festshopsresult)) 
  {   
      $festshopname=$row['festshopname'];
      $festshopperid=$row['festshopperid'];
      $festshoppername=$row['festshoppername']; 
      $festerid=$row['festerid'];
      $festshopperphone=$row['festshopperphone'];
      ?>
      <tr class="w3-border-bottom"><form action="eventprocess.php" method='post'>
      <input type="text" name="festerid" value="<?php echo $festerid;?>" style="display: none;">
      <input type="text" name="festshopperid" value="<?php echo $festshopperid;?>" style="display: none;">
      <input type="text" name="festshoppername" value="<?php echo $festshoppername;?>" style="display: none;">
      <input type="text" name="festshopname" value="<?php echo $festshopname;?>" style="display: none;">
      <input type="text" name="festshopperphone" value="<?php echo $festshopperphone;?>" style="display: none;">
      <td><?php echo "<span style='font-family:pristina;' class='w3-xxlarge'>".$festshopname."</span><br>".$festshoppername;?></td><td><button type="submit" class="w3-button  w3-padding-small w3-text-white w3-round" name="festshopperproducts" style="background-color: rgb(77,166,255);">Go</button></td>
      </form></tr>
      <?php     
  }
  ?>
  <!--<i class='fas fa-store-alt w3-text-green'></i>-->
 </table>
<?php
}
}
?>  
</div>
</div>

<?php
}
else
{
  echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}
?>
<script type="text/javascript">

function festssshops() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchshop");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTables");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
</body>
</html>