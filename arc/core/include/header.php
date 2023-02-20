<?php 
	session_start();

	include_once '../connectiator/db_connection.php';

	$dt = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
	$conn = OpenCon();

    function goToIndex(){
        header("Location: ../index");
        exit();
    }
?>