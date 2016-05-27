<?php 
require_once 'connection.php';
require_once 'session.php';
$islem=$_SESSION['kullanici'];
$userid=['User_Id'];
$like=$db->prepare('DELETE FROM likes WHERE Post_Id=:postid AND User_Id=:userid ');
$like->execute(array(
	':userid'=>$islem['User_Id'],
	':postid'=>$_GET['id']
	));
header ('Location:http://localhost:8080/civitterr/civits.php');

 ?>
