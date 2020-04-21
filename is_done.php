<?
require 'include/connection.php';
$data=$_POST;
if(isset($_SESSION['logged_user'])){
	try{
		$task = R::load('tasks', $data['id']);
		$task->is_done = $data['is_done'];
		R::store($task);
		echo "Set";
	}
	catch(Exception $e){
		echo "Not Set. ".$e->getMessage();
	}
}else{?>
	<script>setTimeout( 'location="http://<?=$_SERVER['SERVER_NAME']?>/index.php";', 0 );</script>
<?}?>