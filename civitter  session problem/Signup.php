<?php
require_once 'connection.php';

$addUser=$db-> prepare('INSERT INTO users SET User_Name = :username, Password = :password, Email = :email');
$addUser->execute(array(
	':username'=>$_POST['user_name'],
	':password'=>$_POST['pass_word'],
	':email'=>$_POST['email']
	));

header('Location:http://localhost:8080/civitterr/login.php');


