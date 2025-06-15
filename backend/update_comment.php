<?php
// 비밀번호 검증, 수정 처리
require_once 'board_model.php';

$comment_id = $_GET['id'] ?? 0;
$comment_id = intval($comment_id);

$post_id = $_POST['post_id'] ?? 0;
$name = $_POST['name'] ?? '';
$password = $_POST['password'] ?? '';
$content = $_POST['content'] ?? '';

if (!checkCommentPassword($comment_id, $password)) {
    echo "비밀번호가 틀렸습니다.";
    exit;
}

// 수정 실행
$conn = getDBConnection();
$stmt = $conn->prepare("UPDATE comments SET name = ?, content = ? WHERE id = ?");
$stmt->bind_param("ssi", $name, $content, $comment_id);
$stmt->execute();
$stmt->close();
$conn->close();

// 게시글로 리디렉트
header("Location: ../view.php?id=$post_id");
exit;