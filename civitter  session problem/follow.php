<?php 
require_once 'connection.php';
require_once 'session.php';
$islem=$_SESSION['kullanici'];
$user=$_GET['id'];

$follows=$db->prepare('INSERT INTO follow SET Follower_Id=:follower, Following_Id=:following');
$follows->execute(array(
	':follower'=>$islem['User_Id'],
	':following'=>$_GET['id']
	));

