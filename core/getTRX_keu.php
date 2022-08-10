<?php 
	if (isset($_GET['fid'])){
        $res=proceed($conn);
    }

    function proceed($conn){
        $fid=$_GET['fid'];
        $res = queryBack("SELECT fa.name,bo.trx_number,bp.va_number,bp.media,bo.deposit,bo.status,bp.timestamp FROM whatsapp.billing_order bo JOIN whatsapp.billing_payment bp ON bp.billing_order_id=bo.id JOIN singa_yehuda_mengaum.form_attendee fa ON fa.id=bo.uid WHERE bo.trx_number like '010002%'");
        $arr = [];
        for ($i=0; $i < $res[0]; $i++) {
            $status = '';

            if ($res[1][$i]['status'] == 'X' || $res[1][$i]['status'] == 'Y' || $res[1][$i]['status'] == 'Z') {
                $status = 'Dibatalkan';
            }else if ($res[1][$i]['status'] == 'S') {
                $status = 'Sukses';
            }else if ($res[1][$i]['status'] == 'N') {
                $status = 'Belum dibayar';
            }

            $trx=new stdClass();
            $trx->no=($i+1);
            $trx->trx=ucwords($res[1][$i]['trx_number']);
            $trx->name=ucwords($res[1][$i]['name']);
            $trx->va=ucwords($res[1][$i]['va_number']);
            $trx->bank=ucwords($res[1][$i]['media']);
            $trx->total=ucwords($res[1][$i]['deposit']);
            $trx->timestamp=ucwords($res[1][$i]['timestamp']);
            $trx->status=ucwords($status);

            $arr[] = $trx;
        }
        echo json_encode($arr);
    }
?>