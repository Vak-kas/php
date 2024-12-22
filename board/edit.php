<?php
// session_start();
require('../databases.php'); 
include('../base.php');
?>

<?php
$post_id = isset($_GET['id']) ? $_GET['id'] : 0;
$sql = "SELECT * FROM posts WHERE id = $post_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    echo "<script>alert('존재하지 않는 게시글입니다.'); window.location.href = '/board/board.php';</script>";
    exit();
}
?>



<link rel="stylesheet" type="text/css" href="/static/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="write.css">

<div class="container">
    <h2 class="my-3">게시글 수정</h2>
    <form action="edit_process.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        
        <div class="mb-3">
            <label for="title" class="form-label"><h5>제목</h5></label>
            <input type="text" class="form-control" name="title" id="title" value="<?php echo $post['title']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="content" class="form-label"><h5>내용</h5></label>
            <textarea class="form-control" name="content" id="content" rows="10" required><?php echo $post['content']; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="attachment" class="form-label"><h5>첨부파일</h5></label>
            <input type="file" class="form-control" name="attachment" id="attachment">
            <?php 
                // 파일 이름을 추출
                $file_name = basename($post['attachment']); 
            ?>
            <?php if ($post['attachment']): ?>
                <p>현재 첨부파일: <a href="<?php echo $post['attachment']; ?>" download><?php echo $file_name; ?> 다운로드</a></p>
            <?php endif; ?>
        </div>
        <div>
    </div>

        <button type="submit" class="btn btn-primary">수정하기</button>
    </form>
</div>

</body>
</html>

<?php
$conn->close();
?>
