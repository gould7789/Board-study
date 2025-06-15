<?php
/*
사용자가 입력한 비밀번호가 댓글의 비밀번호와 일치하는지 확인
일치하면 삭제 함수 실행
*/
require_once 'board_model.php';

$comment_id = $_GET['id'] ?? 0;
$comment_id = intval($comment_id);
$password = $_POST['password'] ?? '';

$comment = getCommentById($comment_id);

if (!$comment) {
    echo "댓글이 존재하지 않습니다.";
    exit;
}

$post_id = $comment['post_id'];

if (checkCommentPassword($comment_id, $password)) {
    deleteComment($comment_id);
    header("Location: ../view.php?id=$post_id");
    exit;
} else {
    echo "비밀번호가 틀렸습니다.";
}