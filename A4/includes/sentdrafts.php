<?php
    $userID = $_SESSION['user-ID'];
    $sqlSentDrafts = "SELECT * FROM je_email_sentdrafts WHERE $userID = je_sentdraft_from_id;";
    $result = $database->query($sqlSentDrafts);
    $sentdraftIDs = [];
    $currentPath = $_SERVER['REQUEST_URI'];

    while($row = $result->fetch_assoc()){
        $sentdraftID = $row["je_sentdraft_id"];
        $sentdraftIDs[] = $sentdraftID;

        $_SESSION['to-' . $sentdraftID] = $row["je_sentdraft_to_email"];
        $_SESSION['subject-' . $sentdraftID] = $row["je_sentdraft_subject"];
        $_SESSION['content-' . $sentdraftID] = $row["je_sentdraft_content"];
        $_SESSION['encrypted-' . $sentdraftID] = $row["je_sentdraft_enc"];
        $_SESSION['draft-' . $sentdraftID] = $row["je_sentdraft_draft"];
        $_SESSION['date-' . $sentdraftID] = $row["je_sentdraft_datetime"];
    }

    if(str_contains($currentPath, '&mail=')){
        $ID = $_GET['mail'];
        $content = $_SESSION['content-' . $ID];
        $subject = $_SESSION['subject-' . $ID];
        $date = $_SESSION['date-' . $ID];
        $to = $_SESSION['to-' . $ID];
        $encrypted = $_SESSION['encrypted-' . $ID];
        $draft = $_SESSION['draft-' . $ID];
?>
<div class="row">
    <div class="col-6">
        <p>To: <?php echo $to ?></p>    
    </div>
    <div class="col-6">
        <p>Date Received: <?php echo $date ?></p>
    </div>

    <div><p>Subject: <?php echo $subject ?></p></a></div>
    <hr>
    <div><p><?php echo $content ?></p></div>
</div>
<?php
    }else{
        echo "<hr>";
        foreach($sentdraftIDs as $ID){
            $content = $_SESSION['content-' . $ID];
            $subject = $_SESSION['subject-' . $ID];
            $date = $_SESSION['date-' . $ID];
            $to = $_SESSION['to-' . $ID];
            $encrypted = $_SESSION['encrypted-' . $ID];
?>
<div class="row">
    <div class="col-6">
        <p>To: <?php echo $to ?></p>    
    </div>
    <div class="col-6">
        <p>Date Sent/Saved: <?php echo $date ?></p>
    </div>

    <div><p>Subject: <a href="?view=sentdrafts&mail=<?php echo$ID?>"><?php echo $subject ?></p></a></div>
</div>
<hr>
<?php
        }
    }
?>