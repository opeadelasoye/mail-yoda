<?php
    $userID = $_SESSION['user-ID'];
    
    
?>

<form class="mx-auto" style="width: 300px" method="post" action="compose.php">
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
        <input class="form-check-input" type="radio" name="compose-email" value="send" checked>
        <label class="form-check-label" for="send">Send</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="compose-email" value="encrypt-send">
        <label class="form-check-label" for="encrypt-send">Encrypt and Send</label>
    </div> 
    <div class="form-check">
        <input class="form-check-input" type="radio" name="compose-email" value="save">
        <label class="form-check-label" for="save">Save</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="compose-email" value="encrypt-save">
        <label class="form-check-label" for="encrypt-save">Encrypt and Save</label>
    </div> 
    <div class="form-check">
        <input class="form-check-input" type="radio" name="compose-email" value="cancel">
        <label class="form-check-label" for="cancel">Cancel</label>
    </div>
    <button class="btn btn-primary my-2 mx-auto d-block" type="submit" id="submit-button" >Submit</button>
</form>