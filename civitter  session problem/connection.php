<?php
try {
$db = new PDO('mysql:host=mysql.hostinger.web.tr;dbname=u897357297_civit;charset=utf8', 'u897357297_can', 'Pig7J1xuGm');
}
catch (PDOException $e){
    echo 'bağlanamadı: ' . $e->getMessage();
}
