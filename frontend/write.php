<!DOCTYPE html>
<!-- 글쓰기 폼 만들기 -->
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 쓰기</title>
</head>

<body>
    <h2>게시글 작성</h2>
    <form method="post" action="insert.php">
        이름: <input type="text" name="name" required><br><br>
        비밀번호: <input type="password" name="password" required><br><br>
        제목: <input type="text" name="subject" required><br><br>
        내용:<br>
        <textarea name="content" rows="10" cols="50" required></textarea><br><br>
        <input type="submit" value="작성 완료">
    </form>
</body>
</html>