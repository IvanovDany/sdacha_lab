<?
require 'include/connection.php';
$data=$_POST;
if(isset($_SESSION['logged_user'])){
	if (!empty($data['task_name'])){
		try{
			$task = R::dispense('tasks');
			$task->user_id=$_SESSION['logged_user']['id'];
			$task->is_done = false;
			$task->task_name=trim($data['task_name']);
			$task->task_description=trim($data['task_description']);
			R::store($task);
			echo 'Задача успешно создана';
		}
		catch(Exception $e){
			echo "Error: ".$e->getMessage();
		}
	}
	else{
			echo 'Название не может быть пустым!';
	}
}else{?>
	<script>setTimeout( 'location="http://<?=$_SERVER['SERVER_NAME']?>/index.php";', 0 );</script>
<?}?>