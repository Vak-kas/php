<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>홈페이지</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">메인화면</a></li>
            <li><a href="board.php">게시판</a></li>

            <?php if (isset($_SESSION['username'])): ?>
                <li><a href="profile.html">내정보</a></li>
                <li><a href="logout.php">로그아웃</a></li>
            <?php else: ?>
                <li><a href="login.html">로그인</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div>
    <?php if (isset($_SESSION['username'])): ?>
        <p>안녕하세요, <?php echo $_SESSION['name']; ?>님!</p>
    <?php else: ?>
        <p>로그인을 해주세요</p>
    <?php endif; ?>

    </div>
</body>
</html>
