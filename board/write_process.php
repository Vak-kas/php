<?php
session_start();
require('../databases.php');

$title = $_POST['title'];
$content = $_POST['content'];
$author = $_SESSION['username'];
$attachment = null;

// 디버깅을 위한 $_POST와 $_FILES 출력
echo "<pre>";
var_dump($_POST);  // 제목, 내용 등
var_dump($_FILES);  // 첨부파일
echo "</pre>";

// 제목과 내용이 비어 있는지 체크
if (empty($title) || empty($content)) {
    echo "<script>alert('제목과 내용은 필수 항목입니다.'); window.location.href = 'write.php';</script>";
    exit();
}


// 업로드된 파일이 있다면
if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
    $upload_dir = '../uploads/board/'; 
    $file_name = basename($_FILES['attachment']['name']);
    $timestamp = time(); 
    $new_file_name = $timestamp . "_" . $filename;  
    $file_path = $upload_dir . $new_file_name;

    // 파일을 지정된 디렉토리에 저장
    if (move_uploaded_file($_FILES['attachment']['tmp_name'], $file_path)) {
        $attachment = $file_path;  // 파일 경로 저장
    } else {
        echo "<script>alert('파일 업로드에 실패했습니다.'); window.location.href = 'write.php';</script>";
        exit();
    }
}


$sql = "INSERT INTO posts (title, content, author, attachment) VALUES ('$title', '$content', '$author', '$attachment')";


if ($conn->query($sql) === TRUE) {
    echo "
    <script>
        alert('글 작성이 완료되었습니다!');
        window.location.href = '/board/board.php';
    </script>";
} else {
    echo "
    <script>
        alert('글 작성에 실패했습니다. 다시 시도해주세요.');
        window.location.href = '/board/write.php'; 
    </script>";
}

$conn->close();
?>
