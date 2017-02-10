<?php 
	session_start();
	require("autoload.php");
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\FacebookResponse;
	use Facebook\FacebookSDKException;
	use Facebook\FacebookRequestException;
	use Facebook\FacebookAuthorizationException;
	use Facebook\GraphObject;
	use Facebook\Entities\AccessToken;
	use Facebook\HttpClients\FacebookCurlHttpClient;
	use Facebook\HttpClients\FacebookHttpable;
	FacebookSession::setDefaultApplication("249212718619314","40a0cd68ba64b518a8b2f4772ed77ee7");
	$helper = new FacebookRedirectLoginHelper("http://localhost/album/accesstoken.php");
	try {
		$session = $helper->getSessionFromRedirect();
	} catch( FacebookRequestException $ex ) {
  		// When Facebook returns an error
	} catch( Exception $ex ) {
	  // When validation fails or other local issues
	}
	if (isset($session)){
		print_r($session);
	} else {
		$loginURL = $helper->getLoginUrl(array('scope' => 'user_friends'));
		header("Location: ".$loginURL);
	}
?>