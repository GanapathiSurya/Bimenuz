<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<title>Sell form</title>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
</style>
<body>
<?php
require 'titlebar.php';
?>
<?php
if (!empty($_SESSION)) 
{
  $uid=$_SESSION['userid'];
  $myname=$_SESSION['firstname'];
$dup="select * from seller where userid='$uid'";
 $dupresult=mysqli_query($con,$dup);
 if (mysqli_num_rows($dupresult)>0) 
 {
 $URL="sellaccount.php";
echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
 }
 else
 {
?>

<form action="sellformphp.php" method="post" class="w3-container w3-card-2 w3-light-grey w3-text-black w3-margin w3-center" style="max-width:500px;" enctype="multipart/form-data">
<h3 class="w3-center">Seller account</h3>
<?php
        if (@$_GET['Empty']==true) 
        {
        ?>
        <div class="w3-text  w3-medium w3-text-indigo">
        *<?php echo $_GET['Empty'];?>
        </div>  
        <?php
        }
        ?> 
<?php
        if (@$_GET['profileerror']==true) 
        {
        ?>
        <div class="w3-text  w3-medium w3-text-indigo">
        *<?php echo $_GET['profileerror'];?>
        </div>  
        <?php
        }
        ?> 
<?php
        if (@$_GET['error']==true) 
        {
        ?>
        <div class="w3-text  w3-medium w3-text-indigo">
        *<?php echo $_GET['error'];?>
        </div>  
        <?php
        }
        ?> 
<?php
        if (@$_GET['accountexist']==true) 
        {
        ?>
        <div class="w3-text w3-medium  w3-padding" style="background-color:rgb(77,166,255);color: midnightblue;">
        *<?php echo $_GET['accountexist'];?><button class="w3-white w3-round w3-padding-small w3-border-0"><a style="text-decoration: none;" href="sellaccount.php">Go to Shop</a></button>
        </div>  
        <?php
        }
        ?>   
<!--<div class="w3-row w3-section w3-center">
    <div class="w3-rest">
      <input class="w3-input w3-border" name="sfirst" type="text" placeholder="First Name">
    </div>
</div>

<div class="w3-row w3-section">
    <div class="w3-rest">
      <input class="w3-input w3-border" name="slast" type="text" placeholder="Last Name">
    </div>
</div>

<div class="w3-row w3-section">
    <div class="w3-rest">
      <input class="w3-input w3-border" name="semail" type="text" placeholder="Email">
    </div>
</div>

<div class="w3-row w3-section">
    <div class="w3-rest">
      <input class="w3-input w3-border" name="sphone" type="text" placeholder="Phone">
    </div>
</div>-->

<div class="w3-row w3-section">
    <div class="w3-rest">
      <input class="w3-input w3-border" name="sshopn" type="text" placeholder="Shop name" value="<?php echo isset($_POST["sshopn"]) ?$_POST["sshopn"] : ''; ?>">
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-dropdown-hover">
    <button class="w3-button w3-white" type="button">What do you sell?<i class="fas fa-caret-down"></i></button>
    <div class="w3-dropdown-content w3-bar-block w3-card">
      <table>
        <tr>
          <td><input type="checkbox" name="sell_type[]" value="bakery"></td><td>Bakery</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="sell_type[]" value="fruits"></td><td>Fruits</td>
        </tr>
      <tr>
          <td><input type="checkbox" name="sell_type[]" value="grocery"></td><td>Grocery</td>
        </tr>
      <tr>
          <td><input type="checkbox" name="sell_type[]" value="vegetables"></td><td>
    Vegetables</td>
        </tr>
      <tr>
          <td><input type="checkbox" name="sell_type[]" value="stationery"></td><td>Stationery</td>
        </tr>
      </table>
    </div>
  </div><br>
<!-- <b> Don't worry, you can change the above(Shop Category) options at any time..</b>-->
</div>
<!--
<div class="w3-row w3-section">
  <select class="w3-select w3-border " type="text" name="stype">
      <option value="" selected disabled>Shop Category</option>
      <option value="bakery">Bakery</option>
      <option value="fruits">Fruits</option>
      <option value="grocery">Grocery</option>
      <option value="medicines">Medicine</option>
      <option value="milkdiary">Milk Diary</option>
      <option value="vegetables">Vegetables</option>
    </select>
</div>
-->
<div class="w3-row-padding">
  <div class="w3-third">
    <input class="w3-input w3-border" type="text" placeholder="city" name="scity" value="<?php echo isset($_POST["scity"]) ? htmlentities($_POST["scity"]) : ''; ?>">
  </div>
  <div class="w3-third">
    <input type="text" class='w3-input w3-border' name="scountry" placeholder="country" value="<?php echo isset($_POST["scountry"]) ? htmlentities($_POST["scountry"]) : ''; ?>">
  </div>
  <div class="w3-third">
    <input type="text" class='w3-input w3-border' name="sstate" placeholder="state" value="<?php echo isset($_POST["sstate"]) ? htmlentities($_POST["sstate"]) : ''; ?>">
  </div>
</div><br>
<div class="w3-row w3-section">
    <div class="w3-rest">
      <textarea class="w3-input w3-border" name="saddress" type="text" placeholder="Address"><?php echo isset($_POST["saddress"]) ? htmlentities($_POST["saddress"]) : ''; ?></textarea>
    </div>
</div>

<div class="w3-row w3-section">
    <div class="w3-rest">
      <input class="w3-input w3-border" name="phonepegooglepay" type="text" placeholder="Phonepe or Googlepay" value="<?php echo isset($_POST["phonepegooglepay"]) ?$_POST["phonepegooglepay"] : ''; ?>">
    </div>
</div>
<div class="w3-row w3-section w3-white w3-border">
 
    <div class="w3-rest"> Profile
      <input type="file"  class="w3-padding" name="profile" placeholder="profile">
    </div>
</div>
<button type="submit" value="Confirm details" class=" w3-gray w3-section  w3-ripple w3-padding w3-round-xlarge w3-hover-white w3-text-white w3-border-0" name="sell_submit">
Confirm details</button>
</form>

<?php
 }
}
else
{
  echo "<div class='w3-panel w3-padding w3-pale-red w3-border-red w3-leftbar'>please <a href='loginpage.php'>login</a> or <a href='registerpage.php'>signup</a></div>";
}
?>
</body>
</html> 
