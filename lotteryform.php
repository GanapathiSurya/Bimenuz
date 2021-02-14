<!DOCTYPE html>
<html>
<head>
	<title>Lottery  form page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <link rel="stylesheet" type="text/css" href="w3.css">
</head>
<body class="w3-light-grey">
<div class="w3-container " style="max-width:600px;margin:auto;">
<table class="w3-table" style="background-color: rgb(77,166,255);">
<thead>
</thead>
<tbody>
<td>
<img src="logo.png" width="50" height="50">
</td>
<td>
<img src="brand.png" width="125" height="55">
</td>
</tbody>	
</table>
<div>
<form action="lotteryprocess.php" enctype="multipart/form-data" method="post" class="w3-container w3-white w3-text-blue ">
<?php
        if (@$_GET['empty']==true) 
        {
        ?>
        <div class="w3-text w3-light-grey w3-medium">*<?php echo $_GET['empty'];?></div>  
        <?php
        }
        ?>
<div class='w3-row w3-section'>
<div class='w3-rest'><input class='w3-input w3-border-0' type='file'  name='userprofile[]'  placeholder='Choose profile' multiple=''></div></div>
<input type="submit" class="w3-button w3-round-xxlarge w3-block w3-hover-blue w3-section  w3-ripple w3-padding" style="background-color: rgb(77,166,255);color:black" name="lottery_form_submit">
<input type="submit" class="w3-button w3-round-xxlarge w3-block w3-hover-blue w3-section  w3-ripple w3-padding" value="delete" style="background-color: rgb(77,166,255);color:black" name="delete">
</form>
      </div>
    </div>
  </div>
</div>
</script>
</body>
</html>