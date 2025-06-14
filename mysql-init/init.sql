-- 게시판용 데이터베이스
-- 데이터베이스 생성 및 중복이 있을시 무시하고 실행
CREATE DATABASE IF NOT EXISTS board_login   -- 생성할 데이터 베이스 이름 
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE board_login;

-- 글 저장 테이블 생성
CREATE TABLE IF NOT EXISTS board (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- 글 번호
    name CHAR(20) NOT NULL,             -- 작성자 이름
    password CHAR(20) NOT NULL,         -- 비밀번호
    subject CHAR(20) NOT NULL,          -- 제목
    content TEXT NOT NULL,              -- 내용
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  -- 작성 시간
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- 댓글 및 대댓글 저장 테이블
CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- 댓글 ID
    post_id INT NOT NULL,               -- 게시글 ID
    parent_id INT DEFAULT NULL,         -- 부모 댓글 ID (NULL이면 원댓글)
    name CHAR(20) NOT NULL,             -- 작성자 이름
    password CHAR(20) NOT NULL,         -- 비밀번호
    content TEXT NOT NULL,              -- 댓글 내용
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- 작성 시간
    FOREIGN KEY (post_id) REFERENCES board(id) ON DELETE CASCADE,
    FOREIGN KEY (parent_id) REFERENCES comments(id) ON DELETE CASCADE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;