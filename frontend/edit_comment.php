<?php
// 사용자가 댓글 수정 요청 시 비밀번호 확인 및 기존 내용 확인
require_once '../backend/board_model.php';

$comment_id = $_GET['id'] ?? 0;
$comment_id = intval($comment_id);

$comment_id = getCommentById($comment_id);

if (!$comment) {
    echo "댓글이 존재하지 않습니다.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>댓글 수정</title>
</head>
<body>
    <h2>댓글 수정</h2>

    <form method="post" action="../backend/update_comment.php?id=<?= $comment_id ?>" autocomplete="off">
        <input type="hidden" name="post_id" value="<?= $comment['post_id'] ?>">
        이름: <input type="text" name="name" value="<?= $comment['name'] ?>" required><br>
        비밀번호: <input type="password" name="password" required><br>
        내용:<br>
        <textarea name="content" rows="4" cols="50" required><?= $comment['comment'] ?></textarea><br>
        <input type="submit" value="수정하기">
    </form>

    <br>
    <a href="view.php?id=<?= $comment['post_id'] ?>">취소</a>
</body>
</html>