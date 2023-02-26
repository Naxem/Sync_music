<?php
    require("requetes.php");
    $request = $_POST['request'];
    if($_POST['request']) {
        play_music($request);
    }
?>