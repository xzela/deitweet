
var regexp = /((ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?)/gi;

function getTweetsPlease(str) {
	$.post('twitter.api.call.php', {j:str},
		function(data) {
			tweets = data.statuses;
			list = $('#tweet_feed');
			if(tweets !== null) {
				// pull the first tweet, ignore the rest!
				html = formatTweetPlease(tweets[0]);
				list.prepend(html);
				$('#' + tweets[0].id).attr('style', 'display:none').slideDown('slow');
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
	var image = '<span id="image"><img src="' + tweet.user.profile_image_url + '" width="50px" height="50px" /></span>';
	var user = '<span id="user_name"><a href="http://www.twitter.com/' + tweet.user.screen_name + '">' + tweet.user.screen_name + '</a>: </span>';
	var text = '<p class="tweet_text">' + tweet.text + ' </p>';
		html += '<div class="tweet">';
			html += image + '' + user;
			html += text.replace(regexp,"<a href=\"$1\" >$1</a>");
		html += '</div>';
		html += '</li>';
	return html;
}