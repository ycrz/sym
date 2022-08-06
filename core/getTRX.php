<?php 
	if (isset($_GET['fid'])){
        $res=proceed($conn);
    }

    function proceed($conn){
        $fid=$_GET['fid'];
        $res = queryBack("SELECT bo.trx_number,bp.va_number,bp.media,bo.deposit,bo.status FROM whatsapp.billing_order bo JOIN whatsapp.billing_payment bp ON bp.billing_order_id=bo.id WHERE bo.trx_number like '010002%' AND bo.uid='$fid'");
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
            $trx->va=ucwords($res[1][$i]['va_number']);
            $trx->bank=ucwords($res[1][$i]['media']);
            $trx->total=ucwords($res[1][$i]['deposit']);
            $trx->status=ucwords($status);

            $arr[] = $trx;
        }
        echo json_encode($arr);
    }
?>