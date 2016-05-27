<?php
require_once 'session/session.php';
require_once 'connection.php';

var_dump($_SESSION);
if(! empty ($_POST)){
    $girisSorgusu=$db->prepare('SELECT * FROM Users WHERE User_Name=:username AND Password=:pass');
    $girisSorgusu->execute([
       ':username'=>$_POST['username'],
        ':pass'=>$_POST['password']
    ]);
    if ($girisSorgusu->rowCount()==1){
       $_SESSION['kullanici']=$girisSorgusu->fetch(PDO::FETCH_ASSOC);

        header('Location:http://civitter.hol.es/civits.php');
    }
   else {
    echo '<p class="hata">Giriş yapınız..</p>';
}
}


?>
<html>
<head>
    <meta charset="utf-8">
    <script type="text/javascript" src="js/angular.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/material.min.js"></script>
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>
    <title></title>
</head>
<body>
<div class="container col-md-offset-3">
<form method="POST" class="form">
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input type="text" name="username" class="mdl-textfield__input" id="username">
     <label class="mdl-textfield__label" class="mdl-textfield__label" for="username">Username</label></div>
     <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input type="password" name="password" class="mdl-textfield__input" id="password">
    <label class="mdl-textfield__label" class="mdl-textfield__label" for="password">Password</label>
    </div>

    <div id="butonlar" class="col-md-offset-4">
    <button type="submit" class="login mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect"><i class="glyphicon glyphicon-ok"></i></button>
    <button type="button" id="SignUp" class="signup mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect"><i class="glyphicon glyphicon-plus"></i></button></div>
</form></div>
<dialog class="mdl-dialog dialog">
    <h4 class="mdl-dialog__title">Sign Up Now!</h4>
    <form action="Signup.php" method="POST">
    <input type="text" name="user_name" id="user_name" placeholder="User Name">
    <input type="password" name="pass_word" id="pass_word"  placeholder="Enter your password">
    <input type="email" name="email" id="email" placeholder="Enter your e-mail">
    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Sign Me Up</button>
   
    </form>
     <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" id="close">Close</button>
</dialog>
<script type="text/javascript" src="js/dialog.js"></script>
<script type="text/javascript" src="js/jq.js"></script>
</body>
</html>
