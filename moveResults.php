<?php

//Initialize the session
session_start();
Check if the user is already logged in, if yes then redirect him to welcome page
if (!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
} 
if ($_SESSION["isadmin"] == 0) {
    header("location: viewResults.php");
    exit;
}

?>
<html>

<head>
    <style>
    </style>
    <title>Results</title>
    <link rel="stylesheet" href="moveResults.css">


</head>

<body>

    <div id="navMenu">Results<button id="changePasswordBtn" onclick="window.location='changePassword.php'">Change Password</button><button id="logoutBtn" onclick="window.location='logout.php'">Logout</button></div>



    <div id="grid-container">
    </div>
        <div id="moveResultDiv">
            <p id="yesMove" style="display:none"></p>
            <p id="noMove">There are no Results to be moved.</p>
            <button id="resultUpload" onclick="window.location='moveIt.php'" style="display:none">Move It!</button>
        </div>
    <script>
        console.log("movin it!");
        var filesCheck = <?php $out = array();
                            foreach (glob('input/*') as $filename)
                                $out[] = pathinfo($filename);
                            echo json_encode($out);
                            ?>;
        if (filesCheck[0]) {
            document.getElementById("resultUpload").style.display = "";
            document.getElementById("yesMove").innerHTML = "There are " + filesCheck.length + " Results to be moved.";
            document.getElementById("noMove").style.display = "none";
            document.getElementById("yesMove").style.display = "";
        }
    </script>
</body>

</html>