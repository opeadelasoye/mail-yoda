<?php
    $userID = $_SESSION['user-ID'];
    $action = "send";

    if(isset($_POST["compose-email"])){
        switch($_POST["compose-email"]){
            case 'send':
                break;
            case 'encrypt-send':
                $action = "encrypt-send";
                break;                
            case 'save':
                $action = "save";
                break;
            case 'encrypt-save':
                $action = "encrypt-save";
                break;    
            case 'cancel':
                $action = "cancel";
        }
    }

    if(isset($_REQUEST["to-input"]) && $_POST["to-input"] != "" && isset($_REQUEST["subject-input"]) && isset($_REQUEST["message-input"]) && $_POST["message-input"] != ""){
        $to = $_POST["to-input"];
        $from = $_SESSION['user-ID'];
        $subject = $_POST["subject-input"];
        $message = $_POST["message-input"];
        $datetime = date('Y-m-d H:m:s');
        switch($action){
            case 'cancel':
                break;
            case 'save':
                $database->query("INSERT INTO je_email_sentdrafts (je_sentdraft_to_email, je_sentdraft_from_id, je_sentdraft_subject, je_sentdraft_content, je_sentdraft_draft, je_sentdraft_enc, je_sentdraft_datetime) 
                                VALUES ('$to', $from, '$subject', '$message', 1, 0, '$datetime');");
                break;
            case 'send':
                $database->query("INSERT INTO je_email_sentdrafts (je_sentdraft_to_email, je_sentdraft_from_id, je_sentdraft_subject, je_sentdraft_content, je_sentdraft_draft, je_sentdraft_enc, je_sentdraft_datetime) 
                                VALUES ('$to', $from, '$subject', '$message', 0, 0, '$datetime');");

                $result = $database->query("SELECT je_login_email, je_login_id FROM je_login WHERE je_login_email = '$to';");
                if($result->num_rows > 0){
                    $result = $result->fetch_assoc();
                    $from = $_SESSION['user-email'];
                    $to = $result["je_login_id"];
                    $datetime = date('Y-m-d H:m:s');

                    $database->query("INSERT INTO je_inbox (je_email_from_email, je_email_to_id, je_email_subject, je_email_content, je_email_enc, je_date_received)
                                    VALUES ('$from', $to, '$subject', '$message', 0, '$datetime');");
                }
                break;
            case 'encrypt-save':
                $message = encryptMessage($message);
                $database->query("INSERT INTO je_email_sentdrafts (je_sentdraft_to_email, je_sentdraft_from_id, je_sentdraft_subject, je_sentdraft_content, je_sentdraft_draft, je_sentdraft_enc, je_sentdraft_datetime) 
                                VALUES ('$to', $from, '$subject', '$message', 1, 1, '$datetime');");
                break;
            case 'encrypt-send':
                $message = encryptMessage($message);
                $database->query("INSERT INTO je_email_sentdrafts (je_sentdraft_to_email, je_sentdraft_from_id, je_sentdraft_subject, je_sentdraft_content, je_sentdraft_draft, je_sentdraft_enc, je_sentdraft_datetime) 
                                VALUES ('$to', $from, '$subject', '$message', 0, 1, '$datetime');");

                $result = $database->query("SELECT je_login_email, je_login_id FROM je_login WHERE je_login_email = '$to';");
                if($result->num_rows > 0){
                    $result = $result->fetch_assoc();
                    $from = $_SESSION['user-email'];
                    $to = $result["je_login_id"];
                    $datetime = date('Y-m-d H:m:s');

                    $database->query("INSERT INTO je_inbox (je_email_from_email, je_email_to_id, je_email_subject, je_email_content, je_email_enc, je_date_received)
                                    VALUES ('$from', $to, '$subject', '$message', 1, '$datetime');");
                }
        }
    }
?>

<form class="mx-auto" style="width: 300px" method="post" action="index.php?view=compose">
    <div class="form-group my-3">
		<label for="to-input" id="input-label">To:</label>
        <input type="text" class="form-control" name="to-input">
	</div>
    <div class="form-group my-3">
		<label for="from-input" id="input-label">From:</label>
        <input type="text" class="form-control" name="from-input" value="<?php echo $_SESSION['user-email']; ?>" disabled>
	</div>
    <div class="form-group my-3">
		<label for="subject-input" id="input-label">Subject:</label>
        <input type="text" class="form-control" name="subject-input">
	</div> 
    <div class="form-group my-3">
	    <label for="message-input">Message:</label>
        <textarea class="form-control" id="message-input" name="message-input"></textarea>
	</div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="compose-email" value="send" id="send" checked>
        <label class="form-check-label" for="send">Send</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="compose-email" value="encrypt-send" id="encrypt-send">
        <label class="form-check-label" for="encrypt-send">Encrypt and Send</label>
    </div> 
    <div class="form-check">
        <input class="form-check-input" type="radio" name="compose-email" value="save" id="save">
        <label class="form-check-label" for="save">Save</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="compose-email" value="encrypt-save" id="encrypt-save">
        <label class="form-check-label" for="encrypt-save">Encrypt and Save</label>
    </div> 
    <div class="form-check">
        <input class="form-check-input" type="radio" name="compose-email" value="cancel" id="cancel">
        <label class="form-check-label" for="cancel">Cancel</label>
    </div>
    <button class="btn btn-primary my-2 mx-auto d-block" type="submit" id="submit-button" >Submit</button>
</form>