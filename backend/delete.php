<?php
// 비밀번호 확인 후 게시글 삭제 처리
require_once 'board_model.php';

$id = $_GET['id'] ?? 0;
$id = intval($id);
$password = $_POST['password'] ?? '';

// 비밀번호 먼저 확인
if(!checkPassword($id, $password)) {
    header("Location: ../frontend/delete.php?id=$id&error=1"); // 비밀번호가 틀렸을 경우
    exit;
}

if (deletePost($id, $password)) {
    header("Location: ../board_login.php");
    exit;
} else {
    // 삭제 실패시 다시 프론트로 보내서 에러 표시
    header("Location: ../delete.php?id=$id&error=1");
}