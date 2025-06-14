<?php
// 댓글 삽입 처리
require_once 'board_model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'] ?? 0;
    $parent_id = $_POST['parent_id'] ?? null;
    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';
    $content = $_POST['content'] ?? '';

    $post_id = intval($post_id);
    $parent_id = $parent_id !== '' ? intval($parent_id) : null;

    if ($post_id && $name && $password && $content) {
        insertComment($post_id, $parent_id, $name, $password, $content);
    }

    // 삽입 후 해당 게시글 페이지로 이동
    header("Location: ../frontend/view.php?id=$post_id");
    exit;
} else {
    echo "잘못된 접근입니다.";
}