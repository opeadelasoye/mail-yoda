<?php
    ini_set('display_errors', 1);

    require_once "includes/db.php";
    require "includes/functions.php";

    $pageHeader = "Register Page";
    $css = "css/main.css";
    $logo = "img/logo.jpg";
    $regex_jedi = "/@jediacademy.edu$/";
    $regex_force = "/@theforce.org$/";
    $regex_dal = "/@dal.ca$/";
    $regex_name = "/^[A-Z]/";

    $validEmail = false;
    $validFirstName = false;
    $validLastName = false;

    getHeader(null, $pageHeader, $css, $logo, null, null, null, null);

    if(isset($_REQUEST["first-name"]) && isset($_REQUEST["last-name"]) && isset($_REQUEST["email"]) && isset($_REQUEST["password"])){
        $first_name = sanitizeData($_POST["first-name"]);
        $last_name = sanitizeData($_POST["last-name"]);
        $email = sanitizeData($_POST["email"]);
        $password = sanitizeData($_POST["password"]);
        $password = password_hash($password, PASSWORD_BCRYPT);
        
        if(!preg_match($regex_jedi, $email) && !preg_match($regex_force, $email) && !preg_match($regex_dal, $email)){
            echo "Invalid email<br>";
        }else{
            $validEmail = true;
        }

        if(!preg_match($regex_name, $first_name)){
            echo "Invalid first name<br>";
        }else{
            $validFirstName = true;
        }

        if(!preg_match($regex_name, $last_name)){
            echo "Invalid last name";
        }else{
            $validLastName = true;
        }

        if($validEmail && $validFirstName && $validLastName){
            $sql = "INSERT INTO je_login (je_login_email, je_login_password)
                    VALUES ('$email', '$password');";
            $database->query($sql);

            $ID = "SELECT je_login_id FROM je_login
                    WHERE je_login_email = '$email' AND je_login_password = '$password';";
            $ID = $database->query($ID)->fetch_assoc()['je_login_id'];         

            $sql = "INSERT INTO je_users (je_user_firstname, je_user_lastname, je_user_login_id, je_user_role, je_user_suspended)
                    VALUES ('$first_name', '$last_name', $ID, 0, 0);";
            $database->query($sql);

            header("Location: index.php");
        }
    }
?>

    <main class="w-50 mx-auto">
        <form class="mx-auto" style="width: 300px" method="post" action="register.php" id="user-input">
      	    <div class="form-group my-3">	
			    <label for="first-name-input" id="input-label">First Name</label>
                <input type="text" class="form-control" name="first-name" id="first-name-input" placeholder="Ope">
	        </div>
      	    <div class="form-group my-3">	
			    <label for="last-name-input" id="input-label">Last Name</label>
                <input type="text" class="form-control" name="last-name" id="last-name-input" placeholder="Adelasoye">
	        </div>
            <div class="form-group my-3">
	    	    <label for="email-input" id="input-label">Email address</label>
   		        <input type="text" class="form-control" name="email" id="email-input" placeholder="opeadelasoye@jediacademy.edu">
		    </div>
      	    <div class="form-group my-3">	
			    <label for="password-input" id="input-label">Password</label>
                <input type="text" class="form-control" name="password" id="password-input" placeholder="Password">
	        </div>
	            <button class="btn btn-primary my-2 mx-auto d-block" type="submit" id="register-button" >Register</button>
        </form>    
        <br>
        <div class="mx-auto" id="login-link">
            <a href="index.php">Already have an account? Login here.</a>
        </div>
    </main>

<?php
    getFooter();
?>