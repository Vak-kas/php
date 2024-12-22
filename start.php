<!-- <?php
$servername = "localhost";
$username = "root";
$password = "11111111";
$dbname = "knockon";

// MySQL 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// users 테이블 생성
$create_users = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);";

// posts 테이블 생성
$create_posts = "CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    view_count INT DEFAULT 0,
    attachment VARCHAR(255),
    FOREIGN KEY (author) REFERENCES users(username)
);";

// 쿼리 실행
if ($conn->query($create_users) === TRUE) {
    echo "users 테이블이 생성되었습니다.<br>";
} else {
    echo "Error creating users table: " . $conn->error . "<br>";
}

if ($conn->query($create_posts) === TRUE) {
    echo "posts 테이블이 생성되었습니다.<br>";
} else {
    echo "Error creating posts table: " . $conn->error . "<br>";
}

// 연결 종료
$conn->close();
?> -->
