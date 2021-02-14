<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<head>
<title>Seller Account</title>

<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  td
  {
  	border:none;
  }
  a
  {
  	color: black;
  	text-decoration:underline;
  }

@media screen and (max-width:768px)
{
  #name
  {
    display: none;
  }
  #addsearch
  {
    background-color: rgb(77,166,255);
  }
}
  </style>
</head>
<body>
<?php
require 'titlebar.php';
?>
<?php
if (empty($_SESSION)) 
{
echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}
elseif (!empty($_SESSION)) 
{
$uid=$_SESSION['userid'];
$myname=$_SESSION['firstname'];
$sqla="select * from seller where userid='$uid'";
$resulta=mysqli_query($con,$sqla);
if (mysqli_num_rows($resulta)>0) 
{
?>
<div class="w3-bar w3-border-bottom">
<div class="w3-bar-item">
<img src="sellerprofiles/<?php echo $uid;?>" width='70' height='70' style="border:2px solid rgb(77,166,255);border-radius: 50%;">		
</div>
<div class="w3-bar-item">
<?php
while ($row=mysqli_fetch_assoc($resulta)) 
{
$shopname=$row['shopname'];
$city=$row['city'];
$state=$row['state'];
$stype=$row['shoptype'];
}
echo "<b>$shopname</b><br>";
echo $myname."<br>";
echo "<i class='fa fa-map-marker w3-text-red'></i>$city<br>$state";
?>
</div>
<div class="w3-bar-item">
<button class='w3-padding-small w3-light-grey w3-border-0 w3-round-large w3-hover-gray w3-hover-text-white w3-margin' style="" onclick="document.getElementById('product').style.display='block'"><font size='4'>&#10010;New product</font></button>
</div>
<div class="w3-dropdown-hover w3-bar-item  w3-margin-top">
  <button class="w3-button w3-hover-white w3-light-grey w3-round-xlarge w3-hover-gray w3-hover-text-white">More<i class="fa fa-caret-down"></i></button>
  <div class="w3-dropdown-content w3-bar-block w3-border">
    <a href="orderstoseller.php" class="w3-bar-item w3-button" style="text-decoration:none;">Orders</a>
 <?php
    $countlist=0;
    $checklistnumber="select * from list where sellerid='$uid'";
	$checklistnumberresult=mysqli_query($con,$checklistnumber);
	if (mysqli_num_rows($checklistnumberresult)>0) 
	{	
	 while ($row=mysqli_fetch_assoc($checklistnumberresult)>0) 
	{
		$countlist=$countlist+1;
	}
	$listseen=$countlist;
	}	
    ?>
    <a href="orderlists.php" class="w3-bar-item w3-button" style="text-decoration:none;">Lists</a>
    <a href="whatsapp://send?text=asssail.000webhostapp.com/shopitemsdisplay.php?id=<?php echo $uid;?>" data-action="share/whatsapp/share" class="w3-button w3-round" style="text-decoration:none;">Share<i class="fab fa-whatsapp-square " style='font-size:20px;color:rgb(77,166,255)'></i></a>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-4 col-sm-12 w3-border-right">
<button onclick="openrating('openrating')" class="w3-button w3-hover-light-grey w3-light-grey w3-block w3-white" style="outline:none;">Ratings</button>
<div id="openrating" class="w3-container w3-hide">
<?php
$shoprat="select * from ratings where sellerid='$uid'";
$shopratres=mysqli_query($con,$shoprat);
if(mysqli_num_rows($shopratres)>0)
{
while($row=mysqli_fetch_assoc($shopratres))
{
  $satisfied=$row['satisfied'];
  $dissatisfied=$row['dissatisfied'];
  $good=$row['good'];
}
?>
<div id="piechart_3d">
</div>
<?php
}
else
{
  echo "<h3>Ratings of this shop is still not available.</h3>";
}
?>
</div>
<div id="product" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container w3-padding">
      <span onclick="document.getElementById('product').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <form action="sellprocess.php" method="post" enctype="multipart/form-data">
      	<?php
        if (@$_GET['itemexist']==true) 
        {
        ?>
        <div class="w3-text w3-light-grey w3-medium">*<?php echo $_GET['itemexist'];?></div>  
        <?php
        }
        ?>
      	<div class="w3-row w3-section">
            Item name<input class="w3-input w3-border " name="iname" type="text" required>
         </div>
         <div class="w3-row w3-section">
           Item Description<input class="w3-input w3-border " name="ides" type="text" required>
         </div>
         <div class="w3-bar">
         	<div class="w3-bar-item">Price<input class="w3-border" name="iprice" type="number" placeholder="price" required oninput='this.value = Math.abs(this.value)'>
         	</div>
            <div class="w3-bar-item">
            <select name="currency" required>
            <option value="Rs." selected>Rupee</option>
            <!--<option value="£">pounds</option>
            <option value="$">dollars</option>-->	
            </select>
            </div>           
            <div class="w3-bar-item">per/
            <select name="per" required>
            <option value="item" selected>item</option>
            <option value="kg">kg</option>
            <option value="dozen">dozen</option>	
            </select>
            </div>           
         </div>
<?php
$totalshopcat=array("grocery","bakery","fruits","vegetables","stationery");
$shoptype=explode(",",$stype);
$result=array_intersect($totalshopcat,$shoptype);
$countresult=count($result);
//echo $shoptype[0];
//echo $shoptype[1];
?>
         <div id="predefined">
         <div class="w3-bar">
         <div class="w3-bar-item">
         	Image
         <select name="items" class="w3-border" id="products">
         <option value="" disabled selected>select</option>
          <?php
         if (in_array("fruits",$shoptype)) 
         {
          echo "fr";
         ?>
         	<option value="apple.jpg">Apple</option>
         	<option value="banana.jfif">Banana</option>
         	<option value="mango.jpg">Mangoes</option>
        <?php
         }
         ?>
          <?php
          if (in_array("grocery",$shoptype))
         {
         ?>
          <option value="onion.jpg">Onions</option>
          <option value="sunflower.jpg">Freedom-Sunflower oil</option>
          <?php
          } 
          ?>
          <?php
          if (in_array("vegetables",$shoptype)) 
         {
         ?>
          <option value="carrot.jpg">Carrot</option>
          <option value="greenchilli.jpg">Greenchillies</option>
          <?php
          } 
          ?>
          <?php
          if (in_array("bakery",$shoptype)) 
         {
         ?>
          <option value="darkchoc.jpg">Dark Choclates</option>
          <?php
          } 
          ?>
         </select>or
         <button type="button" onclick="manauto(2)">Browse</button>
         </div>
         <div class="w3-bar-item">
         	<img src="fruits/camera.png" width="100" height="100" id="productsimage">
         </div>	
         </div>
         </div>
         <script>
         $('#products').change(function()
         {
            if($(this).val() == "apple.jpg")
            {
                document.getElementById('productsimage').src='fruits/apple.jpg';    
            } 
            if($(this).val() == "banana.jfif")
            {
                document.getElementById('productsimage').src='fruits/banana.jfif';    
            } 
            if($(this).val() == "mango.jpg")
            {
                document.getElementById('productsimage').src='fruits/mango.jpg';    
            } 
             if($(this).val() == "onion.jpg")
            {
                document.getElementById('productsimage').src='fruits/'+$(this).val();    
            } 
            if($(this).val() == "sunflower.jpg")
            {
                document.getElementById('productsimage').src='fruits/'+$(this).val();    
            } 
             if($(this).val() == "carrot.jpg")
            {
                document.getElementById('productsimage').src='fruits/'+$(this).val();    
            } 
            if($(this).val() == "greenchilli.jpg")
            {
                document.getElementById('productsimage').src='fruits/'+$(this).val();    
            }
            if($(this).val() == "darkchoc.jpg")
            {
                document.getElementById('productsimage').src='fruits/'+$(this).val();    
            } 
          });
         </script>    
         <div id="manual" style="display:none;">
         <input type="file" name="itemimagemanual"><br><br>or <button type="button" onclick="manauto(1)">choose</button>
         </div><br>
         <input type="text" name="shoptype" class="" value="<?php echo $stype;?>" style="display:none;">
      	<button type="submit" name="sell_upload" class="w3-input w3-button w3-light-grey">Confirm</button>
      </form>
    </div>
  </div>
</div>
<?php
$stock = "SELECT * FROM sellproducts where userid='$uid'";
$stockresult = mysqli_query($con,$stock);
if(!$stockresult) 
{
	echo "error is".mysqli_error($con);
}
?>
<?php
if (mysqli_num_rows($stockresult) > 0) 
{
?>
<div class="w3-padding " style="position:sticky;top:0px;background-color:rgb(77,166,255);">
<center>
<input type="search" id="search" onkeyup="myFunction()" placeholder="Search items" class="w3-border-0">
</center></div><br>
  <table id="myTable" class="w3-table w3-striped w3-border-0">
  <?php
 while ($row=mysqli_fetch_assoc($stockresult)) 
 {
    $itemname=$row['itemtitle'];
  	$itemdes=$row['itemdescription'];
  	$itemprice=$row['itemprice'];
  	$itemper=$row['per'];
  	$itemimage=$row['image'];
  	$currency=$row['itemcurrency'];
 ?>
 <tr>
 	<?php
 	echo "<form action='' method='post'>";
 	echo "<td class='w3-border-0'><img src='fruits/$itemimage' class='' width='60' height='60'></td><td class='w3-border-0'>$itemname<br>$itemprice$currency/$itemper</td><td class='w3-border-0'></td>";
 	echo "</form>";
 	?>
 </tr>
 <?php
 }
 ?>
 </table>
</div>
 <?php
}
else
{
	echo "<div class='w3-large w3-center w3-margin '>No Products Added</div>";
}
?>
</div>
<?php
}
else
{
  echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='sellform.php'>Create a seller account</a></div>";
}
}
?>
<script type="text/javascript">
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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
function manauto(a)
{
if (a==1) {
	document.getElementById('predefined').style.display='block';
	document.getElementById('manual').style.display='none';
}
if (a==2) {
	document.getElementById('predefined').style.display='none';
	document.getElementById('manual').style.display='block';
}
}
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
var dissatisfied=parseInt('<?php echo $dissatisfied; ?>');
var satisfied=parseInt('<?php echo $satisfied; ?>');
var good=parseInt('<?php echo $good; ?>');
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() 
{
  var data = google.visualization.arrayToDataTable([
  ['Type', 'Percentages'],
  ['Good',good],
  ['Dissatisfied',dissatisfied],
  ['Satisfied', satisfied]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Ratings', 'width':300, 'height':250,'is3D':'true'};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
  chart.draw(data, options);
}

function openrating(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>
</body>
</html>