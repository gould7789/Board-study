<?php
// 목록 페이지 (홈)
    require_once '../backend/db.php';

    // 검색어 처리
    $search = $_GET['search'] ?? '';
    $conn = getDBConnection();

    if ($search) {
        $sql = "SELECT * FROM board WHERE subject LIKE ? ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $likeSearch = "%$search%";
        $stmt->bind_param("s", $likeSearch);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $sql = "SELECT * FROM board ORDER BY id DESC";
        $result = $conn->query($sql);
    }
?>



<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시판 만들기</title>
</head>

<body>
    <h2>게시판 > 리스트</h2>

    <!-- 검색 폼 -->
    <form method="get" action="board_login.php">
        <label for="search">제목: </label>
        <input type="text" name="search" id="search" value="<?= htmlspecialchars($search) ?>">
        <input type="submit" value="검색">
    </form>

    <!-- 글 목록 -->
    <table border="1">
        <thead>
            <tr>
                <th>번호</th>
                <th>이름</th>
                <th>제목</th>
                <th>작성일</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                $number = $result->num_rows;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $number-- . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";

                    // 제목에 상세보기 링크 추가
                    echo "<td><a href='view.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['subject']) . "</a></td>";

                    echo "<td>" . $row['created_at'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' > 게시글이 없습니다.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <br>
    <a href="write.php"><button>글쓰기</button></a>
</body>
</html>