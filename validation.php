<?php
if(isset($_POST["formtype"])){
require("database.php");
if($_POST["formtype"] == "login_form"){

//USING OOPS CONCEPT
class Credentials{
public $uname;
public $upssd;
function __construct($uname, $upssd){
$this->loginname = $uname;
$this->loginpassword = $upssd;
}
function __destruct(){
if($this->loginname == "" || $this->loginpassword == ""){
echo "Notice: All fields are mandatory";
return 1;
}
require("database.php");
$sql = "SELECT * FROM QuntumCredentials WHERE email = '$this->loginname' AND pssd = '$this->loginpassword'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

    //GENERATE RANDOM CODE AND USE IT AS SESSION AUTH CODE

//function randomNumber($n) {
//$generator = "1357902468";
//$result = "";
//for ($i = 1; $i <= $n; $i++) {
//$result .= substr($generator, (rand()%(strlen($generator))), 1);}
//return $result;}
//$n = 6;
//$randomno = (randomNumber($n));
//$update = "UPDATE QuantumCredentials SET auth='$randomno' WHERE email = '$this->loginname'";
//mysqli_query($conn, $update);
session_start();
$_SESSION["auth_email"] = "$this->loginname";
echo "LoggedIn";
return 1;
}else{
echo "Notice: Credentials Unfound";
}
}
}
new Credentials(''.$_POST["email"].'', ''.$_POST["pssd"].'');
}


//IF FORM TYPE IS RELATED TO LOGOUT
if ($_POST["formtype"] == "logout"){
session_start();
unset($_SESSION['auth_email']);
echo "logout";
return 1;
}

//IF FORM TYPE IS RELATED TO COMPANY
if ($_POST["formtype"] == "company_db"){
$cname = $_POST["cname"];  $email = $_POST["email"]; $website = $_POST["website"];
if ($cname == "" || $email == ""){
echo "Notice: Mandatory company name and email";
return 1;
}
$sql = "INSERT INTO companydb (company, email, logo, website)
VALUES ('$cname', '$email', '', '$website')";
mysqli_query($conn, $sql);
echo "New Company added";
return 1;
}

//IF FORM TYPE IS RELATED TO EMPLOYEE
if ($_POST["formtype"] == "employee_db"){
$cname = $_POST["cname"];  $fname = $_POST["fname"];
$email = $_POST["email"]; $contact = $_POST["contact"];
$lname = $_POST["lname"];
if ($cname == "0" || $fname == "" || $lname == "" || $email == "" || $contact == ""){
echo "Notice: Mandatory company name and email";
return 1;
}
$sql = "INSERT INTO employeedb (companyid, fname, lname, email, contact)
VALUES ('$cname', '$fname', '$lname', '$email', '$contact')";
mysqli_query($conn, $sql);
echo "New Employee added";
return 1;
}


//IF FORM TYPE IS RELATED TO DISTANCE
if($_POST["formtype"] == "distance"){
$flatitude = $_POST["flat"];  $flongitude = $_POST["flong"];
$tlatitude = $_POST["tlat"];  $tlongitude = $_POST["tlong"];
function distance($lat1, $lon1, $lat2, $lon2, $unit) {
if (($lat1 == $lat2) && ($lon1 == $lon2)) {
return 0;
}
else {
$theta = $lon1 - $lon2;
$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
$dist = acos($dist);
$dist = rad2deg($dist);
$miles = $dist * 60 * 1.1515;
$unit = strtoupper($unit);

if ($unit == "K") {
return ($miles * 1.609344);
} else if ($unit == "N") {
return ($miles * 0.8684);
} else {
return $miles;
}
}
}
echo distance($flatitude, $flongitude, $tlatitude, $tlongitude, "K") . " Kilometers<br>";
return 1;
}
if($_POST["formtype"] == "deletion"){
foreach($_POST['delete'] as $deleteid){

$deleteUser = "DELETE from employeedb WHERE id=".$deleteid;
mysqli_query($conn,$deleteUser);
echo "Records deleted";
return 1;
}
}
}else{
echo "Notice: Direct access not allowed";
return 1;
}
?>

