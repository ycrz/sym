<?php 
	if (isset($_POST['fm']) && isset($_POST['lg_number']) && isset($_POST['lg_date']) && isset($_POST['lg_month']) && isset($_POST['lg_year'])){
        $res=proceed($conn);
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
		$lg_number = mysqli_real_escape_string($conn,$_POST['lg_number']);
		$lg_date = mysqli_real_escape_string($conn,$_POST['lg_date']);
		$lg_month = mysqli_real_escape_string($conn,$_POST['lg_month']);
		$lg_year = mysqli_real_escape_string($conn,$_POST['lg_year']);

		$res = queryBack("SELECT * FROM form_attendee WHERE fm='$fm' AND phone='$lg_number' AND date_birth='$lg_date' AND month_birth='$lg_month' AND year_birth='$lg_year'");
		$dtl = '';
		$fa_id = 0;
		if ($res[0] > 0) {
			$fa_id = $res[1][0]['id'];
			$dtl = queryBack("SELECT fa_id,sd_id,other FROM form_attendee_sin WHERE fa_id='$fa_id'");
		}
        echo json_encode(array('tmp'=>$res,'flag'=>'login','detail'=>$dtl,'enc'=>encrypt_decrypt_ori('encrypt', $fa_id)));
    }
?>