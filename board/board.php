<?php
session_start();
require('../databases.php'); 

$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);

include('../base.php');
?>

<link rel="stylesheet" type="text/css" href="/static/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="board.css">

<div class="container my-3">
    <table class="table">
        <thead>
        <tr class="table-dark">
            <th>번호</th>
            <th>제목</th>
            <th>작성자</th>
            <th>작성일</th>
            <th>조회수</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td>
                        <a href="view.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
                    </td>
                    <td><?php echo $row['author']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td><?php echo $row['view_count']; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">게시글이 없습니다.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <div>
        <?php if (isset($_SESSION['username'])): ?>
            <form action="write.php" method="get">
                <button type="submit" class="btn btn-primary">새 글 작성하기</button>
            </form>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

<?php
// 데이터베이스 연결 종료
$conn->close();
?>