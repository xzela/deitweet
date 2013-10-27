<?php
include 'twitter.methods.php';
?>
<html>
	<head>
		<style type='text/css'>
			body {
				margin: 0;
				padding: 0;
			}
			#ad_tweets {
				display: none;
				height: 0px;
				width: 0px;
			}
			.ad_tweet {
				display: inline;
			}
			
		</style>
	</head>
	<body>
		<ul id='ad_tweets' >
		<?php

			$result = callTwitterPlease();
			curl_close($curl);
			$de_json = json_decode($result, true)
								
		?>
			<?php foreach($de_json['results'] as $tweet): ?>
				<li id="<?php echo $tweet['id']; ?>">
					<?php echo $tweet['text']; ?>
				</li>
			<?php endforeach; ?>
		</ul>
		<div class='ad_tweet'>
			<script type="text/javascript"><!--
				google_ad_client = "pub-2816062844723151";
				/* 468x60, created 8/14/09 */
				google_ad_slot = "4398350806";
				google_ad_width = 468;
				google_ad_height = 60;
				//-->
			</script>
			<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>		
		</div>
	</body>
</html>