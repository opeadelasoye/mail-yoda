<?php
    $userID = $_SESSION['user-ID'];
    $sqlInbox = "SELECT * FROM je_inbox WHERE $userID = je_email_to_id;";
    $result = $database->query($sqlInbox);
    $emailIDs = [];
    $currentPath = $_SERVER['REQUEST_URI'];

    while($row = $result->fetch_assoc()){
        $emailID = $row["je_email_id"];
        $emailIDs[] = $emailID;

        $_SESSION['from-' . $emailID] = $row["je_email_from_email"];
        $_SESSION['subject-' . $emailID] = $row["je_email_subject"];
        $_SESSION['content-' . $emailID] = $row["je_email_content"];
        $_SESSION['encrypted-' . $emailID] = $row["je_email_enc"];
        $_SESSION['date-' . $emailID] = $row["je_date_received"];
    }

    if(str_contains($currentPath, '&mail=')){
        $ID = $_GET['mail'];
        $content = $_SESSION['content-' . $ID];
        $subject = $_SESSION['subject-' . $ID];
        $date = $_SESSION['date-' . $ID];
        $from = $_SESSION['from-' . $ID];
        $encrypted = $_SESSION['encrypted-' . $ID];
?>
<div class="row">
    <div class="col-6">
        <p>From: <?php echo $from ?></p>    
    </div>
    <div class="col-6">
        <p>Date Received: <?php echo $date ?></p>
    </div>

    <div><p>Subject: <?php echo $subject ?></p></a></div>
    <hr>
    <div><p><?php if($encrypted == 1){echo "*This email is encrypted*<br><br>$content";}else{echo $content;} ?></p></div>
</div>
<?php
    }else{
        echo "<hr>";
        foreach($emailIDs as $ID){
            $content = $_SESSION['content-' . $ID];
            $subject = $_SESSION['subject-' . $ID];
            $date = $_SESSION['date-' . $ID];
            $from = $_SESSION['from-' . $ID];
            $encrypted = $_SESSION['encrypted-' . $ID];
?>
<div class="row">
    <div class="col-6">
        <p>From: <?php echo $from ?></p>    
    </div>
    <div class="col-6">
        <p>Date Received: <?php echo $date ?></p>
    </div>

    <div><p>Subject: <a href="?view=inbox&mail=<?php echo$ID?>"><?php echo $subject ?></p></a></div>
</div>
<hr>
<?php
        }
    }
?>