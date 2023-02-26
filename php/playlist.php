<?php
    require("requetes.php");
    $barre = $_GET["playlist"];
    $return_id_playlist = return_id_playlist($barre);
    $idPlaylist = $return_id_playlist->fetchAll();
    foreach($idPlaylist as $res) {$_SESSION["id_playliste"] = $res["idPlaylist"];}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Playliste : <?= $barre ?></title>
</head>
<body>
    <section>
    <div>
    <?php
        $return_music_x_playlist = return_playlist_x_music($barre);
        $list_music = $return_music_x_playlist->fetchAll();
        $audioFiles = array();
        foreach($list_music as $res) {
            $musicName = $res["Labelle"];
            $musicName = str_replace('%20', ' ', $musicName);
            $musicName = str_replace('%', '', $musicName);
            array_push($audioFiles, $musicName);
        }

    ?> 
        <p><?= $res["Labelle"] ?></p><!--changer le nom avec js-->
        <audio id="myAudio" controls preload="metadata" crossorigin="use-credentials"></audio>
    </div>
    <script> //script js pour l'auto play
        const audioPlayer = document.getElementById("myAudio");
        const audioFiles = <?php echo json_encode($audioFiles); ?>;
        let currentAudioIndex = 0;
        audioPlayer.volume = 0.5;
        audioPlayer.currentTime = 0;

        audioPlayer.addEventListener("ended", () => {
        currentAudioIndex++;
            if (currentAudioIndex < audioFiles.length) {
                audioPlayer.src = '../ressources/music/' + audioFiles[currentAudioIndex];
                audioPlayer.play();
            }
        });

        audioPlayer.src = '../ressources/music/' + audioFiles[currentAudioIndex];
        audioPlayer.play();
    </script>
    <script src="../js/audio.js"></script>
    </section>
</body>
</html>