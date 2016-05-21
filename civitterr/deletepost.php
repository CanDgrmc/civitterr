<?php 
require_once 'connection.php';
require_once 'session.php';
if(array_key_exists('kullanici', $_SESSION)){
$id=$_GET['id'];
$sorgu=$db->prepare('DELETE FROM posts WHERE Post_Id=:id');
$sorgu->execute(array(
	':id'=>$id
	));

}
 ?>