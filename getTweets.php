<?php

require __DIR__ . '/vendor/autoload.php';

$account = new \Bissolli\TwitterScraper\Twitter('BRossovsky');

$account->loadTweets();

echo "<pre>";
var_export($account->getTweets());
echo "</pre>";
?>
