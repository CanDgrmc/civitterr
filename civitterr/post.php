<?php 
require_once 'connection.php';
require_once 'session.php';
if (!empty ($_POST['civit'])){
$islem=$_SESSION['kullanici'];
$userid=$islem['User_Id'];
$post_text=$_POST['civit'];


$sorgu=$db->prepare('INSERT INTO Posts SET User_Id=:userid, Civit=:post_text');
$sorgu->execute(array(
	':userid'=>$userid,
	':post_text'=>$post_text
	));
	header('Location:http://localhost:8080/civitterr/civits.php');
}
else {
	echo "Boş metin";
	header('Location:http://localhost:8080/civitterr/civits.php');
}