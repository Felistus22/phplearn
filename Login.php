<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <style>
        body{
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Welcome <?php //echo $_SESSION["Username"]; 
        if (isset($_SESSION["Username"])) {
            echo "<h2>Welcome {$_SESSION["Username"]}</h2>";
        } else {
            // Handle the case where the user is not logged in
            echo $_SESSION["Username"];
        }
    ?></h2>
    Click <a href='logout.php'>here</a> to Logout
</body>
</html>