<?php 
	if (isset($_SESSION['sk'])){
		session_unset();
		session_regenerate_id();
		session_destroy();
	}
?>