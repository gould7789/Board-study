<?php
require_once '../backend/db.php';

$conn = getDBConnection();

if ($conn) {
    echo "DB 연결 성공!";
} else {
    echo "DB 연결 실패!";
}
?>