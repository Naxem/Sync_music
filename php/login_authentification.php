<?php
    require('requetes.php');
    $date = date("Y-m-d");

    $login = $_POST['txt-login'];
    $mdp = $_POST['txt-password'];
    $_SESSION["status"] = "";
    $_SESSION["auth"] = 0;
    //create_user($login, $mdp, $date, 1); //créa compte

    //test identifiant
    $authentification = authentification($login);
    $auth = $authentification->fetch();
    $pass = $auth["MDP"];

    switch($auth["count(Login)"]) {
        case 1 :
            if(password_verify($mdp, $pass)) {
                $_SESSION["login"] = $login;
                $_SESSION["auth"] = 1;
                //recup id user
                $return_id_user = return_id_user($login);
                $return_id = $return_id_user->fetchAll();
                foreach($return_id as $id) {
                    $_SESSION["id"] = $id["IdUser"];
                }
                //logs
                log_conexion("Conexion de l'utilisateur", $date, $_SESSION["id"]);

                header("Location: ../index");
                exit();

            } else {
                $_SESSION["status"] = "L'identifiant ou le mot de passe est incorrect.";
                $_SESSION["auth"] = 0;

                //recup id user
                $return_id_user = return_id_user($login);
                $return_id = $return_id_user->fetchAll();
                foreach($return_id as $id) {
                    $_SESSION["id"] = $id["IdUser"];
                }

                log_conexion("Tentative de conexion de l'utilisateur", $date, $_SESSION["id"]);

                header("Location: login");
                exit();
            }
            break;
        case 0 :
            $_SESSION["status"] = "L'identifiant ou le mot de passe est incorrect.";
            $_SESSION["auth"] = 0;

            //recup id user
            $return_id_user = return_id_user($login);
            $return_id = $return_id_user->fetchAll();
            foreach($return_id as $id) {
                $_SESSION["id"] = $id["IdUser"];
            }

            log_conexion("Tentative de conexion de l'utilisateur", $date, $_SESSION["id"]);

            header("Location: login");
            break;

        default :
            throw("erreur");
            $_SESSION["status"] = "Il existe plusieur compte contacter l'administateur.";
            $_SESSION["auth"] = 0;
    }

    /* crypage de mdp + add un bdd */
    function create_user($login, $pass, $date, $role) {
        $pass = password_hash($pass, PASSWORD_ARGON2ID);
        create_users($login, $pass, $date, $role);
    }
?>