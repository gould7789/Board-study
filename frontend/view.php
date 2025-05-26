<?php
// 글 상세 보기

require_once '../backend/board_model.php';

$id = $_GET['id'] ?? 0;
$id = intval($id);

$post = getPostById($id);

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
    <p><strong>작성자:</strong> <?= htmlspecialchars($post['name']) ?></p>
    <p><strong>작성일:</strong> <?= $post['created_at'] ?></p>
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>

    <br>
    <a href="edit.php?id=<?= $post['id'] ?>"><button>수정</button></a>
    <a href="delete.php?id=<?= $post['id'] ?>" onclick="return confirm('정말 삭제하시겠습니까?');">
        <button>삭제</button>
    </a>
    <br><br>
    <a href="board_login.php">돌아가기</a>
</body>
</html>

