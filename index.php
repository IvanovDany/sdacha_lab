<?
require 'include/connection.php';
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

<?
if(isset($_SESSION['logged_user'])){
?>
	
	<p>Привет, <?=$_SESSION['logged_user']['login'];?>.</p>
	<a href='logout.php'>Выйти</a>
	<hr>

	<button class='show-add-Task'>Создать задачу</button>
	<form id='add-form' action='create.php' method='POST'>
		<p>
			<p>
				<strong>Название задачи</strong>
			</p>
			<input class='task-Name' type='text' name='task_name'>
		</p>
		<p>
			<p>
				<strong>Описание</strong>
			</p>
			
			<textarea class='task-Description' name='task_description' rows='5' cols='50'></textarea>
		</p>
		<p>
			<button class='add-Task' type='submit' name='do_create'>Создать</button>
		</p>
	</form>
	<div class ='users-tasks'>
		<div class ='items'>
			
		</div>
	</div>
<?}else{?>
		<div class = "hello-title-wrapper">
		<span><h1>Добро пожаловать в Pink Panther</h1></span>
		<div class = 'hello-title-btns'>
			<a href='login.php'>Войти</a>
			<br>
			<a href='signup.php'>Регистрация</a>
		</div>
	</div>
<?}?>

<script src='libs/js/jquery-3.4.1.js'></script>
<script src='assets/js/create.js'></script>
<script src='assets/js/delete.js'></script>
<script src='assets/js/script.js'></script>
<script src='assets/js/update.js'></script>
</body>
</html>
