<?php
    require("requetes.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel_Admin</title>
</head>
<body>
    <?php if(($_SESSION["reussi"] == true) && (!empty($_SESSION["status_uploade"]))) { ?>
        <div class="reussi"><?= $_SESSION["status"] ?></div>
    <?php }else { ?>
        <div class="erreur"><?= $_SESSION["status"] ?></div>
    <?php } ?>

    <form action="requetes.php" method="post">
        <p>Ajouter une playliste : </p>
        <p>Nom : <input type="text" name="txt-nom"></p>
        <input type="submit" value="Ajouter" name="btn-addPlaylist">
    </form>

    <form action="requetes.php" method="post" enctype="multipart/form-data">
        <p>Ajouter une music dans une playliste : </p>
        <p>Selectionner un fichier : </p> <input type="file" name="musique">
        <select name="s_playlist">
            <option value="default" selected disabled>Choissire une playliste</option>
            <?php
            $return_playliste = return_playlist();
            $liste_playliste = $return_playliste->fetchAll();
            foreach($liste_playliste as $res) {
                echo '<option value='.$res["Labelle"].'>'.$res["Labelle"].'</option>';
            }
            ?>
        </select>
        <input type="submit" value="Ajouter" name="btn-addMusic">
    </form>
</body>
</html>
