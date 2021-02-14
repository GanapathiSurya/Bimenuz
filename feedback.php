<!DOCTYPE html>
<html>
<?php
if(!empty($_SESSION))
{
$uid=$_SESSION['userid'];
$myname=$_SESSION['firstname'];
}
?>
<head>
	<title>Feedback</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="w3-large" onLoad="noBack();" onpageshow="if (event.persisted) noBack();"><br>
<?php
if(!empty($_SESSION))
{
$sellerid=$_GET['sellerid'];
$sno=$_GET['sno'];
?>
<center><h3>Please Rate the product<i class="fa fa-star w3-text-yellow"></i></h3>
<form action="feedbackprocess.php" method="post" autocomplete="off">
	<input type="text" name="sellerid" value="<?php echo $sellerid;?>" style="display: none;">
<input type="text" name="sno" value="<?php echo $sno;?>" style="display: none;">
<button class="w3-button w3-padding w3-red w3-margin-bottom w3-round"  type="submit" name="feedback" value="dissatisfied">Not Satisfied</button><br>
<button class="w3-button w3-padding w3-amber  w3-margin-bottom w3-round" type="submit" name="feedback" value="satisfied">Satisfied</button><br>
<button class="w3-button w3-padding w3-green  w3-margin-bottom w3-round" type="submit" name="feedback" value="good">Good</button><br>
</form></center>
<?php
}
else
{
 echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}
?>
<script type="text/javascript">
        window.history.forward();
        function noBack()
        {
            window.history.forward();
        }
</script>
</body>
</html>