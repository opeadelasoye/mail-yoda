<!-- This code contains code re-used from code for my A3 in this course. This code is used with Prof. Raghav Sampangi's permission. 
This code is used as a starting point for my solution for A4. -->

<?php
    ini_set('display_errors', 1);
    
    require_once "includes/db.php";
    require "includes/functions.php";

    $pageHeader = "Login Page";
    $css = "css/main.css";
    $logo = "img/logo.jpg";
    $inbox = "#";
    $sent_drafts = "#";
    $compose = "#";
    $user_name = null;
    $sessionStarted = false;

    if(isset($_SESSION['user-ID'])){
        $sessionStarted = true;
        $user_name = $_SESSION['user-firstname'] . " " . $_SESSION['user-lastname'];
        $pageHeader = "Inbox";
    }

    getHeader($sessionStarted, $pageHeader, $css, $logo, $inbox, $sent_drafts, $compose, $user_name);
?>


    <main class="w-50 mx-auto">
        <?php
            if(!$sessionStarted){
        ?>
        <form class="mx-auto" style="width: 300px" method="post" action="includes/login.php" id="user-input">
            <div class="form-group my-3">
	    	    <label for="email-input" id="input-label">Email address</label>
   		        <input type="text" class="form-control" name="email" id="email-input" placeholder="Email">
		    </div>
      	    <div class="form-group my-3">	
			    <label for="password-input" id="input-label">Password</label>
                <input type="text" class="form-control" name="password" id="password-input" placeholder="Password">
	        </div>
	            <button class="btn btn-primary my-2 mx-auto d-block" type="submit" id="login-button" >Login</button>
        </form>
        <br>
        <div class="mx-auto" id="register-link">
            <a href="register.php">New to this MailYoda? Register here.</a>
        </div>
        <?php
            }else{
        ?>
        <div>
            
        </div>
        <?php
            }
        ?>
    </main>

<?php
    getFooter();
?>