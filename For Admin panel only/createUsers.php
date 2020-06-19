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
	<input type="file" id="files" class="form-control" accept=".csv" required />
	<button type="submit" id="submit-file" class="btn btn-primary">Upload File</button>
	<script>
		$('#submit-file').on("click", function (e) {
			e.preventDefault();
			$('#files').parse({
				config: {
					delimiter: "auto",
					complete: displayHTMLTable,
				},
				before: function (file, inputElem) {
					//console.log("Parsing file...", file);
				},
				error: function (err, file) {
					//console.log("ERROR:", err, file);
				},
				complete: function () {
					//console.log("Done with all files");
				}
			});
		});

		var newUsers = new Array();
		var newUsersDept = new Array();

		function displayHTMLTable(results) {
			console.log(results.data);
			for (i = 1; i < results.data.length; i++) {
				console.log(results.data[i]);
				if (results.data[i] != "") {
					results.data[i] = results.data[i][0].split(",");
					newUsers[i - 1] = "";
					newUsersDept[i-1]=results.data[i][0];
					for (j = 1; j < results.data[i].length; j++) {
						console.log(results.data[i][j]);
						newUsers[i - 1] += results.data[i][j] + "-";
					}
					newUsers[i - 1] = newUsers[i - 1].substring(0, newUsers[i - 1].length - 1);
				}
			}
			console.log("New Users");
			console.log(newUsers);
			console.log("New Users Dept");
			console.log(newUsersDept);
			post();
		}

		function post() {
			console.log("calling post")
			$.post('/Result-Management/createUsers1.php', {
				Users: newUsers,
				Dept: newUsersDept
			}, function (data) {
				console.log("from other side");
				console.log(data);
			});
		}
	</script>


</body>

</html>