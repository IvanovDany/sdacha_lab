<?
require 'include/connection.php';
$data=$_POST;
if(isset($_SESSION['logged_user'])){
	try{
		$deletedTasksCounter = R::hunt('tasks','id = ? AND user_id = ?', array( $data['id'],$_SESSION['logged_user']['id']));
		echo $deletedTasksCounter;
	}
	catch(Exception $e){
		echo "Not Set. ".$e->getMessage();
	}
}else{?>
	<script>setTimeout( 'location="http://<?=$_SERVER['SERVER_NAME']?>/index.php";', 0 );</script>
<?}?>