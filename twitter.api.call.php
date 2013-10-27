<?php
	include_once('twitter.methods.php') ;

	//send out one at a time
	if(isset($_POST['j']))
	{
		$token = $_POST['j'];
		$result = callTwitterPlease($token);
		$de_json = json_decode($result, true); //unjsonize this
		if (empty($de_json['errors']))
		{
			print json_encode($de_json);
		}
		else
		{
			// do nothing
		}
	}
	else
	{
		print array();
	}

?>