<html>
<?php


// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

    // Include config file
    require_once "config.php";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $name = $_SESSION["name"];
    $oldpassword = $_POST["opassword"];
    $newpassword = $_POST["npassword"];
    $rnewpassword = $_POST["rnpassword"];

    $sql1 = "SELECT password FROM users WHERE name = '$name'";

    $result1 =  mysqli_query($link, $sql1);
    $temp = mysqli_fetch_assoc($result1);
    $hashed_password = $temp["password"];
    if (password_verify($oldpassword, $hashed_password)) {
        if($newpassword == $rnewpassword){
        // Creates a password hash
        $hashed_newpassword = "'" . password_hash($newpassword, PASSWORD_DEFAULT) . "'";

        $sql = "UPDATE users SET password=$hashed_newpassword WHERE name = '$name'";
        if (mysqli_query($link, $sql)) {
            // Redirect user to welcome page
            header("location: logout.php");
        }
    }
    else{
        echo "<script type='text/javascript'>alert('New passwords do not match.');</script>";
    }
    } else {
        echo "<script type='text/javascript'>alert('The password you entered is incorrect.');</script>";
    }
}
// Close connection
mysqli_close($link);

?>

<head>
    <link rel="stylesheet" type="text/css" href="changePassword.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <div id="navMenu">
        Results
        <button id="viewResultsBtn" onclick="window.location='viewResults.php'" style="display:none">View Results</button>
        <button id="moveResultsBtn" onclick="window.location='moveResults.php'" style="display:none">Upload Results</button>
        <button id="logoutBtn" onclick="window.location='logout.php'">Logout</button>
    </div>
    <script>
        var isadmin = <?php
                        echo$_SESSION["isadmin"];
                        ?>;
                        console.log(isadmin);
        if (isadmin) {
            document.getElementById("moveResultsBtn").style.display = "";
        } else {
            document.getElementById("viewResultsBtn").style.display = "";
        }
    </script>
    <div class="login-page">
        <div class="form">
            <form class="login-form" method="POST">
                <input name="opassword" type="password" placeholder="Enter Old Password" required />
                <input name="npassword" type="password" placeholder="Enter New Password" required />
                <input name="rnpassword" type="password" placeholder="Re-Enter New Password" required />
                <button type="submit">Change Password</button>
            </form>
        </div>
    </div>
</body>

</html>