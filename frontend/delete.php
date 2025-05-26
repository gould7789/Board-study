<?php
// 글 삭제 폼
$id = $_GET['id'] ?? 0;
$id = intval($id);
$error = $_GET['error'] ?? '';
?>


<!DOCTYPE html>
<!-- 사용자에게 비밀번호를 입력 받음 -->
<html>
<head>
    <meta charset="UTF-8">
    <title>게시글 삭제</title>
</head>

<body>
    <h2>게시판 > 게시글 삭제</h2>

    <?php if ($error === '1'): ?>
        <p style="color: red;">비밀번호가 틀리거나 삭제할 수 없습니다.</p>
    <?php endif; ?>

    <form method="post" action="../backend/delete.php?id=<?= $id ?>">
        비밀번호 확인: <input type="password" name="password" required>
        <input type="submit" value="삭제하기">
    </form>

    <br>
    <a href="view.php?id=<?= $id ?>">취소</a>
</body>
</html>