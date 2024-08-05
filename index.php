<?php
    //index.php : dispatcher ou routeur : pour aiguiller
    define ('WEBROOT',str_replace('index.php', '',$_SERVER['REQUEST_URI']));
    define ('ROOT',str_replace('index.php', '',$_SERVER['SCRIPT_FILENAME']));

    // echo "WEBROOT :".WEBROOT."<br>";
    // echo "ROOT :".ROOT."<br>";
    //phpinfo();
    require (ROOT."config/conf.php");
    require (ROOT."core/model.php");
    require (ROOT."core/controller.php");
    require (ROOT."core/session.php");

    $chemin = explode("/", WEBROOT);
    //  echo "<PRE>";
    // print_r($chemin);
    // echo "</PRE>";

    //define ('WEBROOT2', $chemin[1]);
    // echo "WEBROOT2 : ".WEBROOT2."<br>";

    if(empty($chemin[1])) {
        $controller="connexions";
    } else {
        $controller = $chemin[1];
    }
    //   echo "controller : ".$controller."<br>";

    if(empty($chemin[2])) {
        $action="index";
    } else {
        $action = $chemin[2];
    }

    //    echo "action controller : ".$action."<br>";

    try{
        if(file_exists(ROOT."controllers/".$controller.".php")){
            require (ROOT."controllers/".$controller.".php");

            //instanciation de mon controleur
            $controller = new $controller();
        }

    }catch(Exception $e){

    }

    //vérification de l'existence de l'action demandée
    if(method_exists($controller, $action)) {
        //$controller->$action();
        unset($chemin[0]);
        unset($chemin[1]);
        unset($chemin[2]);
        //unset($chemin[3]);
        //voir au calme le call_user_func_array
        //1er paramètre : un tableau (objet, méthode)
        //2ème paramètre : un tableau contenant de 0 à n paramètres
        call_user_func_array(array($controller, $action), $chemin);
    } else {
   
        echo "<h1>Erreur 404, </br>Retourner sur la page d'accueil s'il vous plait.</h1>";
    }

?>