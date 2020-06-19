<?php

//Initialize the session
session_start();

Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
} else if($_SESSION["isadmin"]){
    header("location: moveResults.php");
    exit;
}

?>
<html>

<head>
    <title>Results</title>
    <link rel="stylesheet" href="viewResults.css">
</head>

<body>

    <div id="navMenu">Results<button id="changePasswordBtn" onclick="window.location='changePassword.php'">Change Password</button><button id="logoutBtn" onclick="window.location='logout.php'">Logout</button></div>

    <div id="grid-container">
    </div>

    <script>
        var files = <?php $out = array();
                    $name = $_SESSION["name"];
                    $department = $_SESSION["department"];
                    $path = 'data/' . $department . '/' . $name . '/*';
                    foreach (glob($path) as $filename) {
                        $out[] = pathinfo($filename);
                    }
                    echo json_encode($out);
                    ?>;
        console.log(files);
        var i = 0;
        while (files[i]) {
            var div = document.createElement("div");
            div.setAttribute("class", "resultDisplayDiv");
            // div.setAttribute("width", "300px");
            // div.setAttribute("height", "250px");
            div.innerHTML = `
            <object data="` + files[i]["dirname"] + `/` + files[i]["basename"] + `" type="application/pdf" width="100%" height="300px">
                </object>
                <button class="downloadButton" onclick='window.open("` + files[i]["dirname"] + `/` + files[i]["basename"] + `");'>Download</button>`;
            document.getElementById("grid-container").appendChild(div);
            console.log(div);
            i += 1;
        }
    </script>

</body>

</html>