<?php 
	if (isset($_POST['fid']) && isset($_POST['val']) && isset($_POST['checked'])){
        $res=proceed($conn);
    }

    function proceed($conn){
		$fid = $_POST['fid'];
		$val = $_POST['val'];
		$checked = $_POST['checked'];

		if ($checked == 'true') {
			queryPost("INSERT INTO form_attendee_sin (fa_id,sd_id) VALUES ('$fid','$val')");
		}else if ($checked == 'false') {
			queryPost("DELETE FROM form_attendee_sin WHERE fa_id='$fid' AND sd_id='$val'");
		}
        echo json_encode(array('tmp'=>'done','flag'=>'usn'));
    }
?>