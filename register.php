<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $department = $username = $password = $repassword = "";
// $repassword_err = $username = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = "'" . strtoupper($_POST["surname"]) . "-" . strtoupper($_POST["yourname"]) . "-" . strtoupper($_POST["fathersname"]) . "-" . strtoupper($_POST["mothersname"]) . "'";
    $department = "'" . $_POST["department"] . "'";
    $username = "'" . $_POST["username"] . "'";
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];

    //check if user exists in the department
    $path1 = str_replace("'", '', "data/$department/$name");

    if (file_exists($path1)) {
        $sql1 = "SELECT name, id FROM users WHERE name = $name";
        $result1 =  mysqli_query($link, $sql1);

        if (mysqli_num_rows($result1) > 0) {
            //already registered
            echo "<script type='text/javascript'>alert('Your are already reistered with us!');</script>";
        } else {
            if ($password != $repassword) {
                //passwords do not match
                echo "<script type='text/javascript'>alert('Passwords do not match!');</script>";
            } else {

                $sql2 = "SELECT username FROM users WHERE username = $username";
                $result2 =  mysqli_query($link, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                    //already registered
                    echo "<script type='text/javascript'>alert('Username already exist!');</script>";
                } else {

                    // Creates a password hash
                    $hashed_password = "'" . password_hash($password, PASSWORD_DEFAULT) . "'";
                    echo "tango";
                    $sql = "INSERT INTO users (name, department, username, password) VALUES (" . strtoupper($name) . ", $department, $username, $hashed_password)";
                    if (mysqli_query($link, $sql)) {
                        echo "<script type='text/javascript'>alert('Registration successful!');</script>";
                        // Redirect to login page
                        header("location: index.php");
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($link);
                    }
                }
            }
        }
        // }
    } else {
        echo "<script type='text/javascript'>alert('User does not exist in the department!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registration</title>

    <link rel="stylesheet" type="text/css" href="register.css">
</head>


<body>

    <div class="register-page">
        <div class="form">
            <form class="register-form" method="post" autocomplete="off">
                <input name="surname" type="text" placeholder="Enter Surname" required />
                <input name="yourname" type="text" placeholder="Enter You Name" required />
                <input name="fathersname" type="text" placeholder="Enter Father's Name" required />
                <input name="mothersname" type="text" placeholder="Enter Mother's Name" required />
                <select name="department" required>
                    <option value="">Select Department</option>
                    <option value="COMPS">Computer Engineering</option>
                    <option value="IT">Information Technology</option>
                    <option value="EXTC">Electronics and Telecommunication</option>
                    <option value="ETRX">Electronics</option>
                </select>
                <input name="username" type="text" placeholder="Enter Desired Username" required />
                <input name="password" type="password" placeholder="Enter Password" required />
                <input name="repassword" type="password" placeholder="Re-Enter Password" required />
                <button type="submit">Register</button>
                <p class="message">Already registered? <a href="index.php">Sign In</a></p>
            </form>
        </div>
    </div>

</body>

<script type="text/javascript">
</script>

</html>