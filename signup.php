<?
require 'include/connection.php';
if(!empty($_SESSION['logged_user'])){
	?><script>setTimeout( 'location="http://<?=$_SERVER['SERVER_NAME']?>/index.php";', 0 );</script><?
		exit();
}
$data=$_POST;
if(isset($data['do_signup'])){

	if(trim($data['login'])==''){
		$err[]='Введите логин.';
	}

	if(trim($data['email'])==''){
		$err[]='Введите email.';
	}

	if($data['password']==''){
		$err[]='Введите пароль.';
	}

	if($data['password_2']!=$data['password']){
		$err[]='Пароли не совпадают.';
	}

	if(R::count('users','login = ? ',array($data['login']))>0){
		$err[]='Пользователь с таким логином уже существует.';
	}

	if(R::count('users','email = ?',array($data['email'])) > 0){
		$err[]='Пользователь с таким почтовым ящиком уже существует.';
	}



	if(empty($err)){

		$user = R::dispense('users');
		$user->login=$data['login'];
		$user->email=$data['email'];
		$user->password=password_hash($data['password'],PASSWORD_DEFAULT);
		R::store($user);
		?>
		<script>setTimeout( 'location="http://<?=$_SERVER['SERVER_NAME']?>/login.php";', 0 );</script><?
		exit();

	}else{
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
			<form action="signup.php" method="POST" class="form-auth">
				<p>
					<p>
						<strong>Ваш логин</strong>
					</p>
					<input type="text" name="login" value =<?=$data['login']?> required>
				</p>
				<p>
					<p>
						<strong>Ваш e-mail</strong>
					</p>
					<input type="email" name="email" value =<?=$data['email']?> required>
				</p>
				<p>
					<p>
						<strong>Ваш пароль</strong>
					</p>
					<input type="password" name="password" >
				</p>
				<p>
					<p>
						<strong>Повторите пароль</strong>
					</p>
					<input type="password" name="password_2" >
				</p>
				<p>
					<button type="submit" name="do_signup">Зарегистрироваться</button>
				</p>
				<a href="index.php">Назад</a>
			</form>
		</div>
			

		<script src='libs/js/jquery-3.4.1.js'></script>
	</body>
</html>