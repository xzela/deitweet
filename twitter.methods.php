<?php
function callTwitterPlease() {
	$username = 'yo_noid';
	$password = 'dev=null';
	
	$url = "http://search.twitter.com/search.json?q=jesus+OR+xenu+OR+god+OR+allah+OR+mohammed+OR+satan+OR+vishnu";
	$curl = curl_init();
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($curl, CURLOPT_URL, $url);
	$result = curl_exec($curl);
	curl_close($curl);
	return $result;
}
?>