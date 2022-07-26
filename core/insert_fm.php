<?php 
	if (isset($_POST['tx_number']) && isset($_POST['date']) && isset($_POST['month']) && isset($_POST['year']) && isset($_POST['fm'])){
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

    function encrypt_decrypt_ori($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = '-symevvvevwevc';
        $secret_iv = '-symevvvevwevc';
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

    function proceed($conn){
		$fm = mysqli_real_escape_string($conn,$_POST['fm']);
		$name = ucwords(strtolower(mysqli_real_escape_string($conn,$_POST['tx_name'])));
		$phone = mysqli_real_escape_string($conn,$_POST['tx_number']);
		$city = ucwords(strtolower(mysqli_real_escape_string($conn,$_POST['tx_city'])));
		$address = ucwords(strtolower(mysqli_real_escape_string($conn,$_POST['tx_address'])));
		$date_birth = mysqli_real_escape_string($conn,$_POST['date']);
		$month_birth = mysqli_real_escape_string($conn,$_POST['month']);
		$year_birth = mysqli_real_escape_string($conn,$_POST['year']);
		$sym_class = mysqli_real_escape_string($conn,$_POST['class_sym']);
		$method = mysqli_real_escape_string($conn,$_POST['how_sym']);

		$exist = queryBack("SELECT * FROM form_attendee WHERE phone='$phone' AND date_birth='$date_birth' AND month_birth='$month_birth' AND year_birth='$year_birth' AND fm='$fm'")[0];

		if ($exist == 0) {
			$fid = queryInsert("INSERT INTO form_attendee (fm,name,phone,city,address,date_birth,month_birth,year_birth,sym_class,method) VALUES (
								'$fm','$name','$phone','$city','$address','$date_birth','$month_birth','$year_birth','$sym_class','$method')");

			$fixClassSYM = '';
			if ($sym_class == 0) {
				$fixClassSYM = 'Belum pernah mengikuti kelas SYM';
			}else{
				$fixClassSYM = 'SYM Angkatan '.$fixClassSYM;
			}

			$fixClassSYM = '';
			if ($sym_class == 0) {
				$fixClassSYM = 'Belum pernah mengikuti kelas SYM';
			}else{
				$fixClassSYM = 'SYM Angkatan '.$fixClassSYM;
			}

			$fixHOW = '';
			if ($method == 0) {
				$fixHOW = 'Offline';
			}else{
				$fixHOW = 'Online';
			}

			$fix_num = sanity($phone);

			$mssAdmin = "*[KHUSUS ADMIN]*\nTelah diterima pendaftaran\nNama: $name\nHp: $phone\nWA: wa.me/$fix_num\nKota: $city \nAlamat Lengkap: $address\nTanggal Lahir: $date_birth/$month_birth/$year_birth\n\nMengikuti Kelas SYM: $sym_class\nCara ikut pentahiran: $fixHOW";

			queryPost("INSERT INTO whatsapp.sender_bulking (number_groupname,message,application_id) VALUES ('6285814862369','$mssAdmin',5)");
			queryPost("INSERT INTO whatsapp.sender_bulking (number_groupname,message,application_id) VALUES ('6281298944287','$mssAdmin',5)");
			queryPost("INSERT INTO whatsapp.sender_bulking (number_groupname,message,application_id) VALUES ('6281317339353','$mssAdmin',5)");

			queryPost("INSERT INTO whatsapp.sender_bulking (number_groupname,message,application_id) VALUES ('$fix_num','Proses pendaftaran Anda sudah berhasil. Mohon menunggu informasi selanjutnya dari pihak kami.\n\nTerima Kasih,\nTuhan Yesus memberkati.\n_Singa Yehuda Mengaum_',5)");
		}
        echo json_encode(array('tmp'=>$exist,'flag'=>'insert_fm','fid'=>$fid,'enc'=>encrypt_decrypt_ori('encrypt', $fid)));
    }
?>