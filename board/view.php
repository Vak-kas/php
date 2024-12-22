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
    $new_view_count = $post['view_count'] + 1;
    $update_sql = "UPDATE posts SET view_count = $new_view_count WHERE id = $post_id";
    $conn->query($update_sql);
} else {
    echo "<script>alert('존재하지 않는 게시글입니다.'); window.location.href = '/board/board.php';</script>";
    exit();
}
?>

<link rel="stylesheet" type="text/css" href="/static/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="write.css">

<div class="container my-3">
    <h5 class="border-bottom py-2"><?php echo $post['title']; ?></h5>
    <div class="card my-3">
        <div class="card-body">
            <div class="card-text" style="white-space: pre-line;"><?php echo nl2br($post['content']); ?></div>
            <div class="d-flex justify-content-end">
                <div class="badge bg-light text-dark p-2">
                    <div class="mb-2">
                        <?php echo $post['author']; ?>
                    </div>
                    <?php echo $post['created_at']; ?>
                </div>
            </div>
        </div>
    </div>
    <div>
        <?php if (!empty($post['attachment'])): ?>
            <h5>첨부파일</h5>
            <?php 
                // 파일 이름을 추출
                $file_name = basename($post['attachment']); 
            ?>
            <a href="<?php echo $post['attachment']; ?>" class="btn btn-link" download="<?php echo $file_name; ?>">
                <?php echo $file_name; ?> 다운로드
            </a>
        <?php else: ?>
            <p>첨부파일이 없습니다.</p>
        <?php endif; ?>
    </div>
    <div>
    <?php if ($post['author'] == $_SESSION['username']): ?>
        <form action="edit.php" method="get" style="display:inline;">
            <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
            <button type="submit" class="btn btn-warning">수정하기</button>
        </form>
        <form action="delete.php" method="post" style="display:inline;">
            <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
            <button type="submit" class="btn btn-danger" onclick="return confirm('정말 삭제하시겠습니까?')">삭제하기</button>
        </form>
    <?php endif; ?>
    </div>
    <br>
    <div>
        <form action="board.php" method="get">
            <button type="submit" class="btn btn-primary">목록으로 돌아가기</button>
        </form>
    </div>
</div>




</body>
</html>

<?php
// 데이터베이스 연결 종료
$conn->close();
?>
