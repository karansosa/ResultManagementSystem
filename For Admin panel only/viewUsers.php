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
</head>

<body>
    <div id="users"></div>
    <script>
        var count = 0;
        var table = "<table><tr><th>Sr. No.</th><th>Surname</th><th>Given Name</th><th>Father's Name</th><th>Mother's Name</th><thDepartment></th><th>Registered on Portal</th></tr>";
        var datad = new Array();
        $.post('/Result-Management/getSubfolders.php', {
            folder: "data"
        }, function(data) {
            console.log("from other side");
            // console.log(data);
            datad = data;
            datad = datad.replace(/\[/g, '');
            datad = datad.replace(/\]/g, '');
            datad = datad.replace(/\"/g, '');
            // console.log(data)
            datad = datad.split(",")
            console.log(datad)
            for (i = 1; i < datad.length; i++) {

                $.post('/Result-Management/getSubfolders.php', {
                    folder: "data/" + datad[i]
                }, function(data1) {
                    // console.log(data);
                    data1 = data1.replace(/\[/g, '');
                    data1 = data1.replace(/\]/g, '');
                    data1 = data1.replace(/\"/g, '');
                    // console.log(data)
                    data1 = data1.split(",")
                    console.log("data1")
                    console.log(data1)
                    table += "<tr><td>" + datad[i] + "</td>";
                    for (k = 0; k < data1.length; k++) {
                        data1[k] = data1[k].split("-")
                        console.log("data1")
                        console.log(data1)
                        for (j = 0; j < data1[k].length; j++) {
                            table += "<td>" + data1[k][j] + "</td>";
                        }
                                table += "</tr>";
                            if (k == data1.length - 2) {
                                table += "</table>";
                                document.getElementById("users").innerHTML = table;
                                console.log(table)
                            }
                    }
                });
            }
        });
    </script>
</body>

</html>