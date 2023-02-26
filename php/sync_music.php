<?php
    require("requetes.php");
    $idM = $_GET["idM"];
    $nameU = $_GET["idU"];
    $idP = $_GET["idP"];

    $return_name_playlist = return_name_playlist($idP);
    $name_Playlist = $return_name_playlist->fetchAll();
    foreach($name_Playlist as $res) {$nameP = $res["Labelle"];}

    $return_name_music = return_name_music($idM);
    $name_Music = $return_name_music->fetchAll();
    foreach($name_Music as $res) {$nameM = $res["Labelle"];}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sync Music</title>
</head>
<body>
    <p><?= $nameM ?></p>
    <audio id="myAudio" controls preload="metadata" crossorigin="use-credentials" cure>
        <source src="../ressources/music/<?= $nameP ?>/<?= $nameM ?>" type="audio/mp3">
    </audio>
    <script src="../js/sync.js"></script>
</body>
</html>