<?php
	function OpenCon()
	{
		$dbhost = "188.166.250.246";
		$dbuser = "sekolak";
		$dbpass = "Betamorphosa@12345b";
		$db = "singa_yehuda_mengaum";	
		$conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n". $conn -> error);

		return $conn;
	}

	function CloseCon($conn)
	{
		$conn -> close();
	}

	function queryBack($query){
		$conn = OpenCon();
		$res = mysqli_query($conn,$query);
		$arr = [];
		while ($row = mysqli_fetch_assoc($res)) { $arr[] = $row; }
		return [mysqli_num_rows($res),$arr];
	}

	function queryPost($query){
		$conn = OpenCon();
		mysqli_query($conn,$query);
	}

	function queryInsert($query){
		$conn = OpenCon();
		mysqli_query($conn,$query);
		return mysqli_insert_id($conn);
	}

	function encrypt_decrypt($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = '-pendoa';
        $secret_iv = '-pendoa';
        // hash
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
?>