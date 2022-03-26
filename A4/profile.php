<!-- This code contains code re-used from code for my A3 in this course. This code is used with Prof. Raghav Sampangi's permission. 
This code is used as a starting point for my solution for A4. -->

<?php
	ini_set('display_errors', 1);
    require_once "includes/functions.php";
    require_once "includes/db.php";

    $userID = $_SESSION['user-ID'];

    $passwordLength = strlen($_SESSION['user-password']);
    $passwordHidden = "*";

    for($i = 1; $i < $passwordLength; $i++){
        $passwordHidden = $passwordHidden . "*";  
    }

    if(isset($_REQUEST["first-name"]) && $_POST["first-name"] != ""){
        $firstName = sanitizeData($_POST["first-name"]);
        $sql = "UPDATE cb_users
                    SET cb_user_firstname = '$firstName'
                    WHERE cb_user_id = '$userID';";

        $database->query($sql);
    }
    if(isset($_REQUEST["last-name"]) && $_POST["last-name"] != ""){
        $lastName = sanitizeData($_POST["last-name"]);
        $sql = "UPDATE je_users
                    SET je_user_lastname = '$lastName'
                    WHERE je_user_id = '$userID';";
                    
        $database->query($sql);
    }
    if(isset($_REQUEST["email"]) && $_POST["email"] != ""){
        $email = sanitizeData($_POST["email"]);
        $sql = "UPDATE je_login
                    SET je_login_email = '$email'
                    WHERE je_login_id = '$userID';";
                    
        $database->query($sql);
    }
    if(isset($_REQUEST["password"]) && $_POST["password"] != ""){
        $password = sanitizeData($_POST["password"]);
        $sql = "UPDATE je_login
                    SET je_login_password
                    WHERE je_login_id = '$userID';";
                    
        $database->query($sql);
    }

    $sessionStarted = true;
    $pageHeader = "Profile";
	$css = "css/main.css";
	$logo = "img/logo.jpg";
    $inbox = "index.php?view=inbox";
    $sent_drafts = "index.php?view=sentdrafts";
    $compose = "index.php?view=compose";
    $user_name = $_SESSION['user-firstname'] . " " . $_SESSION['user-lastname'];
    
    getHeader($sessionStarted, $pageHeader, $css, $logo, $inbox, $sent_drafts, $compose, $user_name);
?>

    <main class="w-50 mx-auto">
        <?php echo "<h5 class=\"text-center\">Welcome, $user_name</h5>"; ?>

        <img src="img/user-profile.jpg" alt="Profile picture template" class="mx-auto d-block">

        <form class="mx-auto" style="width: 300px" method="post" action="profile.php" id="user-input">
            <div class="form-group my-3">
				<label for="first-name-input" id="input-label">First name: <?php echo $_SESSION['user-firstname'];?></label>
        		<input type="text" class="form-control" name="first-name" id="first-name-input" placeholder="Update first name">
			</div>
            <div class="form-group my-3">
				<label for="last-name-input" id="input-label">Last name: <?php echo $_SESSION['user-lastname'];?></label>
        		<input type="text" class="form-control" name="last-name" id="last-name-input" placeholder="Update last name">
			</div>
            <div class="form-group my-3">
				<label for="email-input" id="input-label">Email address: <?php echo $_SESSION['user-email'];?></label>
        		<input type="text" class="form-control" name="email" id="email-input" placeholder="Update email">
			</div>
        	<div class="form-group my-3">
				<label for="password-input" id="input-label">Password:<p id="password"> <?php echo "$passwordHidden";?></p></label>
        		<input type="hidden" class="form-control" name="password" id="password-input" placeholder="Update password" disabled>
			</div>
        	<button class="btn btn-primary my-2 mx-auto d-block" type="submit" id="submit-button" >Submit Changes</button>
		</form>
        <p class="text-center">(Logout to see updated changes.)</p>

	</main>    

<?php
	getFooter();
?>