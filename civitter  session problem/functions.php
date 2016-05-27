<?php 
function show_civits($civit){
	$islem=$_SESSION['kullanici'];
	$username=$islem['User_Name'];
	$userid=$islem['User_Id'];
	$sorgu=$db->query('SELECT * FROM posts ',PDO::FETCH_ASSOC);
	$Users=$db->prepare('SELECT * FROM users WHERE User_Id=:Userid');	
	$Users->execute([
		':Userid'=>$civit['User_Id']
		]);
	if ($Users->rowCount()) {
		echo '<h4>'.$Users['User_Name'].'</h4>';
		foreach ($sorgu as $civit) {
		echo '<div class="civitler">';
		echo '<p>'.$civit['Civit'].'</p>';
		echo '<span>'.$civit['Date'].'</span>';
		if ($userid==$civit['User_Id']) {
			echo '<a class="Editbuton">Edit</a>';
		}
		echo '</div>';
	
		};
	}
}

