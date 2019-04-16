<html>

<head>
    <title>Twitter Profile</title>
</head>

<body>
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

        echo "<div>";
            echo $account->getTwitterAccountName();
        echo "</div>";
        echo "<div>";
            echo "<img src='".$account->getTwitterAvatarURL()."'>";
        echo "</div>";
        echo "<div>";
            echo "<a href='".$account->getTwitterAccountWebsite()."' target='_blank'>".$account->getTwitterAccountWebsite()."</a>";
        echo "</div>";
        echo "<div>";
            echo $account->getTwitterAccountLocale();
        echo "</div>";
        echo "<div>";
            echo $account->getTwitterAccountBio();
        echo "</div>";
        echo "<div>";
            echo $account->getTwitterAccountBirthday();
        echo "</div>";
    ?>
</body>

</html>
