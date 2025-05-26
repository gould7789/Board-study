<?php
// DB 연결 모듈
function getDBConnection() {
    $host = 'mysql';
    $user = 'root';
    $pass = '12345678';
    $dbname = 'board_login';

    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("DB 연결 실패: " . $conn->connect_error);
    }

    $conn->set_charset("utf8mb4");
    return $conn;
}