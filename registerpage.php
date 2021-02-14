<!DOCTYPE html>
<html>
<?php
require 'connection.php';
?>
<head>
	<title>Register page</title>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="formvalidation.css">
<style>
input
{
  background-color: #f3f3f3;
  color: black;
}
input.ng-invalid
{
  background-color:#f2f2f2;
}
input.ng-untouched
{
  background-color:#f3f3f3;
}
.spanvalidate
{
  color:red;
}
.span2validate
{
  color: green;
}
form.ng-pristine {

    background-color:white;
}
form.ng-dirty
{
  background-color:white
}
</style>
</head>
<body class="w3-light-grey" ng-app="">
<div class="w3-container " style="max-width:600px;margin:auto;">
<table class="w3-table" style="background-color: rgb(77,166,255);">
<thead>
</thead>
<tbody>
<td>
<img src="logosss.png" width="40" height="50">
</td>
<td>
<img src="brandsss.png" width="110" height="50">
</td>
<td>
Already User?<br><a href="loginpage.php" target="_self">
<span class="w3-text-white">Login</span></a>
</td>
</tbody>	
</table>
<div>
<form action="register.php" enctype="multipart/form-data" method="post" class="w3-container  " name="registerform">
<!--<h2 class="w3-center">Fill Up The Form</h2>-->
 <?php
        if (@$_GET['Empty']==true) 
        {
        ?>
        <div class="w3-text w3-light-grey w3-medium">*<?php echo $_GET['Empty'];?></div>  
        <?php
        }
        ?>
        <?php
        if (@$_GET['invemail']==true) 
        {
        ?>
        <div class="w3-text w3-light-grey w3-medium">*<?php echo $_GET['invemail'];?></div>  
        <?php
        }
         ?> 
         <?php
        if (@$_GET['profileerror']==true) 
        {
        ?>
        <div class="w3-text w3-light-grey w3-medium">*<?php echo $_GET['profileerror'];?></div>  
        <?php
        }
         ?> 
         <?php
        if (@$_GET['error']==true) 
        {
        ?>
        <div class="w3-text w3-light-grey w3-medium">*<?php echo $_GET['error'];?></div>  
        <?php
        }
         ?> 
         <?php
        if (@$_GET['invnum']==true) 
        {
        ?>
        <div class="w3-text w3-light-grey w3-medium">*<?php echo $_GET['invnum'];?></div>  
        <?php
        }
         ?> 
         <?php
        if (@$_GET['invpassword']==true) 
        {
        ?>
        <div class="w3-text w3-light-grey w3-medium">*<?php echo $_GET['invpassword'];?></div>  
        <?php
        }
         ?> 
         <?php
        if (@$_GET['matchpassword']==true) 
        {
        ?>
        <div class="w3-text w3-light-grey w3-medium">*<?php echo $_GET['matchpassword'];?></div>  
        <?php
        }
         ?> 
         <?php
        if (@$_GET['exist']==true) 
        {
        ?>
        <div class="w3-text w3-light-grey w3-medium">*<?php echo $_GET['exist'];?></div>  
        <?php
        }
         ?> 
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-large fas fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border-0 " name="fname" ng-model="fname" type="text" placeholder="First Name" required>
      <span ng-show="registerform.fname.$touched && registerform.fname.$invalid" class="spanvalidate">First Name is Required.</span>
      <span ng-show="registerform.fname.$touched && registerform.fname.$valid" class="span2validate">Success</span>
    </div>
</div>
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-large fas fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border-0" name="lname" ng-model="lname" type="text" placeholder="Last Name" required>
      <span ng-show="registerform.lname.$touched && registerform.lname.$invalid" class="spanvalidate">Last Name is Required.</span>
      <span ng-show="registerform.lname.$touched && registerform.lname.$valid" class="span2validate">Success</span>
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-large fas fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border-0 " name="userid" ng-model="userid" type="text" placeholder="User Id" required>
      <span ng-show="registerform.userid.$touched && registerform.userid.$invalid" class="spanvalidate">Userid is Required.</span>
      <span ng-show="registerform.userid.$touched && registerform.userid.$valid" class="span2validate">Success</span>
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-large fas fa-envelope"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border-0" name="email" type="email" placeholder="Email" ng-model="email" required>
<span  ng-show="registerform.email.$touched && registerform.email.$invalid">
<span ng-show="registerform.email.$error.required" class="spanvalidate">Email is required.</span>
<span ng-show="registerform.email.$error.email" class="spanvalidate">Invalid email address.</span>
</span>
<span ng-show="registerform.email.$touched && registerform.email.$valid" class="span2validate">Success</span>
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-large fas fa-phone"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border-0 w3-light-grey" name="phone" type="text" ng-model="phone" ng-pattern="/^[0-9]{1,10}$/" placeholder="Phone" required>
<span class="spanvalidate" ng-show="registerform.phone.$touched && registerform.phone.$error.required"> Phone number is required</span>
<span class="spanvalidate"  ng-show="registerform.phone.$dirty && registerform.phone.$error.pattern">Only Numbers Allowed, Maximum 10 Characters</span>
<span class="span2validate"  ng-show="registerform.phone.$dirty && !registerform.phone.$error.pattern">Success</span>

    </div>
</div>
<div class="w3-row w3-section">
	<div class="w3-col" style="width:50px;"><i class="w3-large fas fa-key"></i></div>
	<div class="w3-rest">
		<input class="w3-input w3-border-0 w3-light-grey" onfocus="display()" type="password" name="password" placeholder="Password" id="passwordinput">
<p style="display:none;" id="password">
<input type="checkbox" onclick="myFunction()">Show Password
</p>
	</div>
<div class="w3-row w3-section">
	<div class="w3-col" style="width:50px;"><i class="w3-large fas fa-key"></i></div>
	<div class="w3-rest">
	<input class="w3-input w3-border-0 w3-light-grey" type="password"  name="cpassword" placeholder="Confirm Password">
	</div>
</div>
<div class="w3-row w3-section w3-text-black">
	<div class="col">
		<label>Gender</label>
	</div>
	<div class="w3-rest">
		<input type="radio" class="w3-radio" name="gender" value="male">
		<label>Male</label>
		<input type="radio" class="w3-radio" name="gender" value="female">
		<label>Female</label>
	</div>
</div>
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px;"><font class="w3-text-black">Profilepic</font></div><br>
  <div class="w3-rest">
  <input class="w3-input w3-border-0 w3-white" type="file"  name="userprofile"  placeholder="Choose profile">
  </div>
</div>
<input type="submit" class="w3-button w3-block w3-hover-blue w3-section  w3-ripple w3-padding" style="background-color: rgb(77,166,255);color:black" name="submit">
</form>
 
      </div>
    </div>
<script type="text/javascript">

function display()
{
document.getElementById('password').style.display="block";
}
function myFunction() {
  var x = document.getElementById("passwordinput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>
</html>