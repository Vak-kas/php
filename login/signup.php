<?php

require('../databases.php');

$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];


$sql = "INSERT INTO users (name, username, password) VALUES ('$name', '$username', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "
    <script>
            alert('회원가입이 완료되었습니다!');
            window.location.href = '/login/login.html';
    </script>
    ";

} else {
    echo "
    <script>
            alert('회원가입 실패! 다시 시도해주세요.');
            window.location.href = '/index.php'; 
    </script>
    ";
}

$conn->close();

?>