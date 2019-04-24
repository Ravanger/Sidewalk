<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <title>Detect yo face</title>
    <script src="js/camvas.js"></script>
    <script src="js/pico.js"></script>
    <script src="js/facedetect.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="theWrapper">
        <?php
            $twitteruser = "Twitter";
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (!empty($_POST["twitter"]))
                {
                    $twitteruser = test_input($_POST["twitter"]);
                }
            }

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Twitter username: <input type="text" name="twitter" value="<?php echo $twitteruser;?>">
            <input type="submit" name="submit" value="Submit">
        </form>

        <?php
                require __DIR__ . '/vendor/autoload.php';
                $account = new \Bissolli\TwitterScraper\Twitter($twitteruser);
                $trackarray = [
                    "name" => $account->getTwitterAccountName(), 
                    "avatar" => $account->getTwitterAvatarURL(),
                    "birthday" => $account->getTwitterAccountBirthday()
                ];
        ?>

        <div class="infoWrapper infoSize">
            <canvas width=640 height=480 id="faceTracker"></canvas>
            <div id="dataOverlay" class="infoSize">
                <div class="bluebox">
                    <h2>Bio</h2>
                    <?php echo $account->getTwitterAccountBio(); ?>
                </div>
                <div>
                    <a href="<?php echo $account->getTwitterAccountWebsite(); ?>"
                        target="_blank"><?php echo $account->getTwitterAccountWebsite(); ?></a>
                </div>
                <div id="recentTweets">
                    <h2>Recent</h2>
                    <?php
                        $contentCounter = 0;
                        for ($i = 0; $i < $account->getTweetsAmount() && $contentCounter < 3; $i++) {
                            if ($account->getTweetContent($i)) {
                                echo '<div class="bluebox mb tweettext">';
                                    echo '<div class="left">';
                                        echo '<img src="'. $account->getTwitterAvatarURL() .'">';
                                    echo '</div>';
                                    echo '<div class="right">';
                                        echo  $account->getTweetContent($i);
                                    echo '</div>';
                                echo '</div>';
                                $contentCounter++;
                            }
                        }
                    ?>
                </div>
            </div>
        </div>

        <script>button_callback(<?php echo json_encode($trackarray); ?>);</script>
    </div>
</body>

</html>