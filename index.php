<?php 
	$access_token = "<INSERT TOKEN HERE>";
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

	FacebookSession::setDefaultApplication("<APP ID>","<APP SECRET>");
	$session = new FacebookSession($access_token);

	$directory = '<DIRECTORY PATH>';
	$scanned_directory = array_diff(scandir($directory), array('..', '.'));

	// print_r($scanned_directory);
	$notuploaded = Array();
	foreach ($scanned_directory as $key => $value) {
		try {
			echo "Uploading ".$value.PHP_EOL;
			$request = new FacebookRequest($session, 'POST', '/<USER ID>/photos', array ('source' => new CURLFile($directory."/".$value, 'image/jpeg')));
			$response = $request->execute();
			$graphObject = $response->getGraphObject();
			$id = $graphObject->getProperty('id');
			echo $value." uploaded as ".$id.PHP_EOL;
		} catch (Exception $e) {
			echo "Uploading ".$value.PHP_EOL;
			$request = new FacebookRequest($session, 'POST', '/<USER ID>/photos', array ('source' => new CURLFile($directory."/".$value, 'image/jpeg')));
			$response = $request->execute();
			$graphObject = $response->getGraphObject();
			$id = $graphObject->getProperty('id');
			echo $value." uploaded as ".$id.PHP_EOL;	
		}
	}


?>