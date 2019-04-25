<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <title>The Watcher</title>
    <script src="js/camvas.js"></script>
    <script src="js/pico.js"></script>
    <script src="js/facedetect.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="theWrapper">
        <?php
            $twitteruser = "Twitter";
            $allgood = true;
            
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

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off">
            Twitter username: <input type="text" name="twitter" id="twitterusername" value="<?php echo $twitteruser;?>">
            <input type="submit" name="submit" value="Submit">
            <p>Press F2 to enter username.</p>
        </form>

        <?php
                require __DIR__ . '/vendor/autoload.php';
                try {
                    $account = new \Bissolli\TwitterScraper\Twitter($twitteruser);
                    $trackarray = [
                        "name" => $account->getTwitterAccountName(), 
                        "avatar" => $account->getTwitterAvatarURL(),
                        "birthday" => $account->getTwitterAccountBirthday()
                    ];
                }
                catch (Exception $e) {
                    $allgood = false;
                    echo '<center>Please make sure you spelled everything correctly.</center>';
                }
        ?>

        <div id="theWrapper" class="infoWrapper infoSize hidden">
            <canvas width=640 height=480 id="faceTracker"></canvas>
            <div id="dataOverlay" class="ontop infoSize">
                <div id="userBio">
                    <div class="padded darkened bgbox">
                        <h2>Bio</h2>
                        <?php echo $account->getTwitterAccountBio(); ?>
                    </div>
                    <div class="padded mt">
                        <a href="<?php echo $account->getTwitterAccountWebsite(); ?>"
                            target="_blank"><?php echo $account->getTwitterAccountWebsite(); ?></a>
                    </div>
                </div>
                <div id="recentTweets">
                    <h2>Recent</h2>
                    <?php
                        $contentCounter = 0;
                        for ($i = 0; $i < $account->getTweetsAmount() && $contentCounter < 3; $i++) {
                            if ($account->getTweetContent($i)) {
                                echo '<div class="padded darkened bgbox mb tweettext">';
                                    echo '<div class="left">';
                                        echo '<img src="'. $account->getTwitterAvatarURL() .'" class="avatarimg">';
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
            <div id="lockOverlay" class="hidden ontop2 infoSize darkened centreflex">
            <p>🔒</p>
            <p>YOU ARE PROTECTED</p>
            </div>
        </div>
        <div id="theWatcherLogo" class="mt-large">
            <svg id="TheWatcherLogo" data-name="TheWatcherLogo 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 996.51 460.98">
                <title>TheWatcherLogo</title>
                <path d="M74.39,610.41H44.15l3.38-17.8h81.79l-3.53,17.8H95.56L79.14,692.66h-21Z"
                    transform="translate(-44.15 -233.52)" />
                <path d="M144.82,592.61h21l-8,38.82h29.93l7.67-38.82h21l-19.95,100h-21l8.59-42.81H154.33l-8.44,42.81h-21Z"
                    transform="translate(-44.15 -233.52)" />
                <path
                    d="M242.26,592.61h65.22l-3.38,17.64H259.6l-4.3,21.8h37.14l-3.37,17.64H251.93L246.71,675h45.73l-3.37,17.65H222.16Z"
                    transform="translate(-44.15 -233.52)" />
                <path
                    d="M412.44,592.45h19.95l-7.22,56.63c-.76,7.21-2.45,18-3.53,24.4h.62c2.45-7.06,6.6-18.11,9.36-24.55l13.2-30.39h13.35l1.53,28.54c.31,5.53.46,18,.46,26.09h.77c1.38-6.44,4-17.64,5.68-24.4l14.73-56.32h20L470.6,692.66H447.27V660c-.15-6.3,0-14,.31-19.34h-.46c-1.69,5.68-4.15,13-6.45,19.34l-12.43,32.68H404.3Z"
                    transform="translate(-44.15 -233.52)" />
                <path
                    d="M537.35,592.61h25l10.44,100H550.7l-1.23-25.16H520.31l-11.2,25.16H485.94Zm-10,59.08H548.7l-.61-13.2c-.62-9.82-.92-19.49-1.38-29.77h-.62c-4.29,9.82-8.28,19.64-12.73,29.62Z"
                    transform="translate(-44.15 -233.52)" />
                <path d="M626.81,610.41H596.58l3.37-17.8h81.8l-3.53,17.8H648l-16.41,82.25h-21Z"
                    transform="translate(-44.15 -233.52)" />
                <path
                    d="M687.27,652.61c0-34.53,23.32-61.84,53.25-61.84,11.66,0,21,6,26.54,16l-14.27,11c-3.68-5.83-7.82-8.74-13.35-8.74-17,0-30.54,20-30.54,42.2,0,15.5,6,25.17,20.87,25.17,5.84,0,11.82-3.23,16.88-7.68l8.9,13.51c-6.13,5.52-16.57,12.27-30.23,12.27C702.15,694.5,687.27,678.85,687.27,652.61Z"
                    transform="translate(-44.15 -233.52)" />
                <path d="M789.31,592.61h21l-8,38.82h29.92L840,592.61h21l-20,100H820l8.6-42.81H798.83l-8.44,42.81h-21Z"
                    transform="translate(-44.15 -233.52)" />
                <path
                    d="M886.75,592.61H952l-3.37,17.64H904.09l-4.29,21.8h37.13l-3.37,17.64H896.42L891.2,675h45.73l-3.37,17.65H866.65Z"
                    transform="translate(-44.15 -233.52)" />
                <path
                    d="M975.29,592.61h30.54c19.64,0,34.84,7.06,34.84,26.55,0,18.1-11.36,29.15-25.78,33.91l16.26,39.59h-23.32L994.63,656h-11l-7.21,36.67H955.19Zm20.87,46.65c14.89,0,23.33-7.06,23.33-18,0-8.44-5.68-12-16.57-12H992.79L987,639.26Z"
                    transform="translate(-44.15 -233.52)" />
                <path
                    d="M589.92,342.35c9,14.34-7.74,39.81-19.82,67.07-.58-13-5.75-27.4-10.67-41.77-5,14.37-10.29,28.79-10.89,41.72-12.12-27.25-28.71-52.63-19.6-67a69.14,69.14,0,0,1,9-5.58c-2.42,10.59,1.38,23.59,6.55,37.54,2.71-8,6.06-16.36,9.09-24.78a186.47,186.47,0,0,0,5.81-18.23,190.7,190.7,0,0,0,5.67,18.23c3,8.41,6.37,16.77,9.08,24.79,5.22-14,9.08-27,6.7-37.55A69.81,69.81,0,0,1,589.92,342.35Z"
                    transform="translate(-44.15 -233.52)" />
                <path
                    d="M812.12,399.32c-2-9.71-10.27-20.13-16.89-28.5-1.7-2.14-3.3-4.16-4.56-5.89C742,298.62,664.6,252.41,578.22,238.14c-89.53-14.78-179.18,6.26-246,57.73l-.5.39c-8.19,6.31-16.66,12.83-22.11,23.41-9.84,19.13,1.87,34.69,11.28,47.18,1.7,2.27,3.31,4.4,4.83,6.57,16.55,23.66,38.31,44.35,66.5,63.25,60.14,40.32,137.42,62.71,214.88,62.71q10.65,0,21.3-.57c45.79-2.45,86.48-13.15,121-31.79a212,212,0,0,0,49.76-36.92l1.94-1.94C809,420.32,815.2,414.13,812.12,399.32Zm-252.69,79.5A107.79,107.79,0,1,1,667.21,371,107.9,107.9,0,0,1,559.43,478.82ZM338.31,364.63c-1.67-2.39-3.43-4.73-5.14-7-9.51-12.63-15.07-20.88-9.89-30.94,3.88-7.54,10.34-12.52,17.83-18.29l.5-.38c50.09-38.61,113.84-59.17,180.47-59.17q10,0,20.09.62C482.6,257.89,436.63,309.18,436.63,371a122.51,122.51,0,0,0,40.08,90.68,342,342,0,0,1-75.92-37.79C374.2,406.11,353.76,386.71,338.31,364.63Zm452,52.66-2,2a196.55,196.55,0,0,1-46.18,34.24c-32.47,17.56-71,27.64-114.49,30-6.7.36-13.4.52-20.11.53A122.78,122.78,0,0,0,618,263.15C683.13,282.87,740.11,321.92,778.31,374c1.43,1.95,3.11,4.08,4.89,6.33,5.33,6.74,12.63,15.95,13.91,22.11C798.49,409.12,797.4,410.21,790.28,417.29Z"
                    transform="translate(-44.15 -233.52)" />
            </svg>
        </div>
        

        <script>
            button_callback(<?php echo json_encode($trackarray); ?>, <?php echo $contentCounter; ?>);
        </script>
    </div>
</body>

</html>