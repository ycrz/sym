<?php 
	$fid = $_POST['name_id'];
	$amount = $_POST['amount_id'];
	$bank = $_POST['bank_id'];
	$date = $_POST['date_id'];

	if ($amount < 10000) {
		die('Pembayaran harus diatas 10.000 rupiah');
	}

	$res = queryBackMulti("CALL whatsapp.gen_invoice(20,@cek); SELECT @cek;");
    $trx = $res[1][0][0];

	$billing_order_id = queryInsert("INSERT INTO whatsapp.billing_order (deposit,order_id,trx_number,payload,uid,status) VALUES ('$amount','MANUAL','$trx','MANUAL','$fid','S')");
	queryPost("INSERT INTO whatsapp.billing_payment (billing_order_id,payment_id,va_number,payload,media,user_number,timestamp) VALUES 
				('$billing_order_id','MANUAL','MANUAL','MANUAL','$bank','MANUAL','$date')");

	$_SESSION['alertsk'][0] = '1f';

	echo "<script type='text/javascript'> window.location.replace(\"../index\");</script>"; exit();
?>