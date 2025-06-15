<?php
// 글 상세 보기

require_once '../backend/board_model.php';

$id = $_GET['id'] ?? 0;
$id = intval($id);      // id값을 정수로 변환

// 해당 id에 맞는 게시글 조회
$post = getPostById($id);

// 존재하지 않을 경우 오류메시지 출력
if (!$post) {
    echo "해당 글이 존재하지 않습니다.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>게시판 > 상세보기</title>
</head>

<body>
    <h2>게시판 > 상세보기</h2>

    <h3><?= $post['subject'] ?></h3>

    <!-- 작성자와 작성일 출력 -->
    <p><strong>작성자:</strong> <?= $post['name'] ?></p>
    <p><strong>작성일:</strong> <?= $post['created_at'] ?></p>

    <!-- 본문 출력 -->
    <p><?= nl2br($post['content']) ?></p>

    <br>
    <!-- 수정 버튼 -->
    <a href="edit.php?id=<?= $post['id'] ?>"><button>수정</button></a>

    <!-- 삭제 버튼 클릭 시 확인 메시지 출력 -->
    <a href="delete.php?id=<?= $post['id'] ?>" onclick="return confirm('정말 삭제하시겠습니까?');">
        <button>삭제</button>
    </a>
    <br><br>

    <!-- 목록 페이지로 돌아가기 -->
    <a href="index.php">돌아가기</a>


<?php
$reply_to = $_GET['reply_to'] ?? null;
$reply_to = $reply_to !== null ? intval($reply_to) : null;
$comments = getCommentByPostId($id);    // 댓글 조회
?>

<hr>
<h3>댓글</h3>
<?php renderComments($comments, null, 0, $reply_to); ?>

<hr>
<h3>댓글 작성</h3>
<form method="post" action="../backend/insert_comment.php">
    <input type="hidden" name="post_id" value="<?= $id ?>">
    <input type="hidden" name="parent_id" value="">
    이름: <input type="text" name="name" required><br>
    비밀번호: <input type="password" name="password" required><br>
    내용:<br>
    <textarea name="content" rows="4" cols="50" required></textarea><br>
    <input type="submit" value="댓글 작성">
</form>

</body>
</html>

