<?php

function myErr($s) {
	echo '<pre>';
	print_r($s);
	echo '</pre>';
}

function isXHR() {
  if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
    return true;
  else 
    return false;
}

function myCURL($url, $params = NULL, $method = 'GET', $debug = false) {
  if ($debug !== false) {
    if (is_string($debug)) 
      $debug_output = fopen($debug, 'w');
    else
      $debug_output = fopen('php://stderr', 'w');
  }

	$postData = '';
	if (is_array($params)) {
		foreach($params as $k => $v) { 
			$postData .= $k . '='.$v.'&'; 
		}
		$postData = rtrim($postData, '&');
	} elseif (is_string($params)) {
		$postData = $params;
	}
	$method = (strtoupper($method) == 'POST' ? 'POST' : 'GET');

	$ch = curl_init();

  if ($debug !== false) {
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_STDERR, $debug_output);   
  }

  curl_setopt($ch, CURLOPT_URL, $url . ($method == 'GET' ? '?'.$postData : ''));

	if ($method == 'GET') {
		curl_setopt($ch, CURLOPT_HTTPGET, true);
	} else {
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
	}
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false); 
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
  $output = curl_exec($ch);

  if ($debug !== false) {
    fwrite($debug_output, print_r(curl_getinfo($ch), true));
    fwrite($debug_output, print_r($params, true));
    fwrite($debug_output, print_r($postData, true));
    fclose($debug_output);
  }
  curl_close($ch);

  return $output;
}

function myFTP($server, $port, $user, $pass, $file) {
  $r = false;
  $ch = ftp_connect("{$server}:{$port}") or die("Ne mogu se spojiti na {$server}, port {$port}");
  $login = ftp_login($ch, $user, $pass);
  if (ftp_get($ch, $file, $file, FTP_BINARY)) $r = true;
  ftp_close($ch);
  return $r;
}

function truncate($string, $long, $padd = '...') {
    if (strlen($string) <= $long) return $string;
    return substr( $string, 0, strrpos( substr( $string, 0, $long), ' ' ) ) . $padd;
}

function redirect($url){
    if (headers_sent()){
      die('<script type="text/javascript">window.location=\''.$url.'\';</script>');
    }else{
      header('Location: ' . $url);
      die();
    }    
}
