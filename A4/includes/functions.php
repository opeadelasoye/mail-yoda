<!-- This code contains code re-used from code for my A3 in this course. This code is used with Prof. Raghav Sampangi's permission. 
This code is used as a starting point for my solution for A4. -->

<?php
    /** Sanitize inputted data */
    function sanitizeData($data){
        $sanitizedData = stripslashes($data);
        $sanitizedData = trim($sanitizedData);
        $sanitizedData = htmlspecialchars($sanitizedData);

        return $sanitizedData;
    }

    /** Retrieve header content */
    function getHeader($sessionStarted, $pageHeader, $css, $logo, $inbox, $sent_drafts, $compose, $user_name){
        $sessionStarted; $pageHeader; $css; $logo; $inbox; $sent_drafts; $compose; $user_name;
        return require "includes/header.php";
    }

    /** Retrieve footer content */
    function getFooter(){
        return require "includes/footer.php";
    }

    /** Encrypt message */
    function encryptMessage($message){
        $regex_1 = "/c.+p/"; $regex_2 = "/T.+p/i"; $regex_3 = "/e.+t/i"; $regex_4 = "/a.+e/i";
        $regex_5 = "/a.*w/i"; $regex_6 = "/c.+e/i"; $regex_7 = "/u.+e/";
        $regex_jedi = "/@jediacademy.edu$/"; $regex_force = "/@theforce.org$/"; $regex_dal = "/@dal.ca$/";

        $encryptedMessage = "";
        $words = explode(" ", $message);

        $patterns = [$regex_1, $regex_2, $regex_3, $regex_4, $regex_5, $regex_6, $regex_7, $regex_jedi, $regex_force, $regex_dal];

        foreach($words as $word){
            foreach($patterns as $regex){
                if(preg_match($regex, $word, $matches)){
                    $characters = str_split($matches[0]);
                    $index = 0;
                    $matchEncrypted = "";
                    foreach($characters as $character){
                        $asciiValue = ord($character);
                        $asciiValue += $asciiValue % 16;  
                        if($asciiValue > 126){
                            $asciiValue = 126;
                        }else if($asciiValue < 33){
                            $asciiValue = 33;
                        }
                        $matchEncrypted .= chr($asciiValue);
                        $index++;  
                    }
                    $word = preg_replace($regex, "\$eas\$" . $matchEncrypted, $word);
                    break;
                }
            }
            $encryptedMessage .= "$word ";
        }

        return $encryptedMessage;
    }
?>