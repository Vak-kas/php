<?php
session_start();
session_unset();  // 모든 세션 변수 삭제
session_destroy();


header("Location: /index.php");
exit();
?>
