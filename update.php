<?
require 'include/connection.php';
$data = $_POST;
if(isset($_SESSION['logged_user'])){
	if(isset($data['do_update_confirm'])){
		$task = R::load('tasks', $data['item_task_id']);
		$task->task_name=trim($data['item_task_name']);
		$task->task_description=trim($data['item_task_description']);
		R::store($task);
		?><script>setTimeout( 'location="http://<?=$_SERVER['SERVER_NAME']?>/index.php";', 0 );</script><?
	}
}
else{
	?><script>setTimeout( 'location="http://<?=$_SERVER['SERVER_NAME']?>/index.php";', 0 );</script><?
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

<?
if(isset($_SESSION['logged_user'])){
?>
	
	<div class="header">
		<p>Привет, <?=$_SESSION['logged_user']['login'];?>.</p>
		<a href='logout.php'>Выйти</a>
	</div>

	<form id="item-form" action ="update.php" method ='POST'>
		<input type ='hidden' name="item_task_id" value = <?=$data['item_task_id']?>>
		<input class ='task-Name-col' type = 'text' name = 'item_task_name' value = <?=$data['item_task_name']?> >
		<textarea class = 'task-Description-col' name = 'item_task_description' rows = '5' cols = '50'><?=$data['item_task_description']?></textarea>
		<button class = 'btn-add-form-svg accept-button' name='do_update_confirm' type ='submit'>
			<svg  viewBox="0 0 450 450" x xmlns="http://www.w3.org/2000/svg"><path d="m215 .480469c-86.960938-.015625-165.363281 52.363281-198.640625 132.707031-33.273437 80.34375-14.867187 172.820312 46.640625 234.292969 83.949219 83.949219 220.054688 83.949219 304 0 83.949219-83.945313 83.949219-220.050781 0-304-40.222656-40.453125-94.953125-63.136719-152-63zm116 163.402343-136.199219 130.097657c-1.859375 1.777343-4.328125 2.777343-6.898437 2.800781-2.65625-.011719-5.199219-1.050781-7.101563-2.898438l-77.300781-77.300781c-3.894531-3.894531-3.894531-10.207031 0-14.101562s10.207031-3.894531 14.101562 0l70.398438 70.402343 129.199219-123.402343c3.976562-3.808594 10.289062-3.675781 14.101562.300781s3.675781 10.289062-.300781 14.101562zm0 0"/></svg>
		</button>
		<button class = 'btn-add-form-svg decline-button' type ='button'>
			<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 512 512"  xml:space="preserve"><path d="M436.3,75.7C388,27.401,324.101,0,256,0C115.343,0,0,115.116,0,256c0,140.958,115.075,256,256,256 c140.306,0,256-114.589,256-256C512,187.899,484.6,123.999,436.3,75.7z M256,451c-107.786,0-195-86.985-195-195 c0-42.001,13.2-81.901,37.5-114.901l272.401,272.1C337.899,437.8,298.001,451,256,451z M413.2,370.899L141.099,98.5 C174.101,74.2,213.999,61,256,61c107.789,0,195,86.985,195,195C451,297.999,437.8,337.899,413.2,370.899z"/></svg>
		</button>
	</form>


<?}else{?>
		<script>setTimeout( 'location="http://<?=$_SERVER['SERVER_NAME']?>/index.php";', 0 );</script>
<?}?>

<script src='libs/js/jquery-3.4.1.js'></script>
<script src='assets/js/update.js'></script>
</body>
</html>