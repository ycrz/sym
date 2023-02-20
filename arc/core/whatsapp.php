<?php 
	if (isset($_POST['text']) && isset($_POST['fid'])){
        $res=proceed($conn);
    }

    function sanity($number){
    	// kalau pertama 0
    	$sanity = str_replace(' ', '', $number);
    	$numberCheck = substr($sanity,0,1);
    	if ($numberCheck == '+') {
    		$sanity = substr($number,1,strlen($number));
    	}
    	$numberCheck = substr($sanity,0,1);
    	if ($numberCheck == '8') {
    		$sanity = '62'.$sanity;
		}
    	$numberCheck = substr($sanity,0,1);
		if ($numberCheck == '0') {
    		$sanity = '62'.substr($sanity,1,strlen($sanity));
		}
		return $sanity;
    }

    function proceed($conn){
		$fid = $_POST['fid'];
		$text = mysqli_real_escape_string($conn,$_POST['text']);

		$text = preg_replace("/\n/m", '\n', $_POST['text']);
		$text = implode('', explode("'", $text));

		$file_url = $_POST['file_url'];
		$fix_url = "NULL";
		if (trim($file_url) != '') {
			$fix_url = "'$file_url'";
		}


		$res = queryBack("SELECT phonenumber FROM admin_contact WHERE status='1'");
		for ($i=0; $i < $res[0]; $i++) { 
			$phA = sanity($res[1][$i]['phonenumber']);
			queryPost("INSERT INTO whatsapp.sender_bulking (number_groupname,message,application_id,file_link) VALUES ('$phA','*[ADMIN - Tembusan Pesan]*\n$text',5,$fix_url)");
		}
		
		$res = queryBack("SELECT phone FROM form_attendee WHERE fm='$fid'");
		if ($res[0] > 0) {
			for ($i=0; $i < $res[0]; $i++) { 
				$sanity = sanity($res[1][$i]['phone']);
				queryPost("INSERT INTO whatsapp.sender_bulking (number_groupname,message,application_id,file_link) VALUES ('$sanity','$text',5,$fix_url)");
			}
		}

		$_SESSION['alertsk'][0] = '1e';
		echo "<script type='text/javascript'> window.location.replace(\"../index\");</script>"; exit();
    }
?>