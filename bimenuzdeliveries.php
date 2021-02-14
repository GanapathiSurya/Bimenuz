<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body ng-app="">
<?php
if(!empty($_SESSION))
{
$select="select * from bimenuzdeliveries where userid!='$uid'";
$selectres=mysqli_query($con,$select);
if (mysqli_num_rows($selectres)>0) 
{
?>
<ul class='w3-ul' id="deliverieslist">
<?php
while ($row=mysqli_fetch_assoc($selectres)) 
{
$id=$row['deliveryid'];
$title=$row['title'];
$start=$row['fromlocation'];
$end=$row['tolocation'];
$name=$row['name'];
$ownerid=$row['userid'];
$phone=$row['phone'];
$price=$row['price'];
?>
<li class="w3-border-bottom" style="width:100%;">
<center>
<span class="w3-medium" style="text-transform:uppercase;"><?php echo $title;?></span><br>
<select width="200" class='w3-border w3-white'>
<option disabled selected>Details</option>
<option><?php echo $name;?></option>
<option><?php echo $phone;?></option>
</select>
<table>
<tr>
<td class="w3-padding">
<i class="fas fa-map-marker w3-text-green w3-small"></i>
<br><?php echo $start;?>
</td>
<td class="w3-padding">
<span class="w3-text-brown w3-xxlarge">&#8674;</span>
</td>
<td class="w3-padding">
<i class="fas fa-map-marker-alt w3-text-red  w3-small"></i>
<br><?php echo $end;?>
</td>
</tr>	
</table>
<b style="text-decoration:underline;">Price:</b><?php echo $price."Rs for each";?>
</center>
        <form action="bimenuzdeliverysprocess.php" method="post">
        	<input type="text" class="w3-input" name="title" value="<?php echo $title;?>" style="display: none;">
        	<input type="text" class="w3-input" name="ownerid" value="<?php echo $ownerid;?>" style="display: none;">
        	<input type="text" class="w3-input" name="id" value="<?php echo $id;?>" style='display: none;'>
        	<input type="number" class="w3-input" name="price" value="<?php echo $price;?>" style='display: none;'>
        	How many  you want to be delivered?<br>
        	<input type="number" name="number" placeholder="How many?" value="1" required>
        	<button type="submit" class="w3-button w3-small w3-round w3-margin w3-blue w3-padding-small" name="give_submit">Give</button>
        </form>
</li>
<?php
}
echo "</ul>";
}
else
{
    
echo "<div class='w3-pale-red w3-panel w3-large w3-padding w3-margin w3-leftbar w3-border-red'>No Delivery services Yet.</div>";
}   
}
else
{
  echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}
?>
</body>
</html>