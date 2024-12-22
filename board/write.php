<?php
// session_start();
require('../databases.php'); 
include('../base.php'); 
?>

<?php
if(!isset($_SESSION['username'])){
    header("Location: /login/login.html");
    exit();
}
?>

<link rel="stylesheet" type="text/css" href="/static/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="write.css">

<div class="container">
    <form action = "write_process.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label"><h5>제목</h5></label>
            <input type="text" class="form-control" name="title" id="title" value="" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label"><h5>내용</h5></label>
            <textarea class="form-control" name="content" id="content" rows="10", required></textarea>
        </div>
        <div class="mb-3">
            <label for="attachment" class="form-label"><h5>첨부파일</h5></label>
            <input type="file" class="form-control" name="attachment" id="attachment">
        </div>
        <button type="submit" class="btn btn-primary">저장하기</button>
    </form>
</div>

</body>
</html>

<?php
// 데이터베이스 연결 종료
$conn->close();
?>
