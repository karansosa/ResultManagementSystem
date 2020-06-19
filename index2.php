<?php
//Initialize the session
session_start();
//Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: viewResults.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = strtoupper($_POST["username"]);
    $password = $_POST["password"];
        // Prepare a select statement
        $sql = "SELECT username, password, name, department, isadmin FROM users WHERE username = '$username'";
        
    echo $sql;
    $result1 =  mysqli_query($link, $sql);


                // Check if username exists, if yes then verify password
                if (mysqli_num_rows($result1) > 0) {
                    $temp = mysqli_fetch_assoc($result1);
                    echo $temp;
                    $hashed_password = $temp["password"];
                    $name =  $temp["name"];
                    $department =   $temp["department"];
                    $isadmin =   $temp["isadmin"];
                     echo $hashed_password;
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();
                            echo "<script type='text/javascript'>alert('ok');</script>";

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["name"] = $name;
                            $_SESSION["department"] = $department;
                            $_SESSION["isadmin"] = $isadmin;
                            // Redirect user to welcome page
                            header("location: viewResults.php");
                        }   else {
                            // Display an error message if password is not valid
                            echo "<script type='text/javascript'>alert('The password you entered is not valid.');</script>";
                        }
                } else {
                    // Display an error message if username doesn't exist
                    echo "<script type='text/javascript'>alert('No account found with that username.');</script>";
                }
    }

    // Close connection
    mysqli_close($link);

?>
<!DOCTYPE html>
<html>

<head>
    <title></title>

    <link rel="stylesheet" type="text/css" href="login.css">
</head>


<body>

    <div class="login-page">
        <div class="form">
            <form class="login-form" method="POST">
                <input name="username" type="text" placeholder="Enter Username" required/>
                <input name="password" type="password" placeholder="Enter Password" required/>
                <button type="submit">login</button>
                <p class="message">Not registered? <a href="register.php">Create an account</a></p>
            </form>
        </div>
    </div>

</body>

</html>