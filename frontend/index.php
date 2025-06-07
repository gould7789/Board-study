<?php
// 목록 페이지 (홈)
require_once '../backend/board_model.php';

// 입력값 처리
$search = $_GET['search'] ?? '';
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = 5; // 한 페이지에 보여줄 게시글 수
$offset = ($page - 1) * $limit; // 건너뛰는 페이지 수

// 총 게시글 수 조회
$totalPosts = getTotalPostCount($search);
$totalPages = ceil($totalPosts / $limit);   // 5개씩 끊어서 페이지 계산

// 현재 페이지에 해당하는 게시글 가져오기
$conn = getDBConnection();
if ($search) {
    // 게시판 테이블에서 모든 글을 가져옴 최근 글이 위로 오게 정렬
    $sql = "SELECT * FROM board WHERE subject LIKE ? ORDER BY id DESC LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $likeSearch = "%$search%";      // 부분 검색
    $stmt->bind_param("sii", $likeSearch, $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
} else {    
    // 검색어가 없을 경우 전체 글을 ID 기준으로 정렬
    $stmt = $conn->prepare("SELECT * FROM board ORDER BY id DESC LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
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
        <input type="text" name="search" id="search" value="<?= $search ?>">
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
            // 최신 글부터 순서대로 정렬
            if ($result && $result->num_rows > 0) {
                $number = $result->num_rows;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $number-- . "</td>";
                    echo "<td>" . $row['name'] . "</td>";

                    // 제목에 상세보기 링크 추가
                    echo "<td><a href='view.php?id=" . $row['id'] . "'>" . $row['subject'] . "</a></td>";

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


    <!-- 페이지네이션 -->
    <div class="pagination">
        <!-- 처음, 이전 버튼 -->
        <?php if ($page > 1): ?>
            <a href="?page=1&search=<?= urlencode($search) ?>">« 처음</a>   <!-- 1페이지로 이동 -->
            <a href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">‹ 이전</a>    <!-- 한 칸 앞 페이지로 이동 -->
        <?php endif; ?>
        
        <!-- 현재 페이지 -->
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page<?= $i ?>$search=<?= urlencode($search) ?>">
                <?= ($i == $page) ? "<strong>$i</strong>" : $i ?>   <!-- 현재 페이지 강조 -->
            </a>
        <?php endfor; ?>
        
        <!-- 다음, 끝 버튼 -->
        <?php if ($page < $totalPages) : ?>
            <a href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">다음 ›</a>    <!-- 다음 페이지 이동 -->
            <a href="?page=<?= $totalPages ?>&search=<? urlencode($search) ?>">끝 »</a>     <!-- 마지막 페이지로 이동 -->
        <?php endif; ?>

    </div>


    <br>
    <a href="write.php"><button>글쓰기</button></a>
</body>
</html>