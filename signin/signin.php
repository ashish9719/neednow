<?php

$servername ="localhost";
$username = "root";
$password = "";
$dbname = "neednow";

$conn = new mysqli($servername, $username, $password, $dbname);


if($conn->connect_error){
	die("connection failed");
}
    if($_SERVER["REQUEST_METHOD"] == "POST") {
$email = $_POST["email"];
$password = $_POST["password"];



$sql = mysqli_query($conn, "SELECT count(*) as total from signup WHERE email = '".$email."' and 
	password = '".$password."'");

$row = mysqli_fetch_array($sql);

if($row["total"] > 0){
	?>
	<script>
		window.location.href='/neednow/home/index.html';
	</script>
	<?php

}
else{
	?>
	<script>
		alert("Invalid Credentials..!!!!!");
		window.location.href='/neednow/signin/signlog.php';
	</script>
	<?php
}

	}
?>