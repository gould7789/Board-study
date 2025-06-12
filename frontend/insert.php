<?php
// 작성한 글을 DB에 저장
require_once '../backend/board_model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 값이 없을 경우 빈 문자열로 초기화
    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $content = $_POST['content'] ?? '';

    // 필수 항목 체크
    if ($name && $password && $subject && $content) {

        // 게시글 삽입 함수
        insertPost($name, $password, $subject, $content);
        header("Location: index.php");
        exit;
    } else {
        // 빈 항목 있을시 오류 메시지 출력
        echo "모든 항목을 입력해주세요.";
    }
}
?>