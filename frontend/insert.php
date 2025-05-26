<?php
// 작성한 글을 DB에 저장
require_once '../backend/board_model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $content = $_POST['content'] ?? '';

    // 필수 항목 체크
    if ($name && $password && $subject && $content) {
        insertPost($name, $password, $subject, $content);
        header("Location: board_login.php");
        exit;
    } else {
        echo "모든 항목을 입력해주세요.";
    }
}
?>