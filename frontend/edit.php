<?php
// 글 수정 폼
require_once '../backend/board_model.php';

$id = $_GET['id'] ?? 0;
$id = intval($id);

$post = getPostById($id);

if (!$post) {
    echo "해당 글을 찾을 수 없습니다.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 수정</title>
</head>

<body>
    <h2>게시글 수정</h2>

    <form method="post" action="../backend/update.php">
        <input type="hidden" name="id" value="<?= $post['id'] ?>">

        이름: <input type="text" name="name" value="<?= htmlspecialchars($post['name']) ?>"><br><br>
        비밀번호: <input type="password" name="password" required><br><br>
        제목: <input type="text" name="subject" value="<?= htmlspecialchars($post['subject']) ?>"><br><br>
        내용:<br>
        <textarea name="content" rows="10" cols="60"><?= htmlspecialchars($post['content']) ?></textarea><br><br>

        <input type="submit" value="수정 완료">
    </form>
</body>
</html>