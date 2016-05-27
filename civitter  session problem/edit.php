<?php 
require_once 'connection.php';
$id=$_GET['id'];
if (isset($_POST['edittext'])){
	print_r($_POST);


	$edit=$db->prepare('UPDATE posts SET Civit = :civit WHERE Post_Id = :postid');
	$edit->execute(array(
		':civit'=>$_POST['edittext'],
		':postid'=>$id
		));
	};
?>
