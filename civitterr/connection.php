<?php
try {
$db = new PDO('mysql:host=localhost;dbname=civitter;charset=utf8', 'root', '');
}
catch (PDOException $e){
    echo 'bağlanamadı: ' . $e->getMessage();
}
