<?php 
$newDept = $_POST['Dept'];

mkdir("data/".strtoupper($newDept));
print_r(($newDept));
?>