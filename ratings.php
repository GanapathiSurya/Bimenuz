<!DOCTYPE html>
<html lang="en-US">
<?php
if(!empty($_SESSION))
{
$uid=$_SESSION['userid'];
$myname=$_SESSION['firstname'];
}
$con=mysqli_connect("localhost","root","","bimenuz");
if (!$con) 
{
  die("Connection failed".mysqli_error());
} 
?>
<body>
<?php
if(!empty($_SESSION))
{

$sellerid=$_GET['id'];
$shoprat="select * from ratings where sellerid='$sellerid'";
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
<div id="piechart"></div>
<?php
}
else
{
  echo "<h3>Ratings of this shop is still not available.</h3>";
}   
}
else
{
echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
var dissatisfied=parseInt('<?php echo $dissatisfied; ?>');
var satisfied=parseInt('<?php echo $satisfied; ?>');
var good=parseInt('<?php echo $good; ?>');
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Type', 'Percentages'],
  ['Good',good],
  ['Dissatisfied',1],
  ['Satisfied', satisfied]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Ratings', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>

</body>
</html>
