<?php
include('base.php');
?>


<div>
    <?php if (isset($_SESSION['username'])): ?>
        <p>안녕하세요, <?php echo $_SESSION['name']; ?>님!</p>
    <?php else: ?>
        <p>로그인을 해주세요</p>
    <?php endif; ?>
</div>
</body>
</html>