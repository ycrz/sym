<?php 
	session_start();
	include_once '../connectiator/db_connection.php';

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
	
	function htmloutput($string){
        $entities = htmlentities($string);
        $fromJS = rawurldecode($entities);
        $encode = html_entity_decode(preg_replace("/%u([0-9a-f]{3,4})/i", "&#x\\1;", $fromJS), null, 'UTF-8');

        
        $entities = htmlentities($encode);

        $breaks = array("\r\n","\r","\n");
        $newLine = str_ireplace($breaks, "<br>", $entities);

        $final = str_replace(array("&lt;i&gt;", "&lt;b&gt;", "&lt;u&gt;", "&lt;/i&gt;", "&lt;/b&gt;", "&lt;/u&gt;"), array("<i>","<b>","<u>","</i>","</b>","</u>"), $newLine);
        return $final;
    }

    // if (!isset($_SESSION['sk'])) {
    //     echo "<script type='text/javascript'>
    //             window.location.replace(\"../index\");
    //         </script>";
    //     exit();
    // }
    if (!isset($_GET['p'])) {
        echo "<script type='text/javascript'>
                window.location.replace(\"../dashboard\");
            </script>";
        exit();
    }

    function validationImg($img){
    	$ret = '';
    	if (substr($img, 0,7) == 'uploads') {
    		$ret = '../'.$img;
    	}
    	return $ret;
    }

    $cid = encrypt_decrypt_ori('decrypt',$_GET['p']);

	require_once('../../tcpdf_sekolak/tcpdf.php');
	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Singa Yehuda Mengaum');
	$pdf->SetTitle('Form Result Exporter');
	$pdf->SetSubject('Form Result Exporter');
	$pdf->SetKeywords('Form');

	// set default header data
	// qback
	$res = queryBack("SELECT * FROM form_attendee WHERE id = '$cid'");

	// header
	$pdf->SetHeaderData('', '0', "Data Diri Formulir SYM");

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	    require_once(dirname(__FILE__).'/lang/eng.php');
	    $pdf->setLanguageArray($l);
	}

	// ---------------------------------------------------------

	// set font
	$pdf->SetFont('dejavusans', '', 10);

	// add a page
	$pdf->AddPage();

	$conn = OpenCon();

	$name = $res[1][0]['name'];
	$phone = $res[1][0]['phone'];
	$city = $res[1][0]['city'];
	$address = $res[1][0]['address'];
	$date_birth = $res[1][0]['date_birth'];
	$month_birth = $res[1][0]['month_birth'];
	$year_birth = $res[1][0]['year_birth'];
	$sym_class = $res[1][0]['sym_class'];
	$method = $res[1][0]['method'];

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
    

	$html = "<h4>BioData</h4>";
	$html .= '<table border="1">';
	$html .= '<tr><td>'."Nama:</td><td>$name".'</td></tr>';
	$html .= '<tr><td>'."Hp:</td><td>$phone".'</td></tr>';
	$html .= '<tr><td>'."Kota:</td><td>$city ".'</td></tr>';
	$html .= '<tr><td>'."Alamat Lengkap:</td><td>$address".'</td></tr>';
	$html .= '<tr><td>'."Tanggal Lahir:</td><td>$date_birth/$month_birth/$year_birth".'</td></tr>';
	$html .= '<tr><td>'."Mengikuti Kelas SYM:</td><td>$fixClassSYM".'</td></tr>';
	$html .= '<tr><td>'."Cara ikut pentahiran:</td><td>$fixHOW".'</td></tr>';
	$html .= '</table> <br><br>';

	$res = queryBack('SELECT * FROM sin_category');
	$include = queryBack("SELECT * FROM form_attendee_sin WHERE fa_id='$cid'");
	$incl_arr = [];
	for ($i=0; $i < $include[0]; $i++) { 
		$incl_arr[] = $include[1][$i]['sd_id'];
	}
	for ($i=0; $i < $res[0]; $i++) { 
		$html .= '<h4>'.ucwords(strtolower($res[1][$i]['name'])).'</h4><br>';

		$sid = $res[1][$i]['id'];
		$res_c = queryBack("SELECT * FROM sin_detail WHERE sid='$sid'");
		$html .= '<table border="1">';
		$latest = '';
		$kelipatan = 0;
		for ($j=0; $j < $res_c[0]; $j++) { 
			if ($j == 0) {
				$html .= '<tr>';
			}
			$mark = '';
			if (in_array($res_c[1][$j]['id'], $incl_arr)) {
				$mark = '<span style="font-family:zapfdingbats;">3</span>';
			}
			$html .= '<td style="text-align:center">'.$mark.'</td>';
			$html .= '<td style="font-size:8pt">'.ucwords(strtolower($res_c[1][$j]['name'])).'</td>';
			// echo ucwords(strtolower($res_c[1][$j]['name'])) .'<br>';
			if ($j%2 == 1) {
				// echo $j.'.'.($j%2).'<br>';
				$html .= '</tr>';
				if ($j != $res_c[0]-1) {
					$html .= '<tr>';
				}
				$latest = 'tr';
			}else{
				$latest = '';
			}
		}
		if ($latest != 'tr') {
			$html .= '</tr>';
		}
		$html .= '</table>';
	}
	// echo htmlentities($html);
	// die();

	$pdf->writeHTML($html, true, false, true, false, '');
	$pdf->AddPage();


	$res = queryBack("SELECT other FROM form_attendee_sin WHERE fa_id='$cid' AND sd_id=0");
	$html = "<h4>Lain-Lain</h4>";

	$text = preg_replace("/\n/m", '<br />', $res[1][0]['other']);
	$html .= $text;
	$pdf->writeHTML($html, true, false, true, false, '');


	// output the HTML content

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

	// reset pointer to the last page
	$pdf->lastPage();

	// ---------------------------------------------------------

	//Close and output PDF document
	$pdf->Output('Form Exporter '.substr($name, 0,10).'.pdf', 'I');

	//============================================================+
	// END OF FILE
	//============================================================+
?>