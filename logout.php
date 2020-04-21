<?
require 'include/connection.php';
unset($_SESSION['logged_user']);
?>
<script>setTimeout( 'location="http://<?=$_SERVER['SERVER_NAME']?>/index.php";', 3000 );</script>