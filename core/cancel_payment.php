<?php 
	if (isset($_GET['fid'])){
		if ($_GET['fid'] == 'askcvyjsc12132') {
        	$res=proceed($conn);
		}
    }

	function durianCancelPayment($payment_id){
		$dev = "ZHBfdGVzdF80UUlaSFlnV01YY0g3Z2REOg==";
		$live = "ZHBfbGl2ZV9aUGNxREZBVGZ4bzBWN0JxOg==";

		$curl = curl_init();

		curl_setopt_array($curl, array(
		    CURLOPT_URL => 'https://api.durianpay.id/v1/payments/'.$payment_id.'/cancel',
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_ENCODING => "",
		    CURLOPT_MAXREDIRS => 10,
		    CURLOPT_TIMEOUT => 60,
		    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		    CURLOPT_CUSTOMREQUEST => "PUT",
		    CURLOPT_HTTPHEADER => array(
		        'Authorization: Basic '.$live,
		        'Content-Type: application/json'
		    ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		return $response;
	}

    function proceed($conn){
        $res = queryBack("SELECT trx_number,payment_id FROM billing_order bo JOIN billing_payment bp ON bo.id = bp.billing_order_id WHERE substr(bo.trx_number,1,7) like '010002%' AND STATUS='N' AND now() > bo.timestamp+INTERVAL 1 day");
        for ($i=0; $i < $res[0]; $i++) { 
        	durianCancelPayment($res[1][$i]['payment_id']);
        	$trx = $res[1][$i]['trx_number'];
        	queryPost("UPDATE billing_order SET status = 'Z' WHERE trx_number = '$trx'");
        }
    }
?>