<?php
foreach (glob('input/*') as $filename) {
    $p = pathinfo($filename);
    $old_path = "input/" . $p["basename"];
    $new_path = "data/" . substr($p["filename"], 0, strpos($p["filename"], "_")) . "/" . substr($p["filename"], strpos($p["filename"], "_") + 1, -6) . "/" . $p["basename"];
    echo $old_path;
    echo $new_path;
    echo rename($old_path, $new_path);
}
header("location: moveResults.php");
exit;
?>