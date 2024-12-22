<?php
// session_start();
require('../databases.php'); 

// $sql = "SELECT * FROM posts ORDER BY created_at DESC";


include('../base.php');

// 검색 기능 구현
$search_option = isset($_GET['search_option']) ? $_GET['search_option'] : 'title';
$search_term = isset($_GET['search_term']) ? $_GET['search_term'] : '';

// 검색 조건에 따라 SQL 쿼리 설정
if ($search_term) {
    if ($search_option == 'title, content') {
        // 제목과 내용 모두에서 검색
        $sql = "SELECT * FROM posts WHERE title LIKE '%$search_term%' OR content LIKE '%$search_term%' ORDER BY created_at DESC";
    } else {
        // 단일 조건에 대해 검색
        $sql = "SELECT * FROM posts WHERE $search_option LIKE '%$search_term%' ORDER BY created_at DESC";
    }
} else {
    // 검색어가 없으면 모든 글을 가져옴
    $sql = "SELECT * FROM posts ORDER BY created_at DESC";
}
$result = $conn->query($sql);
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
        <form action="board.php" method="get" class="mb-4">
            <div class="row">
                <div class="col-md-2">
                    <select name="search_option" class="form-select">
                        <option value="title" <?php echo ($search_option == 'title') ? 'selected' : ''; ?>>제목</option>
                        <option value="content" <?php echo ($search_option == 'content') ? 'selected' : ''; ?>>내용</option>
                        <option value="title, content" <?php echo ($search_option == 'title, content') ? 'selected' : ''; ?>>제목 + 내용</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" name="search_term" class="form-control" placeholder="검색어" value="<?php echo htmlspecialchars($search_term); ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">검색</button>
                </div>
            </div>
        </form>
    </div>

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