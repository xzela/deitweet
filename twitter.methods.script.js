function getTweetsPlease(str) {
	$.post('twitter.api.call.php', {j:str},
		function(data) {
			tweet = data.results;
			list = $('#tweet_feed');
			if(tweet !== null) {
				for(i = 0; i < tweet.length; i++) {
					if(a.length > 0) { //test to see if array is larger than 0;
						if(a[tweet[i].id] != tweet[i].from_user) { //if tweet not already in list, add 'em!
							html = formatTweetPlease(tweet[i]);
							list.prepend(html);
							$('#' + tweet[i].id).attr('style', 'display:none').slideDown('slow');
							a[tweet[i].id] = tweet[i].from_user;
						}
					}
					else { //list is empty, add the tweets
						html = formatTweetPlease(tweet[i]);
						list.prepend(html);
						$('#' + tweet[i].id).attr('style', 'display:none').slideDown('slow');
						a[tweet[i].id] = tweet[i].from_user;

					}
				}
				if(list.children().size() > 10) { //remove tweets when list is larger than 10 entries
					$("#tweet_feed li:last-child").slideUp("normal").remove();
				}
			}
		},
		'json'
	);
}


function formatTweetPlease(tweet) {
	var html = '<li id="' + tweet.id + '">';
	var image = '<span id="image"><img src="' + tweet.profile_image_url + '" width="50px" height="50px" /></span>';
	var user = '<span id="user_name"><a href="http://www.twitter.com/' + tweet.from_user + '">' + tweet.from_user + '</a>: </span>';
	var text = '<p class="tweet_text">' + tweet.text + ' </p>';
		html += '<div class="tweet">';
			html += image + '' + user;
			html += text.replace(regexp,"<a href=\"$1\" >$1</a>");
		html += '</div>';
		html += '</li>';
	return html;
}