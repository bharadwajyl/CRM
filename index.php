<?php
session_start();
require ("database.php");

$sql_1 = "SELECT * FROM companydb";
$result_1 = mysqli_query($conn, $sql_1);

$sql_2 = "SELECT * FROM employeedb ORDER BY id DESC";
$result_2 = mysqli_query($conn, $sql_2);



if(!isset($_SESSION["auth_email"])){
$session = '';
echo '
<link rel="stylesheet" href="css/main.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<main>
<section>
<form id="login_form">
<h1><em>LogIn</em> Form</h1>
<input type="email" name="email" placeholder="Email address*" maxlength="100" required="">
<input type="password" name="pssd" placeholder="Password*" maxlength="30" required="">
<button class="btn1" onclick="event.preventDefault();ajaxform(0)">LogIn</button> 
</form>
</section>
</main>
<script src="js/main.js"></script>
';
$nav = '';
return 1;
}else{
$session = '<a href="#" class="btn1" onclick="event.preventDefault();ajaxform(1)">LogOut</a>';
$nav = '<span><a href="#"><i class="fa fa-user"></i> '.$_SESSION["auth_email"].'</a></span>';
}
?>

<!DOCTYPE html>
<html>
<head>
<!--TITLE-->
<title>Employee's CRM</title>

<!--SHORTCUT ICON-->
<link rel="shortcut icon" href="images/favicon.ico">

<!--META TAGS-->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>

<!--PLUGIN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!--FONT AWESOME-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--GOOGLE FONTS-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

<!--EXTERNAL STYLE-->
<link rel="stylesheet" href="css/main.css">
</head>
<body id="body">


<!--HEADER-->
<header>
<section>
<span><a href="emailto:support@websitename.com"><i class="fa fa-envelope"></i> Support@websitename.com</a></span>
<span><a href="tel:0000000000"><i class="fa fa-phone"></i> +(0)-xxxx-xx-xxxx</a></span>
</section>
<section>
<?php echo $nav ?>
<span><?php echo $session ?></span>
</section>
</header>

<!--NAVIGATION-->
<nav>
<div class="topnav" id="myTopnav">
<a href="#home" id="logo"><img src="https://i.ibb.co/dj3PD2R/Screenshot-2021-11-06-free-logo-Google-Search-removebg-preview.png" alt=""></a>
<a href="#about">About</a>
<a href="#contact">Contact</a>
<a href="#" id="active">Home</a>
<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="NavBar()">&#9776;</a>
</div>
</nav>

<!--MAIN-->
<main>
<section class="blocks">


<!--VALUES INTO COMPANY & EMPLOYEE DATABASE-->
<div class="flex">
<form id="company_db" >
<h3>Company DB</h3>
<input type="text" name="cname" placeholder="Company name*" maxlength="100" required="">
<input type="email" name="email" placeholder="Email address*" maxlength="100" required="">
<input type="url" name="website" placeholder="Website*" maxlength="150">
<button class="btn1" onclick="event.preventDefault();ajaxform(2);">Submit</button>
</form>
<form id="employee_db">
<h3>Employee DB</h3>
<select name="cname">
<option value="0">Company Name</option>
<?php
if (mysqli_num_rows($result_1) > 0) {
while($row = mysqli_fetch_assoc($result_1)) {
$cname = "".$row["company"]."";
$id = "".$row["id"]."";
echo '<option value="'.$id.'">'.$cname.'</option>';
}
}
?>
</select>
<input type="text" name="fname" placeholder="First name*" maxlength="100" required="">
<input type="text" name="lname" placeholder="Last address*" maxlength="100" required="">
<input type="email" name="email" placeholder="Email address*" maxlength="150" required="">
<input type="tel" name="contact" placeholder="Contact no*" maxlength="15" required="">
<button class="btn1" onclick="event.preventDefault();ajaxform(3);">Submit</button>
</form>
</div>

<!--EMPLOYEE LIST-->
<div>
<form id="employee_list">
<span class="buttons">
<button class="btn1" onclick="event.preventDefault();ajaxform(5)">Delete</button>
<button class="btn1">Update</button>
</span>
<table>
<tr><th>Action</th><th>Employee</th><th>Company</th></tr>
<?php
if (mysqli_num_rows($result_2) > 0) {
while($row = mysqli_fetch_assoc($result_2)) {
$companyid = "".$row["companyid"]."";
$employeeid = "".$row["id"]."";
$sql_3 = "SELECT * FROM companydb WHERE id = $companyid";
$result_3 = mysqli_query($conn, $sql_3);
$fname = "".$row["fname"].""; $lname = "".$row["lname"]."";
$employee = "$fname" . "$lname";
if (mysqli_num_rows($result_3) > 0) {
while($row2 = mysqli_fetch_assoc($result_3)) {
$company = "".$row2["company"]."";
echo'
<tr>
<td><input type="checkbox" name="delete[]" value="'.$employeeid.'"></td>
<td>'.$employee.'</td>
<td>'.$company.'</td>
</tr>
';
}} }
}
?>
</table>
</form>
</div>


<!--DISTANCE CALCULATION USING LAT & LONG-->
<div>
<form id="distance" style="width:95%;">
<div class="flex">
<span>
<h4>From Latitude & Longitude</h4>
<input type="text" name="flat" placeholder="From Latitude*" maxlength="50" required="">
<input type="text" name="flong" maxlength="50" placeholder="From Longitude*" required="">
</span>
<span>
<h4>To Latitude & Longitude</h4>
<input type="text" name="tlat" placeholder="Destination Latitude*" maxlength="50" required="">
<input type="text" name="tlong" maxlength="50" placeholder="Destination Longitude*" required="">
</span>
</div>
<button class="btn1" onclick="event.preventDefault();ajaxform(4);">Find Distance</button>
<p id="distance_result"></p>
</form>
</div>
</section>
</main>

<!--JAVASCRIPT-->
<script src="js/main.js"></script>
</body>
</html>
