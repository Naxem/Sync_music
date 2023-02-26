const audioPlayer = document.getElementById("myAudio");

audioPlayer.addEventListener('play', () => {
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

audio.addEventListener('pause', () => {
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