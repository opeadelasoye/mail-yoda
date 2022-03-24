<!-- This code contains code re-used from code for my A3 in this course. This code is used with Prof. Raghav Sampangi's permission. 
This code is used as a starting point for my solution for A4. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1, initial-scale=1.0">
    <title><?php echo $pageHeader; ?></title>

	<!-- Link to main css file -->
    <link href=<?php echo $css;?> rel="stylesheet">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand navbar-light" id="navigation">
        <a class="navbar-brand">
            <img src=<?php echo $logo;?> id="logo" alt="Drawing of an envelope by Lue Hang" width="100" height="50">
        </a>
        <div class="navbar-nav" id="nav">
            <ul class="navbar-nav">
            <?php
			    if(!$sessionStarted){
		    ?>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
            <?php
                }else{
            ?>
                <li class="nav-item">
                    <a id="nav-item-text" class="nav-link" href=<?php echo $inbox;?>>Inbox</a>
                </li>
                <li class="nav-item">
                    <a id="nav-item-text" class="nav-link" href=<?php echo $sent_drafts;?>>Sent/Drafts</a>
                </li>
                <li class="nav-item">
                    <a id="nav-item-text" class="nav-link" href=<?php echo $compose;?>>Compose</a>
                </li>
            </ul>
            <div class="dropdown show">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $user_name; ?>
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="includes/logout.php">Logout</a>
                </div>
            </div>
            <?php
			    }
		    ?>
        </div>
    </nav>
	<br>
    <header>
		<h2 class="text-center"><?php echo $pageHeader; ?></h2>
	</header>