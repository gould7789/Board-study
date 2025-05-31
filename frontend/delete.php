<?php
// 글 삭제 폼 : 삭제 전에 사용자에게 비밀번호 입력 요청
$id = $_GET['id'] ?? 0;
$id = intval($id);
$error = $_GET['error'] ?? '';  // 비밀번호 오류 확인. 있다면 '1'로 전달됨
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

    <!-- 비밀번호가 틀렸을 때 오류 메시지 출력 -->
    <?php if ($error === '1'): ?>
        <p style="color: red;">비밀번호가 틀리거나 삭제할 수 없습니다.</p>
    <?php endif; ?>

    <!-- 비밀번호 입력 폼 -->
    <form method="post" action="../backend/delete.php?id=<?= $id ?>">
        비밀번호 확인: <input type="password" name="password" required>
        <input type="submit" value="삭제하기">
    </form>

    <br>
    <!-- 취소 버튼으로 해당 글의 상세 페이지로 돌아감 -->
    <a href="view.php?id=<?= $id ?>">취소</a>
</body>
</html>