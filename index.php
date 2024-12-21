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
            <!-- 로그인 상태에 따라 다르게 표시 -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="profile.php">내 정보</a></li>
                <li><a href="logout.php">로그아웃</a></li>
            <?php else: ?>
                <li><a href="login.html">로그인</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="main-content">
        <?php if (isset($_SESSION['user_id'])): ?>
            <h1>안녕하세요, <?php echo htmlspecialchars($_SESSION['user_name']); ?>님!</h1>
            <p>로그인 상태입니다. 게시판을 이용하거나 내 정보를 확인할 수 있습니다.</p>
        <?php else: ?>
            <h1>메인화면</h1>
            <p>로그인 후 게시판을 이용할 수 있습니다.</p>
        <?php endif; ?>
    </div>
</body>
</html>
