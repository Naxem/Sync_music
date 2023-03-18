audioPlayer = document.getElementById("myAudio");
const btnPause = document.getElementById("btnPause");
const btnPlay = document.getElementById("btnPlay");
volumeRange = document.getElementById("inVol");

/* event */
audioPlayer.addEventListener('play', () => {
    intervalId = setInterval(updateTime, 1000);

    if(btnPlay.hidden === true) {
        btnPause.hidden = true
        btnPlay.hidden = false
    }
});

audioPlayer.addEventListener('pause', () => {
    clearInterval(intervalId);
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

function after() {
    currentAudioIndex = currentAudioIndex - 2;
    if(currentAudioIndex < 0) {
        currentAudioIndex = audioFiles.length
    }
    if(audioPlayer.currentTime > 1) {
        audioPlayer.currentTime = 0
    } else {
        audioPlayer.dispatchEvent(new Event('ended'));
    }
}

function next() {
    audioPlayer.dispatchEvent(new Event('ended'));
}