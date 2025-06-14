/*
사용자가 댓글 삭제 요청 시
비밀번호 입력 폼을 통해 본인 확인 절차 수행
*/

<?php
// 댓글 삭제 비밀번호 입력 페이지
$comment_id = $_GET['id'] ?? 0;
$comment_id = intval($comment_id);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>댓글 삭제</title>
</head>
<body>
    <h2>댓글 삭제</h2>

    <form method="post" action="../backend/confirm_delete_comment.php?id=<?= $comment_id ?>">
        <label>비밀번호 확인: <input type="password" name="password" required></label><br><br>
        <input type="submit" value="삭제하기">
    </form>

    <br>
    <a href="view.php">취소</a>
</body>
</html>