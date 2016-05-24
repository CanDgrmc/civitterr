<?php
require_once 'connection.php' ;
require_once 'session.php';
$islem=$_SESSION['kullanici'];
$username=$islem['User_Name'];
$userid=$islem['User_Id'];
$follows=$db->prepare('SELECT * FROM follow WHERE Following_Id=:following');
$users=$db->prepare('SELECT * FROM users WHERE User_Id=:userid');
$posts=$db->prepare('SELECT * FROM posts WHERE User_Id=:userid ORDER BY Date DESC');
$posts->execute(array(
	':userid'=>$_GET['id']
	));
$users->execute(array(
	':userid'=>$_GET['id']
	));
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/stylecivit.css">
	<link rel="stylesheet" type="text/css" href="css/styleprof.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>

</head>
<body>
<header>
<nav>
<ul class="menu">
	<li><a href="civits.php">General</a></li>
	<li><a href="#">Follows</a></li>
	<li><a href="profile.php?id=<?php echo htmlspecialchars($userid); ?>">Profile</a></li>
	<a href="Logout.php" id="logout"><i class="glyphicon glyphicon-log-out"></i></a>
</ul>
</nav></header>
<div class="container">

	<?php echo '<div class="info col-md-3">';
if (array_key_exists('kullanici', $_SESSION)){
	$islem=$_SESSION['kullanici'];
	$username=$islem['User_Name'];
	$userid=$islem['User_Id'];
	if ($users->rowCount()) {
	foreach ($users as $user) {
		$follows->execute(array(
			':following'=>$user['User_Id']
			));
		if ($follows->rowCount()){$unfollow=1;}
		else {$unfollow=0;}
		echo '<div class="userinfo">';
		if ($userid==$user['User_Id']) {
		
		echo '<a href="editprofile.php?id='.$user['User_Id'].'"><h3>'.$user['User_Name'].'</h3></a>';
		}
		else {
			echo '<h3>'.$user['User_Name'].'</h3>';
			if ($unfollow==0){
			echo '<a class="follow" href="follow.php?id='.$user['User_Id'].'">';
			echo '<i class="glyphicon glyphicon-plus">Follow</i></a>';
			}
				
			else {
			echo '<a class="follow" href="unfollow.php?id='.$user['User_Id'].'">';
			echo '<i class="glyphicon glyphicon-plus">unFollow</i></a>';
			}
			
			
		};
		echo '<p>'.$user['Email'].'</p>';
		echo '</div>';
		$counts=$db->prepare('SELECT count(*) FROM posts WHERE User_Id=:userid');
$counts->execute(array(
	':userid'=>$_GET['id'] 
	));
$count=$counts->fetch(PDO::FETCH_NUM);
$row=$count[0];
	echo '</div>';
	echo '<div class="counts col-md-3">';
	echo '<p class="postcount">Civits : '.$row.'</p>';
	
	}
}

else {echo 'No Matched User<br>';
};
echo '</div>';
echo '<div class="col-md-9 col-md-offset-2 col-xs-offset-4">';
if($posts->rowCount()){
	foreach ($posts as $post) {
		echo '<div class="userposts">';
		echo '<p>'.$post['Civit'].'</p><br>';
		echo '<span>'.$post['Date'].'</span>' ;
		if ($userid==$post['User_Id']) {
			echo '<a class="delete" id="'.$post['Post_Id'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a>';
			echo '<a class="Editbuton" href="'.$post['Post_Id'].'"><i class="
glyphicon glyphicon-pencil"></i></a><br>';
			echo '<form class="ajax" action="edit.php?id='.$post['Post_Id'].'" method="POST" style="display:none;">';
			echo '<textarea class="edittedtext" style="resize:none;width:350px;height:150px;" name="edittext">'; 
			echo $post['Civit'];
			echo '</textarea>';
			echo '<button type="submit"  class="change"> Change</button></form>';
			

		}
		echo '</div>';
};

}

else{echo 'No Post to Show';};

};

echo "</div>";?>
</div>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/jq.js"></script>
</body>
</html>
