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
    <link rel="stylesheet" href="../css/playliste.css">
    <link rel="stylesheet" href="../css/navFooter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Playliste : <?= $barre ?></title>
</head>
<nav>        
    <div class="main-navlinks">
        <button class="hamburger" type="button" aria-label="Toggle navigation" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
        </button>
        <div class="navlinks-container">
            <a href="../index" aria-current="main">Accueil</a>
            <a href="deconexion" aria-current="deconexion">deconexion</a>
            <a href="../amis" aria-current="ajout d'amis">amis</a>
        </div>
    </div>
    <!--JS-->
    <script src="js/navBare.js"></script>
</nav>
<body>
    <section>
        <div>
            <?php
                //Récupe les musiques dans la playliste est les met dans un array
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
            <p id="nameMusic">Erreur</p>
            <audio id="myAudio" preload="metadata" crossorigin="use-credentials"></audio>

            <div hidden id="btnPlay" onclick="play()">
            <svg width="45" height="45" fill="none" stroke="#FFB703" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="m5 3 14 9-14 9V3z"></path></svg>
            </div>

            <div id="btnPause" onclick="play()">
            <svg width="46" height="46" fill="none" stroke="#ffb703" stroke-linecap="round" stroke-linejoin="round"
             stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M6 4h4v16H6z"></path><path d="M14 4h4v16h-4z"></path></svg>
            </div>

            <script src="../js/audio.js"></script>
            <script> //script js pour l'auto play
                const nameMusic = document.getElementById("nameMusic");
                const audioPlayer = document.getElementById("myAudio");
                const audioFiles = <?php echo json_encode($audioFiles) ?>;
                let currentAudioIndex = 0;
                nameMusic.innerHTML = audioFiles[currentAudioIndex];

                audioPlayer.addEventListener("ended", () => {
                currentAudioIndex++;
                    if (currentAudioIndex < audioFiles.length) {
                        audioPlayer.src = '../ressources/music/' + audioFiles[currentAudioIndex];
                        //audioPlayer.play();
                        nameMusic.innerHTML = audioFiles[currentAudioIndex];
                    }
                });
                audioPlayer.volume = 0.5;
                audioPlayer.currentTime = 0;
                audioPlayer.src = '../ressources/music/' + audioFiles[currentAudioIndex];
                //audioPlayer.play();
            </script>

            <div id="div-timeRange">
                <input id="inTime" type="range" min="0" max="0" step="1" value="0">
            </div>
            <div id="div-time">
                <script>
                    let intervalId = setInterval(updateTime, 1000);
                    const timeCode = document.getElementById("div-time");
                    const timeRange = document.getElementById("inTime");
                    var maxCurrentTime = 0
                    var currentTime = 0

                    audioPlayer.addEventListener("loadedmetadata", function() {
                        maxCurrentTime = audioPlayer.duration;
                        currentTime = audioPlayer.currentTime;

                        var minutes = Math.floor(maxCurrentTime / 60); // nombre de minutes entières
                        var seconds = Math.floor(Math.round(maxCurrentTime % 60)); // nombre de secondes restantes
                        maxCurrentTime = minutes + ":" + seconds;

                        var minutes = Math.floor(currentTime / 60); // nombre de minutes entières
                        var seconds = Math.floor(Math.round(currentTime % 60)); // nombre de secondes restantes
                        currentTime = minutes + ":" + seconds;
                        timeCode.innerHTML = currentTime + " / " + maxCurrentTime;
                    });

                    timeRange.addEventListener('input', () => {
                        audioPlayer.volume = 0;
                        audioPlayer.currentTime = timeRange.value;
                        audioPlayer.volume = volumeRange.value;
                    });
                </script>
            </div>

            <div id="div-rangeVolume">
                <input hidden id="inVol" type="range" min="0" max="1" step="0.1" value="0.5">
            </div>
            <div id="div-volume">
                <svg id="audio0" onclick="spawnVolume()" width="46" height="46" fill="none" stroke="#ffb703" stroke-linecap="round" 
                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 5 6 9H2v6h4l5 4V5z"></path><path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path></svg>

                <svg id="audio1" onclick="spawnVolume()" hidden width="46" height="46" fill="none" stroke="#ffb703" stroke-linecap="round" 
                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 5 6 9H2v6h4l5 4V5Z"></path>
                <path d="M19.07 4.93a10 10 0 0 1 0 14.14"></path><path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path></svg>

                <svg id="audio2" onclick="spawnVolume()" hidden width="46" height="46" fill="none" stroke="#ffb703" stroke-linecap="round" 
                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 5 6 9H2v6h4l5 4V5z"></path></svg>

                <svg id="audio3" onclick="spawnVolume()" hidden width="46" height="46" fill="none" stroke="#ffb703" stroke-linecap="round" 
                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 5 6 9H2v6h4l5 4V5z"></path>
                <path d="m23 9-6 6"></path><path d="m17 9 6 6"></path></svg>

                <script>
                    const volumeRange = document.getElementById("inVol");
                    const audio0 = document.getElementById("audio0");
                    const audio1 = document.getElementById("audio1");
                    const audio2 = document.getElementById("audio2");
                    const audio3 = document.getElementById("audio3");

                    volumeRange.addEventListener('input', () => {
                        audioPlayer.volume = volumeRange.value;

                        if((audioPlayer.volume >= 0.4) && (audioPlayer.volume < 0.7)) {
                            audio0.style.display = 'flex'
                            audio1.style.display = 'none'
                            audio2.style.display = 'none'
                            audio3.style.display = 'none'
                        } else if((audioPlayer.volume >= 0.7) && (audioPlayer.volume <= 1)) {
                            audio1.style.display = 'flex'
                            audio0.style.display = 'none'
                            audio2.style.display = 'none'
                            audio3.style.display = 'none'
                        } else if((audioPlayer.volume <= 0.3) && (audioPlayer.volume > 0)) {
                            audio2.style.display = 'flex'
                            audio0.style.display = 'none'
                            audio1.style.display = 'none'
                            audio3.style.display = 'none'
                        } else {
                            audio3.style.display = 'flex'
                            audio0.style.display = 'none'
                            audio1.style.display = 'none'
                            audio2.style.display = 'none'
                        }
                    });
                </script>

            </div>
        </div>
    </section>
</body>
<footer>
        <div class="content-footer">
            <div class="bloc footer-services">
                <center>
                    <h3>Services</h3>
                    <ul class="services-list">
                        <li><span class="span-footer"><a>Trouver de Playlistes</a></span></li>
                        <li><span class="span-footer"><a>Trouver des amis</a></span></li>
                        <li><span class="span-footer"><a>écouté de la music</a></span></li>
                    </ul>
                </center>
            </div>

            <div class="bloc footer-contact" id="contact">
                <center>
                    <h3>Me contacter</h3>
                    <a href="mailto: maxens2009@outlook.fr">maxens2009@outlook.fr</a>
                </center>
            </div>

            <div class="bloc footer-schedule">
                <center>
                    <h3>Horaires d'ouverture</h3>
                    <ul class="schedule-list">
                        <li><span class="span-footer">Lundi : 15h-18h</span></li>
                        <li><span class="span-footer">Mardi : 9h-12h et 14h-18h</span></li>
                        <li><span class="span-footer">Mercredi : 9h-12h et 14h-18h</span></li>
                        <li><span class="span-footer">Jeudi : 14h-18h</span></li>
                        <li><span class="span-footer">Vendredi : 9h-12h et 14h-18h</span></li>
                        <li><span class="span-footer">Samedi : 14h-18h</span></li>
                    </ul>
                </center>
            </div>

            <div class="bloc footer-medias">
                <center>
                    <h3>Réseaux sociaux</h3>
                    <ul class="media-list">
                        <li><a href="https://github.com/Naxem" target="_blank">
                            <img src="../ressources/images/logo_github.png" alt="logo github">
                            GitHub</a>
                        </li>
                        <li><a href="https://linkedin.com/in/maxens-telle-99a43a265" target="_blank">
                            <img src="../ressources/images/logo_linkedin.png" alt="logo linkedin">
                            Linkedin</a>
                        </li>
                    </ul>
                </center>
            </div>
        </div>

        <div class="mentionLegal">
            <center>
                <a href="../mentionLegal">Mentions légales</a>
            </center>
        </div>
</footer>
</html>