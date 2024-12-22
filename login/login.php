<?php

require('../databases.php');

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();  // 사용자의 데이터 가져오기

    if($user['password'] == $password){
        session_start();
        $_SESSION['username'] = $user['username'];
        $_SESSION['name'] = $user['name'];   

        echo "
        <script>
            alert('로그인 성공!');
            window.location.href = '/index.php';
        </script>
        ";
    }
    else{
        echo "
        <script>
            alert('비밀번호가 일치하지 않습니다. 다시 시도해주세요.');
            window.location.href = '/login/login.html';
        </script>
        ";

    }
}
else{
    echo "
    <script>
        alert('존재하지 않는 아이디입니다. 다시 시도해주세요.');
        window.location.href = 'login.html';
    </script>
    ";

}


$conn->close();

?>