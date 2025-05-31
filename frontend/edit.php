<?php
// 글 수정 폼
require_once '../backend/board_model.php';

$id = $_GET['id'] ?? 0;
$id = intval($id);  // id를 정수형으로 변환

$post = getPostById($id);

if (!$post) {
    echo "해당 글을 찾을 수 없습니다.";
    exit;
}
?>

<!-- 수정 화면 -->
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 수정</title>
</head>

<body>
    <h2>게시글 수정</h2>
    <!-- 수정 내용을 update.php로 전송 -->
    <form method="post" action="../backend/update.php">
        <!-- hidden : 화면에 표시하지 않고 폼 데이터를 서버로 전송 -->
        <input type="hidden" name="id" value="<?= $post['id'] ?>">

        이름: <input type="text" name="name" value="<?= htmlspecialchars($post['name']) ?>"><br><br>
        비밀번호: <input type="password" name="password" required><br><br>  <!-- 비밀번호는 필수 입력 -->
        제목: <input type="text" name="subject" value="<?= htmlspecialchars($post['subject']) ?>"><br><br>
        내용:<br>
        <textarea name="content" rows="10" cols="60"><?= htmlspecialchars($post['content']) ?></textarea><br><br>

        <input type="submit" value="수정 완료">
    </form>
</body>
</html>