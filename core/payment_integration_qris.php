<?php
    include_once '../connectiator/db_connection.php';
    if (isset($_POST['tatl']) && isset($_POST['name']) && isset($_POST['amount']) && isset($_POST['wallet'])){
    	$arr = ['QRIS'];
    	if (!in_array($_POST['wallet'], $arr)) {
    		echo json_encode(array('tmp' => "Tipe pembayaran harus QRIS. <br>Hubungi tim admin kami bila mengalami kesulitan.", "flag" => 'false'));
            die();
    	}else{
    		$res=api();
    	}
    }else if(isset($_POST['tcpl']) && isset($_POST['fid']) && isset($_POST['amount'])){
    	$_SESSION['tcpl_name'] = $_POST['name'];
    	$_SESSION['tcpl_bank'] = $_POST['radio-stacked'];
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="../logo/only.png">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Payment Integration SYM</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="../temp_js/qrcode.js"></script>
</head>
<style type="text/css">
	#qrcode>img{
		margin: 0 auto;
	}
	.loader {
		border: 16px solid #f3f3f3;
		border-radius: 50%;
		border-top: 16px solid #ff0000;
		width: 120px;
		margin: 0 auto;
		height: 120px;
		-webkit-animation: spin 2s linear infinite; /* Safari */
		animation: spin 2s linear infinite;
	}
	@keyframes spin {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(360deg); }
	}
</style>
<body>
	<div class="container min-vh-100">
		<div class="row">
			<div class="col-12 text-center" style="margin-top:40vh" id="mss">
				<span>Mohon menunggu. Pembayaran anda akan segera diproses.</span>
				<div class="loader mt-3"></div>
			</div>
			<div class="col-12 text-center">
				<a href="../" class="btn btn-outline-primary">ke Dashboard</a>
			</div>
			<div class="col-12" id="loader"></div>
		</div>
	</div>
	<script type="text/javascript">
	<?php 
		if ($_SESSION['tcpl'] != 'terpakai') {
	?>
			data = {tatl:true,fid:"<?php echo $_POST['fid'] ?>",amount:"<?php echo $_POST['amount'] ?>",name:"<?php echo $_POST['name'] ?>",wallet:'<?php echo $_POST['radio-stacked'] ?>'};
			$.ajax({
		        type: "POST",
		        url: 'payment_integration_qris',
		        data,
		        cache: false,
		        success: function(get){
		        	let json = JSON.parse(get);
		        	if (json.flag == 'true') {
		        		$('#mss').html(json.tmp);
			        	$('#mss').css('marginTop','22vh');
			        	startChecking(json.trx);
		        	}else{
		        		$('#mss').html(json.tmp);
			        	$('#mss').css('marginTop','22vh');
		        	}
		        },error: function(get){
		        	alert('Gagal! cek koneksi anda');
		        }
		    });	
	<?php
		}else{
	?>	
			// console.log('terpakai');

			$('#mss').html('Berikut merupakan kode QRIS anda. <br> <div id="qrcode"></div> <br> Dapat dibayar menggunakan mobile banking BCA, BRI, MANDIRI, BNI dan bank lainnya atau bisa juga dengan OVO GOPAY ATAU SHOPEEPAY <br> <b>Mohon segera melakukan pembayaran. Pembayaran akan berakhir dalam 24 jam.</b>');
			
			new QRCode(document.getElementById("qrcode"), "<?php echo $_SESSION['tcpl_va'] ?>");

        	$('#mss').css('marginTop','22vh');
			startChecking('<?php echo $_SESSION['tcpl_trx'] ?>');
	<?php
		}
	?>
		

	    function startChecking(trx){
			dtcek = {cacl:true,trx};
    		$('#loader').html('');
	    	setTimeout(function () {
	    		$('#loader').html('<div class="loader mt-3"></div>');
			  	$.ajax({
			        type: "POST",
			        url: 'payment_integration_qris',
			        data: dtcek,
			        cache: false,
			        success: function(get){
			        	if (get == 'X' || get == 'Y' || get == 'Z') {
	        				$('#mss').html('Pembayaran ini telah dibatalkan. Silahkan kembali ke halaman sebelumnya.');
	    					$('#loader').html('');
			        	}else if (get == 'S') {
	        				$('#mss').html('<span class="text-success">Pembayaran Berhasil. Silahkan cek deposit yang bertambah. <br>Terimakasih! <br>-Singa Yehuda Mengaum</span>');
	    					$('#loader').html('');
			        	}else if (get == 'N') {
			        		startChecking(trx);
			        	}
			        },error: function(get){
			        	alert('Gagal! cek koneksi anda');
			        }
			    });
			}, 5000)
	    }
	</script>
</body>
</html>
<?php
    	$_SESSION['tcpl'] = 'terpakai';
    }else if(isset($_POST['cacl']) && isset($_POST['trx'])){
    	$trx = $_POST['trx'];
        $res = queryBack("SELECT status FROM whatsapp.billing_order WHERE trx_number='$trx'");
        if ($res[0]<1) {
       		header('Location: ../');
        }else{
        	echo $res[1][0]['status'];
        }
    }else{
        header('Location: ../');
    }

    function unwantedNumber($number){
    	$number = str_replace('e', '', $number);
    	$number = str_replace('-', '', $number);
    	return $number;
    }

    function sanity($number){
    	// kalau pertama 0
    	$sanity = str_replace(' ', '', $number);
    	$numberCheck = substr($sanity,0,1);
    	if ($numberCheck == '+') {
    		$sanity = substr($sanity,1,strlen($sanity));
    	}
    	$numberCheck = substr($sanity,0,1);
    	if ($numberCheck == '8') {
    		$sanity = '0'.$sanity;
		}
    	$numberCheck = substr($sanity,0,1);
		if ($numberCheck == '0') {
    		$sanity = '0'.substr($sanity,1,strlen($sanity));
		}
		$numberCheck = substr($sanity,0,2);
		if ($numberCheck == '62') {
    		$sanity = '0'.substr($sanity,2,strlen($sanity));
		}
		return $sanity;
    }
    
    function api(){
    	// $order_id = 'ord_6U8Dr35z7u8318';
    	// $billing_order_id = 1;
    	$amount = unwantedNumber($_POST['amount']);
    	$wallet = $_POST['wallet'];
    	$name = $_POST['name'];


    	if (!validateNumberOnly($amount)) {
			echo json_encode(array('tmp' => "Total harus dalam angka. Yang anda masukan ada yang bukan angka.", "flag" => 'false'));
            die();
    	}

    	if ($amount > 600000) {
			echo json_encode(array('tmp' => "Pembayaran tidak bisa lebih dari 600000.", "flag" => 'false'));
            die();
    	}
    	if ($amount < 100000) {
			echo json_encode(array('tmp' => "Pembayaran tidak bisa kurang dari 100000.", "flag" => 'false'));
            die();
    	}

    	$fid = $_POST['fid'];
    	$number = queryBack("SELECT phone FROM form_attendee WHERE id='$fid'")[1][0]['phone'];
    	$name = $_POST['name'];

        $res = queryBackMulti("CALL whatsapp.gen_invoice(20,@cek); SELECT @cek;");
        $trx = $res[1][0][0];
        $_SESSION['tcpl_trx'] = $trx;

        $order = durianSetOrder($amount,$trx,$fid,$name);
        $response_JSON = json_decode($order,true);
        $order_id = $response_JSON['data']['id'];
		$billing_order_id = queryInsert("INSERT INTO whatsapp.billing_order (deposit,order_id,trx_number,payload,uid) VALUES ('$amount','$order_id','$trx','$order','$fid')");

        $payment = durianSetPayment($order_id,$amount,$wallet,$fid);
        $response_JSON = json_decode($payment,true);
		$payment_id = $response_JSON['data']['response']['payment_id'];
		$account_number = $response_JSON['data']['response']['qr_code'];
        $_SESSION['tcpl_va'] = $account_number;
        $payment = str_replace("'", "", $payment);

		$phA = sanity($number);
		queryPost("INSERT INTO whatsapp.billing_payment (billing_order_id,payment_id,va_number,payload,media,user_number) VALUES ('$billing_order_id','$payment_id','$account_number','$payment','$wallet','$phA')");

		$mss = "[Informasi Pembayaran SYM]\n'Anda memilih membayar menggunakan QRIS. Pembayaran akan berakhir dalam 24 jam.\n\n_Kode QR ditampilkan di website singayehudamengaum.my.id\nTerimakasih Tuhan Yesus memberkati!_";
		queryPost("INSERT INTO whatsapp.sender_bulking (number_groupname,message,application_id) VALUES ('$phA','$mss',5)");

		echo json_encode(array('tmp' => 'Berikut merupakan kode QRIS anda. <br> <div id="qrcode"></div> <br> Dapat dibayar menggunakan mobile banking BCA, BRI, MANDIRI, BNI dan bank lainnya atau bisa juga dengan OVO GOPAY ATAU SHOPEEPAY <br> <b>Mohon segera melakukan pembayaran. Pembayaran akan berakhir dalam 24 jam.</b> <script type="text/javascript">new QRCode(document.getElementById("qrcode"), "'.$account_number.'");</script>', "trx" => $trx, "flag" => 'true'));
    }

    function validateNumberOnly($string){
        if (!preg_match("/^[0-9]*$/",$string)) {
            return "Hanya angka yang diperbolehkan";
        }else{
            return true;
        }
    }

    function durianSetOrder($amount,$trx,$fid,$name){
		$curl = curl_init();
		$dev = "ZHBfdGVzdF80UUlaSFlnV01YY0g3Z2REOg==";
    	$live = "ZHBfbGl2ZV9aUGNxREZBVGZ4bzBWN0JxOg==";

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.durianpay.id/v1/orders',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS =>'{
				"amount": "'.$amount.'",
				"payment_option": "full_payment",
				"currency": "IDR",
				"order_ref_id": "'.$trx.'",
				"customer": {
					"customer_ref_id": "'.$fid.'",
					"given_name": "'.$name.'",
					"email": "p-'.$billing_order_id.'@sym.my.id",
					"address": {
						"receiver_name": "'.$name.'",
						"label": "'.$fid.'"
					}
					},
					"items": [
					{
						"name": "'.$trx.'",
						"qty": 1,
						"price": "'.$amount.'",
						"logo": "https://singayehudamengaum.my.id/img/wh_logo.png"
					}
					],
					"metadata": {
						"my-meta-key": "1",
						"SettlementGroup": "payment_invoice"
					}
				}',
				CURLOPT_HTTPHEADER => array(
					'Authorization: Basic '.$live,
					'Content-Type: application/json'
				),
			)
		);

		$response = curl_exec($curl);
		$err = curl_error($curl);

		return $response;
	}

	function durianSetPayment($order_id,$amount,$bank,$fid){
	    $payload = '{
	        "type": "QRIS",
	        "request": {
	            "order_id": "'.$order_id.'",
	            "type": "QRIS",
	            "name": "'.$fid.'",
	            "amount": "'.$amount.'"
	        }
	    }';

		$curl = curl_init();
		$dev = "ZHBfdGVzdF80UUlaSFlnV01YY0g3Z2REOg==";
    	$live = "ZHBfbGl2ZV9aUGNxREZBVGZ4bzBWN0JxOg==";

		curl_setopt_array($curl, array(
		    CURLOPT_URL => 'https://api.durianpay.id/v1/payments/charge',
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_ENCODING => '',
		    CURLOPT_MAXREDIRS => 10,
		    CURLOPT_TIMEOUT => 0,
		    CURLOPT_FOLLOWLOCATION => true,
		    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		    CURLOPT_CUSTOMREQUEST => 'POST',
		    CURLOPT_POSTFIELDS =>$payload,
		    CURLOPT_HTTPHEADER => array(
		        'Authorization: Basic '.$live,
		        'Content-Type: application/json'
		    ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		return $response;
	}
?>