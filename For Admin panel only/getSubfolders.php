<?php 
$folder = $_POST["folder"];
$out = array();
foreach (glob($folder."/*", GLOB_ONLYDIR) as $filename) {
    // $p = pathinfo($filename);
    // $out[] = $p['filename'];
    $out[] = pathinfo($filename)["filename"];
}
// echo json_encode($folder."/*");
echo json_encode($out);
?>