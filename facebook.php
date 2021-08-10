<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once __DIR__ . '/php-graph-sdk 3.2.3/facebook.php';
require_once 'functions.php';	

$szikra = getszikra();

	
$fb = array(
	'appId' => '***',
	'secret' => '***',
	'cookie' => true,
	'domain' => $base_url.$szikra['m']."/".$szikra['d'],
);

$facebook = new Facebook($fb);



#OPTION for Session Destroy
if(isset($_GET['destroy']) ) {
	//   $facebook->setSession(null);
	$facebook->destroySession();
	echo "Facebook session destroyed. Bye.<br/>";
	#exit;
} else {
	echo "[<a href=\"".$_SERVER['PHP_SELF']."?destroy\">destroy</a>] ";	
}

$user_id = $facebook->getUser();
	

$redirect = "http://szikrak.jezsuita.hu/facebook.php";
#LOGIN if it's needed
if (!$user_id AND !isset($_GET['code'])) {    
	$url = $facebook->getLoginUrl(array(
		'canvas' => 1,
		'fbconnect' => 0,
		'redirect' => $redirect,
		'scope' => 'manage_pages,publish_pages',
	));	
	#'scope' => 'manage_pages,offline_access,publish_stream',
	$url = str_replace('%3Fdestroy','',$url); 
	echo"<a href=".$url.">login</a> ";
	exit;
}

	
	
	
	
	if( (!$user_id OR $user_id == 0) AND (isset($_GET['code']) AND $_GET['code']!='') ) {
		
		$url = "https://www.facebook.com/dialog/oauth?client_id=".$fb['appId']."&redirect_uri=$redirect&scope=manage_pages,offline_access,publish_stream";
		 				
		$url = "https://graph.facebook.com/oauth/access_token?client_id=".$fb['appId']."&redirect_uri=".$redirect."&client_secret=".$fb['secret']."&code=".$_GET['code'];
		$return = curlRedir($url);
		//preg_match('/access_token=(.*)$/i',$return,$match);			
		#print_r($return);
		preg_match('/access_token":"(.*?)"/i',$return,$match);
		print_r($return);
		$token = $match[1];			
		setvar('access_token',$token);
	
		$facebook->setAccessToken($token);
		// make protected to public getUserFromAccessToken() in base_facebook.php!!
		$user_id = $facebook->getUserFromAccessToken();	
	}


print_r($user);
?>


