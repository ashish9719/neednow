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
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];



$sql = "INSERT INTO signup (name, email, password) 
VALUES ('$name', '$email', '$password')";

if($conn->query($sql) === TRUE){
	?>
	<script>
		alert("User Added !!!");
		window.location.href='/neednow/signin/signlog.php';
	</script>
	<?php
	}



else{
	?>
	<script>
		alert("User Already Exists or System Error !!!");
		window.location.href='/neednow/signin/signlog.php';
	</script>
	<?php
	}

}
?>
	





















