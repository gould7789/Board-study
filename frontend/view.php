<?php
// 글 상세 보기

require_once '../backend/board_model.php';

$id = $_GET['id'] ?? 0;
$id = intval($id);      // id값을 정수로 변환

// 해당 id에 맞는 게시글 조회
$post = getPostById($id);

// 존재하지 않을 경우 오류메시지 출력
if (!$post) {
    echo "해당 글이 존재하지 않습니다.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>게시판 > 상세보기</title>
</head>

<body>
    <h2>게시판 > 상세보기</h2>

    <h3><?= htmlspecialchars($post['subject']) ?></h3>

    <!-- 작성자와 작성일 출력 -->
    <p><strong>작성자:</strong> <?= htmlspecialchars($post['name']) ?></p>
    <p><strong>작성일:</strong> <?= $post['created_at'] ?></p>

    <!-- 본문 출력 -->
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>

    <br>
    <!-- 수정 버튼 -->
    <a href="edit.php?id=<?= $post['id'] ?>"><button>수정</button></a>

    <!-- 삭제 버튼 클릭 시 확인 메시지 출력 -->
    <a href="delete.php?id=<?= $post['id'] ?>" onclick="return confirm('정말 삭제하시겠습니까?');">
        <button>삭제</button>
    </a>
    <br><br>

    <!-- 목록 페이지로 돌아가기 -->
    <a href="board_login.php">돌아가기</a>
</body>
</html>

