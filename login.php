<?
require 'include/connection.php';

if(!empty($_SESSION['logged_user'])){
	?><script>setTimeout( 'location="http://<?=$_SERVER['SERVER_NAME']?>/index.php";', 0 );</script><?
		exit();
}

$data = $_POST;
if(isset($data['do_login'])){
	$user=R::findOne('users','login = ?', array($data['login']));

	if($user)
	{
		if(password_verify($data['password'],$user->password)){
			$_SESSION['logged_user'] = $user;
			?><script>setTimeout( 'location="http://<?=$_SERVER['SERVER_NAME']?>/index.php";', 0 );</script><?
			exit();
		}else{
			$err[] = "Неверный логин или пароль.";
		}

	}else{
		$err[] = "Неверный логин.";
	}

	if(!empty($err)){

		?><div class ='errors'><?=array_shift($err);?></div><hr><?
	}
}


?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title>Pink Panther</title>
	<link rel='stylesheet' href='assets/css/style.css'>
	<link rel='stylesheet' href='libs/css/bootstrap.css'>
	<link rel="stylesheet" href="libs/css/font-awesome.css">

</head>
	<body>
		<div class="form-wrapper">
			<form action="login.php" method="POST" class="form-auth">
				<p>
					<p>
						<strong>Ваш логин</strong>
					</p>
					<input type="text" name="login" value =<?=$data['login']?>>
				</p>
				<p>
					<p>
						<strong>Ваш пароль</strong>
					</p>
					<input type="password" name="password">
				</p>
				<p>
					<button type="submit" name="do_login">Войти</button>
				</p>
				<a href="index.php">Назад</a>
			</form>
		</div>
	</body>
</html>