<?php 
require_once 'connection.php';
require_once 'session.php';

	

$islem=$_SESSION['kullanici'];
$username=$islem['User_Name'];
$userid=$islem['User_Id'];
$sorgu=$db->query('SELECT * FROM posts ',PDO::FETCH_ASSOC);
$userquery=$db->prepare('SELECT * FROM users WHERE User_Id=:userid');

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <script type="text/javascript" src="js/angular.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/material.min.js"></script>
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/stylecivit.css">
   
	<title>Hoşgeldin <?php echo $username;?></title>
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
<div class="container col-md-12 col-xs-12">
<div class="posts col-md-9 col-xs-12 col-md-offset-3 col-xs-offset-1">
<?php 
	if (array_key_exists('kullanici',$_SESSION)) {
if ($sorgu->rowCount()) {
	foreach ($sorgu as $civit) {
		
		$userquery->execute(array(
			':userid'=>$civit['User_Id']
			));
		$userq=$userquery->fetch(PDO::FETCH_ASSOC);
		echo '<div class="civitler">';
		echo '<a href="profile.php?id='.$civit['User_Id'].'"><h4>'.$userq['User_Name'].'</h4></a>';
		echo '<p>'.$civit['Civit'].'</p>';
		echo '<span>'.$civit['Date'].'</span>';
		if ($userid==$civit['User_Id']) {
			echo '<a class="delete" id="'.$civit['Post_Id'].'"><i class="glyphicon glyphicon-remove"></i></a>';
			echo '<a class="Editbuton" href="edit.php?id='.$civit['Post_Id'].'"><i class="
glyphicon glyphicon-pencil"></i></a><br>';
		};
		echo '<a class="likebutton" href="#"><p class="likes">0</p>|<i class="glyphicon glyphicon-thumbs-up">Like';
		echo '</i></a>';
		echo '</div>';
		};
};
}
else {
	header('Location:http://localhost:8080/civitterr/Login.php');
}

?>
 	<form method="POST" action="post.php">
 	<textarea style="resize:none;width:350px;height:150px;" name="civit"></textarea>
 	
 		<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Civit It!</button>
 	</form>
 	</div>
 	</div>
 	<div>
 		
 </div>	
 	<script type="text/javascript" src="js/jq.js"></script>
 	<script type="text/javascript" src="js/ajax.js"></script>

</body>
</html>




