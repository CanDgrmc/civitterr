<?php 
require_once 'session.php';
session_destroy();
header('Location:http://localhost:8080/civitterr/Login.php');

 ?>