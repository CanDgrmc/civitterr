<?php 
require_once 'connection.php';
require_once 'session.php';

$id=$_GET['id'];
$userinfo =$db->prepare('SELECT * FROM users WHERE User_Id=:userid');
$userinfo->execute(array(
	':userid'=>$_GET['id']
	));
$user=$userinfo->fetch(PDO::FETCH_ASSOC);
if(!empty($_POST)){
$updateuser=$db->prepare('UPDATE users SET User_Name=:username, Email=:email WHERE User_Id=:userid');
$updateuser->execute(array(
	':username'=>$_POST['username'],
	':email'=>$_POST['email'],
	':userid'=>$_GET['id']
	));
header('Location:http://localhost:8080/civitterr/profile.php?id='.$_GET['id']);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="POST">
<input type="text" name="username" value="<?php echo htmlspecialchars($user['User_Name']);  ?>">
<input type="email" name="email" value="<?php echo $user['Email'] ?>">

<button type="submit">Change</button>

</form>
</body>
</html>



