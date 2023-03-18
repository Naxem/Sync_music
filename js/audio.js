audioPlayer = document.getElementById("myAudio");
const btnPause = document.getElementById("btnPause");
const btnPlay = document.getElementById("btnPlay");
volumeRange = document.getElementById("inVol");

/* event */
audioPlayer.addEventListener('play', () => {
    intervalId = setInterval(updateTime, 1000);

    const nomFichierComplet = audioPlayer.currentSrc;
    const nomFichier = nomFichierComplet.split('/').pop().replace(/%20/g, ' ');
    console.log(`La musique "${nomFichier}" a démarré.`);

    var value = nomFichier;
        //alert(value);
        $.ajax({
            url: 'play_music.php',
            type: 'POST',
            data: 'request=' + value,
            beforeSend:function() {
                //$(".list-pizza").html("<span> Chargement en cours... </span>");
                console.log("In progress");
            },
            success: function(data) {
                //$(".list-pizza").html(data);
                console.log("Fini");
            },
            failed: function() {
                //$(".list-pizza").html("<span> erreur </span>");
                console.log("Erreur");
            },
        });
});

audioPlayer.addEventListener('pause', () => {
    clearInterval(intervalId);

    const nomFichierComplet = audioPlayer.currentSrc;
    const nomFichier = nomFichierComplet.split('/').pop().replace(/%20/g, ' ');
    console.log(`La musique "${nomFichier}" est en pause.`);

    $.ajax({
        url: 'pause_music.php',
        type: 'POST',
        beforeSend:function() {
            console.log("In progress");
        },
        success: function() {
            console.log("Fini");
        },
        failed: function() {
            console.log("Erreur");
        },
    });
});

/* function */
function play() {
    if (audioPlayer.paused) {
        audioPlayer.play()
        btnPause.hidden = true
        btnPlay.hidden = false
      } else {
        audioPlayer.pause()
        btnPause.hidden = false
        btnPlay.hidden = true
      }
}

function updateTime() {
    maxCurrentTime = audioPlayer.duration;
    currentTime = audioPlayer.currentTime;

    var minutes = Math.floor(maxCurrentTime / 60); // nombre de minutes entières
    var seconds = Math.floor(Math.round(maxCurrentTime % 60)); // nombre de secondes restantes
    maxCurrentTime = minutes + ":" + seconds;

    var minutes = Math.floor(currentTime / 60);
    var seconds = Math.floor(Math.round(currentTime % 60));

    currentTime = minutes + ":" + seconds;
    timeCode.innerHTML = currentTime + " / " + maxCurrentTime;

    timeRange.max = audioPlayer.duration
    timeRange.value = audioPlayer.currentTime
}

function spawnVolume() {
    if(volumeRange.hidden == true) {
        volumeRange.hidden = false
    } else {
        volumeRange.hidden = true
    }
}