<?php 
$newUsers = $_POST['Users'];
$newUsersDept = $_POST['Dept'];
$path =array();
for($i=0;$i<count($newUsers);$i++){
mkdir("data/".strtoupper($newUsersDept[$i])."/".strtoupper($newUsers[$i]));
$path[$i]="data/".strtoupper($newUsersDept[$i])."/".strtoupper($newUsers[$i]);
// $path[$i]="data/";
// $path[$i]+=$newUsersDept[$i];
// $path[$i]+="/"+$newUsers[$i];
// $path[$i]="test"+$i;
}
// mkdir("data/COMPS/test");
print_r(($path));
?>