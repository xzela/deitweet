<?php
/**
 * If it's broken or doesn't work, you probably forgot to create
 * the config file, see .gitignore for a very special file
 */
include 'config.php';

define('CONSUMER_KEY', $consumer_key);
define('CONSUMER_SECRET', $consumer_secret);
define('ACCESS_TOKEN', $access_token);
define('ACCESS_TOKEN_SECRET', $access_token_secret);
// %20 FTW!
define('SEARCH', "q=jesus%20OR%20xenu%20OR%20god%20OR%20allah%20OR%20mohammed%20OR%20satan%20OR%20vishnu");
define('COUNT', "count=10");
define('PARAMS', COUNT . '&' . SEARCH);
define('RAW_URL', "https://api.twitter.com/1.1/search/tweets.json");
define('PARAMS_URL', RAW_URL . '?' . PARAMS);


function constructOAuthHash()
{
	$hash = "";
	$hash .= "oauth_consumer_key=" . CONSUMER_KEY . "&";
	$hash .= "oauth_nonce=" . md5(time()) . "&";
	$hash .= "oauth_signature_method=HMAC-SHA1&";
	$hash .= "oauth_timestamp=" . time() . "&";
	$hash .= "oauth_token=" . ACCESS_TOKEN . "&";
	$hash .= "oauth_version=1.0";

	return $hash;
}


function constructKey()
{
	$key = '';
	$key .= rawurlencode(CONSUMER_SECRET);
	$key .= '&';
	$key .= rawurlencode(ACCESS_TOKEN_SECRET);
	return $key;
}

function constructBaseUrl($hash)
{
	$base = '';
	$base .= 'GET&';
	$base .= rawurlencode(RAW_URL);
	$base .= '&';
	$base .= rawurlencode(COUNT .'&');
	$base .= rawurlencode($hash);
	$base .= rawurlencode('&' . SEARCH);

	return $base;
}

function constructSignature($algo, $base, $key)
{
	$signature = base64_encode(hash_hmac($algo, $base, $key, true));
	return rawurlencode($signature);
}


function constructOAuthHeader($signature)
{
	$hash = "";
	$hash .= 'oauth_consumer_key="' . CONSUMER_KEY . '", ';
	$hash .= 'oauth_nonce="' . md5(time()) . '", ';
	$hash .= 'oauth_signature="' . $signature . '", ';
	$hash .= 'oauth_signature_method="HMAC-SHA1", ';
	$hash .= 'oauth_timestamp="' . time() . '", ';
	$hash .= 'oauth_token="' . ACCESS_TOKEN . '", ';
	$hash .= 'oauth_version="1.0"';
	return array("Authorization: OAuth " . $hash . "", 'Expect:');
}

function callTwitterPlease()
{
	$hash = constructOAuthHash();
	$base = constructBaseUrl($hash);
	$key = constructKey();
	$signature = constructSignature('sha1', $base, $key);
	$header = constructOAuthHeader($signature);

	// var_dump($base);

	$curl = curl_init();
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_URL, PARAMS_URL);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	$result = curl_exec($curl);
	curl_close($curl);

	return $result;
}
?>