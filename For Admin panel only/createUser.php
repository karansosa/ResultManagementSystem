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
    <label>Surname</label>
    <input type="text" id="Surname" required />
    <label>Student's Name</label>
    <input type="text" id="StudentsName" required />
    <label>Father's Name</label>
    <input type="text" id="FathersName" required />
    <label>Mother's name</label>
    <input type="text" id="MothersName" required />
    <label>Department</label>
    <input type="text" id="Department" required />
    <button type="submit" id="submit-newDept" class="btn btn-primary">Create User</button>
    <script>
        $('#submit-newDept').on("click", function (e) {
            var newUser = new Array(document.getElementById("Surname").value + "-" + document.getElementById(
                        "StudentsName").value + "-" + document.getElementById("FathersName").value +
                    "-" + document.getElementById("MothersName").value);
            var userDept = new Array(document.getElementById("Department").value);        
            e.preventDefault();
            console.log("calling post")
            $.post('/Result-Management/createUsers1.php', {
                Users: newUser,
                Dept: userDept
            }, function (data) {
                console.log("from other side");
                console.log(data);
            });
        });
    </script>


</body>

</html>