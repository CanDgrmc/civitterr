<?php 
require_once 'connection.php';
require_once 'session/session.php';

	

$islem=$_SESSION['kullanici'];
$username=$islem['User_Name'];
$userid=$islem['User_Id'];
$sorgu=$db->query('SELECT * FROM posts ORDER BY Date DESC',PDO::FETCH_ASSOC);
$userquery=$db->prepare('SELECT * FROM users WHERE User_Id=:userid');
$likes=$db->prepare('SELECT * FROM likes WHERE Post_Id=:postid');
$begen=true;
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
	<li><a href="follows.php">Follows</a></li>
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
			echo '<a class="Editbuton1" ><i class="
glyphicon glyphicon-pencil"></i></a>';
			echo '<form class="ajax" action="edit.php?id='.$civit['Post_Id'].'" method="POST" style="display:none;">';
			echo '<textarea class="edittedtext" style="resize:none;width:350px;height:150px;" name="edittext">'; 
			echo $civit['Civit'];
			echo '</textarea>';
			echo '<button type="submit"  class="change"> Change</button></form>';
		};
		$counts=$db->prepare('SELECT count(*) FROM likes WHERE Post_Id=:postid');
					$counts->execute(array(
						':postid'=>$civit['Post_Id']	
						));
					$count=$counts->fetch(PDO::FETCH_NUM);
					$row=$count[0];
					echo '<p>'.$row.'</p>' ;
		$likes->execute(array(
			':postid'=>$civit['Post_Id']));
		if ($likes->rowCount()) {
			foreach ($likes as $like) {
				
				if (in_array($islem['User_Id'],$like) ) {
					$begen=0;
					
					
					}
				else {
			$begen=1;
			
			

		};

		
			};

		}
		else {$begen=1;}
		if ($begen==0) {
				echo '<a class="likebutton" href="dislike.php?id='.$civit['Post_Id'].'" like="'.$begen.'">';
					echo '<i class="glyphicon glyphicon-thumbs-down">Dislike </i></a>';
			}	
		else if ($begen==1) {
			echo '<a class="likebutton" href="like.php?id='.$civit['Post_Id'].'" like="'.$begen.'">';
			echo '<i class="glyphicon glyphicon-thumbs-up">Like</i></a>';
		}

		echo '</div>';
		};

}

else {
	header('Location:http://localhost:8080/civitterr/Login.php');
};
};
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




