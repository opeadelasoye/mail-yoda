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
?>