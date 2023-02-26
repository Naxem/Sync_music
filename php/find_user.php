<?php
    require("requetes.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find user</title>
</head>
<body>
    <section>
<?php
    $return_all_user = return_all_user();
    $all_user = $return_all_user->fetchAll();
    foreach($all_user as $res) {
        $iduser = return_id_user($res["Login"]);
        $idUser = $iduser->fetchAll();
        foreach($idUser as $res2) {$idU = $res2["IdUser"];}
        $return_play_music = return_id_music_by_played($idU);
        $infos = $return_play_music->fetchAll();
        if(!empty($infos)) {
        foreach($infos as $res3) {
?>
        <div>
            <p><?= $res["Login"] ?></p>
            <a href="sync_music?idM=<?= $res3["idMusic"] ?>&idU=<?= $res["Login"] ?>&idP=<?= $res3["idPlaylist"] ?>"><?= $res3["idMusic"] ?></a>
        </div>
<?php
    }}else {
?>
        <div>
            <p><?= $res["Login"] ?></p>
            <p>aucune music est en cours pour cette utilisateur.</p>
        </div>
<?php
    }}
?>
    </section>
</body>
</html>