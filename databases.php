<?php
$servername = "localhost";
$username = "root";
$password = "11111111";
$dbname = "knockon";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// else{
//     echo "데이터베이스 연결 성공";
// }

?>
