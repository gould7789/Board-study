<?php
// 실제 삭제 처리
require_once 'board_model.php';

$id = $_GET['id'] ?? 0;
$id = intval($id);
$password = $_POST['password'] ?? '';

if (deletePost($id, $password)) {
    header("Location: ../board_login.php");
    exit;
} else {
    // 삭제 실패시 다시 프론트로 보내서 에러 표시
    header("Location: ../delete.php?id=$id&error=1");
}