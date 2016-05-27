<?php 
require_once 'connection.php';
require_once 'session.php';
$islem=$_SESSION['kullanici'];

$unfollow=$db->prepare('DELETE FROM follow WHERE Follower_Id=:follower AND Following_Id=:following');
$unfollow->execute(array(
	':follower'=>$islem['User_Id'],
	':following'=>$_GET['id']
	));

header("Refresh:0");


