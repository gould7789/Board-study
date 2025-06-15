<!DOCTYPE html>
<!-- 글쓰기 폼 페이지 -->
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 쓰기</title>
</head>

<body>
    <h2>게시글 작성</h2>

    <!-- 게시글 작성 폼. insert.php로 전송 -->
    <form method="post" action="insert.php" autocomplete="off">
        이름: <input type="text" name="name" required><br><br>              <!-- 이름 입력 -->
        비밀번호: <input type="password" name="password" required><br><br>  <!-- 작성자 확인용 비밀번호 입력 -->
        제목: <input type="text" name="subject" required><br><br>           <!-- 제목 입력 -->
        내용:<br>
        <textarea name="content" rows="10" cols="50" required></textarea><br><br>   <!-- 본문 작성 -->
        <input type="submit" value="작성 완료">     <!-- 작성 완료 버튼 -->
    </form>
</body>
</html>