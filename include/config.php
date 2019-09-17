<?php
$host = 'localhost';
$username ='root';
$password = '';
$DB_name = 'bo_db';

$conn = mysqli_connect($host,$username,$password,$DB_name);

if (!$conn)
{
	echo mysqli_connect_error("Error Connection").mysqli_connect_error();

}
function close_db()

{
	global $conn;
	mysqli_close($conn);
	
}

?>