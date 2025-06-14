<?php
require_once 'db.php';
// 함수 모음

// 비밀번호 확인 함수
function checkPassword($id, $password) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT * FROM board WHERE id = ? AND password = ?");
    $stmt->bind_param("is", $id, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $match = $result->num_rows > 0;
    $stmt->close();
    $conn->close();
    return $match;
}




// 수정 관련 함수
// 특정 글 가져오기
function getPostById($id) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT * FROM board WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $post;
}

// 게시글 수정 - 비밀번호 확인 후 해당 게시글을 수정
function updatePost($id, $name, $password, $subject, $content) {
    $conn = getDBConnection();

    // 비밀번호 일치 여부 확인
    $stmt = $conn->prepare("SELECT * FROM board WHERE id = ? AND password = ?");
    $stmt->bind_param("is", $id, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $stmt->close();
        $conn->close();
        return false;   // 비밀번호 틀림
    }

    // 수정 쿼리
    $stmt->close();
    $stmt = $conn->prepare("UPDATE board SET name=?, subject=?, content=? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $subject, $content, $id);
    $success = $stmt->execute();

    $stmt->close();
    $conn->close();
    return $success;
}

// 삭제 함수
function deletePost($id, $password) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("DELETE FROM board WHERE id = ? AND password = ?");
    $stmt->bind_param("is", $id, $password);
    $stmt->execute();
    $success = $stmt->affected_rows > 0;
    $stmt->close();
    $conn->close();
    return $success;
}

// 인서트(게시글 삽입) 함수 - 사용자가 작성한 새 게시글을 db에 저장
function insertPost($name, $password, $subject, $content) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("INSERT INTO board (name, password, subject, content) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $password, $subject, $content);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

// 전체 게시글 수 반환 : 전체 게시글 수를 확인하여 페이지 수 반환
function getTotalPostCount($search = '') {
    $conn = getDBConnection();
    // 검색어가 있을 경우 검색 조건을 붙여서 카운트
    if($search) {
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM board WHERE subject LIKE ?");
        $like = "$search";
        $stmt->bind_param("s", $like);
        $stmt->execute();
        $result = $stmt->get_result();
    }else {
        // 검색어가 없으면 전체 글 수 
        $result = $conn->query("SELECT COUNT(*) as count FROM board");
    }
    $row = $result->fetch_assoc();
    $conn->close();
    return $row['count'];
}


// ================================
// 댓글 및 대댓글 관련 함수
// ================================

// 댓글 및 대댓글 삽입
function insertComment($post_id, $parent_id, $password, $content) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("INSERT INTO comments (post_id, parent_id, name, password, content) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $post_id, $parent_id, $name, $password, $content);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

// 특정 게시글의 댓글 전체 조회 (정렬 포함)
function getCommentByPostId($post_id) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY created_at ASC");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $comments = [];
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }
    $stmt->close();
    $conn->close();
    return $comments;
}

// 댓글 삭제용 비밀번호 확인
function checkCommentPassword($comment_id, $password) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT * FROM comments WHERE id = ? AND password = ?");
    $stmt->bind_param("is", $comment_id, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $match = $result->num_rows > 0;
    $stmt->close();
    $conn->close();
    return $match;
}

// 댓글 삭제
function deleteComment($comment_id) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}