<?php

// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
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
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.1.0/papaparse.min.js">
    </script>

</head>

<body>
    <input type="text" id="newDept" required />
    <button type="submit" id="submit-newDept" class="btn btn-primary">Create Depatment</button>
    <script>
        $('#submit-newDept').on("click", function (e) {
                    e.preventDefault();
                    console.log("calling post")
                    $.post('/Result-Management/createDept1.php', {
                        Dept: document.getElementById("newDept").value
                    }, function (data) {
                        console.log("from other side");
                        console.log(data);
                    });
                });

    </script>


</body>

</html>