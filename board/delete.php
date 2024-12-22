<?php
session_start();
require('../databases.php'); 


if (!isset($_SESSION['username'])) {
    header("Location: /login/login.html");
    exit();
}


$post_id = isset($_POST['id']) ? $_POST['id'] : 0;

if ($post_id > 0) {
    $sql = "DELETE FROM posts WHERE id = $post_id AND author = '" . $_SESSION['username'] . "'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('게시글이 삭제되었습니다.');
                window.location.href = '/board/board.php';
              </script>";
    } else {
        echo "<script>
                alert('게시글 삭제에 실패했습니다. 다시 시도해주세요.');
                window.location.href = '/board/board.php';
              </script>";
    }
} else {
    echo "<script>
            alert('잘못된 요청입니다.');
            window.location.href = '/board/board.php';
          </script>";
}

$conn->close();
?>
