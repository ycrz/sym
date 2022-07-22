<?php 
    if (isset($_POST['fid']) && isset($_POST['text'])){
        $res=proceed($conn);
    }

    function proceed($conn){
        $fid = $_POST['fid'];
        $text = mysqli_real_escape_string($conn,$_POST['text']);

        $res = queryBack("SELECT * FROM form_attendee_sin WHERE fa_id='$fid' AND sd_id='0'");
        if ($res[0] == 0) {
            queryPost("INSERT INTO form_attendee_sin (fa_id,sd_id,other) VALUES ('$fid','0','$text')");
        }else{
            queryPost("UPDATE form_attendee_sin SET other='$text' WHERE fa_id='$fid' AND sd_id='0'");
        }

        echo json_encode(array('tmp'=>'done'));
    }
?>