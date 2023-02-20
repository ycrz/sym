<?php 
    session_set_cookie_params(120 * 60, "/", $_SERVER['HTTP_HOST'], true, true);
    session_start();

    $dt = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

    include_once 'connectiator/db_connection.php';
    $conn = OpenCon();

    // for modal folder that required main page
    $isHeaderPage=1;
    // for modal folder that required main page

    function htmloutput($string){
        $entities = htmlentities($string);
        $fromJS = rawurldecode($entities);
        // return $fromJS;
        $encode = html_entity_decode(preg_replace("/%u([0-9a-f]{3,4})/i", "&#x\\1;", $fromJS), null, 'UTF-8');

        $breaks = array("<br />","<br>","<br/>");
        $newLine = str_ireplace($breaks, "\r\n", $encode);
        $entities = htmlentities($newLine);
        $final = str_replace(array("&lt;i&gt;", "&lt;b&gt;", "&lt;u&gt;", "&lt;/i&gt;", "&lt;/b&gt;", "&lt;/u&gt;"), array("<i>","<b>","<u>","</i>","</b>","</u>"), $entities);
        return $final;
    }

    function indexOf($array, $word) {
        foreach($array as $key => $value) if($value === $word) return $key;
        return -1;
    }

    function mustProfiling(){
        if (!isset($_SESSION['sk'])) {
            goToIndex();
        }
    }
    function goToIndex(){
        echo "<script type='text/javascript'>
                window.location.replace('.');
                </script>";
        exit();
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

    function whatsappSanity($number){
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

    function number_shorten($number, $precision = 0, $divisors = null) {

        // Setup default $divisors if not provided
        if (!isset($divisors)) {
            $divisors = array(
                pow(1000, 0) => ' x', // 1000^0 == 1
                pow(1000, 1) => ' rb x', // Thousand
                pow(1000, 2) => ' jt x', // Million
                pow(1000, 3) => ' mil x', // Billion
                pow(1000, 4) => ' tril x', // Trillion
                pow(1000, 5) => ' Qa x', // Quadrillion
                pow(1000, 6) => ' Qi x', // Quintillion
            );    
        }

        // Loop through each $divisor and find the
        // lowest amount that matches
        foreach ($divisors as $divisor => $shorthand) {
            if (abs($number) < ($divisor * 1000)) {
                // We found a match!
                break;
            }
        }

        // We found our match, or there were no matches.
        // Either way, use the last defined value for $divisor.
        return number_format($number / $divisor, $precision) . $shorthand;
    }
?>