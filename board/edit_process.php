<?php
session_start();
require('../databases.php'); 

if (!isset($_SESSION['username'])) {
    header("Location: /login/login.html");
    exit();
}

$post_id = isset($_POST['id']) ? $_POST['id'] : 0;
$title = $_POST['title'];
$content = $_POST['content'];
$attachment = null;

if (empty($title) || empty($content)) {
    echo "<script>alert('제목과 내용은 필수 항목입니다.'); window.location.href = 'edit.php?id=$post_id';</script>";
    exit();
}

// 첨부파일 처리
if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
    $upload_dir = '../uploads/board/';
    $file_name = basename($_FILES['attachment']['name']);
    $timestamp = time();
    $new_file_name = $file_name . "_" . $timestamp ;
    $file_path = $upload_dir . $new_file_name;

    if (move_uploaded_file($_FILES['attachment']['tmp_name'], $file_path)) {
        $attachment = $file_path;
    } else {
        echo "<script>alert('파일 업로드에 실패했습니다.'); window.location.href = 'edit.php?id=$post_id';</script>";
        exit();
    }
}
$update_sql = "UPDATE posts SET title = '$title', content = '$content', attachment = '$attachment' WHERE id = $post_id AND author = '" . $_SESSION['username'] . "'";

if ($conn->query($update_sql) === TRUE) {
    echo "<script>
            alert('게시글이 수정되었습니다.');
            window.location.href = 'view.php?id=$post_id';
          </script>";
} else {
    echo "<script>
            alert('게시글 수정에 실패했습니다. 다시 시도해주세요.');
            window.location.href = 'edit.php?id=$post_id';
          </script>";
}

$conn->close();
?>
