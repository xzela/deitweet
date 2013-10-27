<?php

include 'twitter.methods.php';

$result = callTwitterPlease();
$de_json = json_decode($result, true);
//var_dump($de_json['statuses']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Deitweet.com - Where's your God Now?</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="description" content="A Special twitter feed which follows all types of gods. Including: god, allah, xenu, satan, and jesus" />
    <meta name="keywords" content="twitter, god, xenu, jesus, allah, deity" />

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script type="text/javascript" src="jquery.timer.js"></script>
    <script type="text/javascript" src="twitter.methods.script.js"></script>

    <link rel="stylesheet" type="text/css" href="styles.css" />
    <script type='text/javascript'>
    var seconds = 10000;
    var token = 0;
    $('document').ready(function () {
        //getTweetsPlease(true);
        setInterval(function() {
            getTweetsPlease(token);
            token++;
        },seconds);
    });
    </script>
</head>
<body>
    <div id='container'>
        <div id='header'>
            <h1>Which Deity Is the Most Tweetable?</h1>
        </div>
        <div id="rightnav">
            <h2>Not doing much?</h2>
            <h4>Try these fun games!</h4>
            <ul>
                <li>
                    <strong>DnD (Deity-N-Drink)</strong>
                    Pick your favorite deity. When that deity is not mentioned, take a drink.
                </li>
            </ul>
        </div>
        <div id='content'>
            <p class='center_text' >
                Which deity gets the most shout outs on Twitter? Find out by watching the feed!
            </p>
            <div>
                <ul id='tweet_feed'>
                    <?php if(empty($de_json['errors'])): ?>
                        <?php foreach($de_json['statuses'] as $tweet): ?>
                            <li id="<?php echo $tweet['user']['id']; ?>">
                                <div class='tweet'>
                                    <span id="image"><img src="<?php echo $tweet['user']['profile_image_url']; ?>" width="50px" height="50px" /></span>
                                    <span id="user_name"><a href="http://www.twitter.com/<?php echo $tweet['user']['screen_name']; ?>"><?php echo $tweet['user']['screen_name']; ?></a>: </span>
                                    <p class="tweet_text"><?php echo $tweet['text']; ?></p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>
                            Error connecting or something... :(
                            <br />
                            <div><?php echo $de_json['errors'][0]['message']; ?></div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>