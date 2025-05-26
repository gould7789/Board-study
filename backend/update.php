<?php
// 수정 처리
require_once 'board_model.php';

// POST 데이터 받기
$id = $_POST['id'] ?? 0;
$name = $_POST['name'] ?? '';
$password = $_POST['password'] ?? '';
$subject = $_POST['subject'] ?? '';
$content = $_POST['content'] ?? '';

$id = intval($id);

// 필수 입력값 체크
if (!$id || !$password || !$name || !$subject || !$content) {
    echo "모든 항목을 입력해주세요.";
    exit;
}

// 수정 실행
$success = updatePost($id, $name, $password, $subject, $content);

if ($success) {
    // 수정 성공 시 상세보기 페이지로 이동
    header("Location: /view.php?id=$id");
    exit;
} else {
    // 수정 실패 시 메시지 출력
    echo "수정에 실패했습니다. 비밀번호를 다시 확인해주세요.";
}
?>
