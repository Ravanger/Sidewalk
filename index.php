<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
	<title>Detect yo face</title>
	<script src="js/camvas.js"></script>
	<script src="js/pico.js"></script>
	<script src="js/facedetect.js"></script>
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
            $valarray = [
                "name" => $account->getTwitterAccountName(), 
                "avatar" => $account->getTwitterAvatarURL(),
                "website" => $account->getTwitterAccountWebsite(),
                "locale" => $account->getTwitterAccountLocale(),
                "bio" => $account->getTwitterAccountBio(),
                "birthday" => $account->getTwitterAccountBirthday()
            ];

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
	<div>
		<input type="button" value="Start real-time face detection" onclick='button_callback(<?php echo json_encode($valarray); ?>);' />
    </div>

	
	<canvas width=640 height=480></canvas>
</body>

</html>