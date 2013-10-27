<?php
	include_once('twitter.methods.php') ;

	//send out one at a time
	$result = callTwitterPlease();

	if(isset($_POST['j']) && $_POST['j'] == 'true')
	{
		$de_json = json_decode($result, true); //unjsonize this
		if (empty($de_json['errors']))
		{
			print '{"results":[' . json_encode($de_json['results'][0])  . ']}';
		}
		else
		{
			// do nothing
		}
	}
	else
	{
		print $result;
	}

?>