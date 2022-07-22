<?php 
    // echo password_hash('adminadmin', PASSWORD_DEFAULT);

	if (!isset($_SESSION['alertsk'])) {
		$_SESSION['alertsk'][0] = 'netral';
	}
	if (isset($_POST['submit_si'])) {
		$first = mysqli_real_escape_string($conn,$_POST['lg_identity']);
		$second = mysqli_real_escape_string($conn,$_POST['lg_password']);

		if (empty($first) || empty($second)) {
			$_SESSION['alertsk'][0] = '1a';
		}else{
			$sql = "SELECT * FROM profiling WHERE username='$first' AND STATUS = '1'";
			$result = mysqli_query($conn,$sql);
			$resultCheck = mysqli_num_rows($result);

			if ($resultCheck < 1) {
				$_SESSION['alertsk'][0] = '1b';
			}else{
				if ($row = mysqli_fetch_assoc($result)) {
					$uid = $row['id'];
					// dehashing
					$hashedpwd = password_verify($second, $row['password']);
					if ($hashedpwd == false) {
						$_SESSION['alertsk'][0] = '1c';
					}else{
						// login user
						$_SESSION['sk'] = [$row['id'],$row['username'],$row['name'],$row['role']];
						$_SESSION['alertsk'][0] = '1d';
					}
				}
			}
		}
	}
	echo "<script type='text/javascript'> window.location.replace(\"../index\");</script>"; exit();
?>