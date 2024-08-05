<?php

class connexions extends controller {

    var $models = array("connexion");

    function index() {
        //on deco l'utilisateur
        session_destroy();
        
        $this->layout = 'default';

        //je rends le vue connexions
        $this->render('index');
    }

    //connexion
    function login() {

        if(!empty($_POST)) {
            
            $user = $this->connexion->getUser($_POST['login'],$_POST['password']);

            if(!empty($user)) {
                $this->Session->write('User', current($user)); 
                $this->Session->setFlash("Bonjour ".ucfirst($_SESSION['User']->prenom).',',"success");
               
            }
        }
        //Si login et mdp validé
        if($this->Session->isLogged()) {
            $this->layout='defaultlog';
            
            //On redirige l'utilisateur dans le site en accès logged seulement.
            header('Location:/services');

        } else {
            $this->Session->setFlash("Connexion incorrecte !","danger");
            $this->layout = 'default';
            $this->render('index');
        }
    }
    
    //deconnexion
    function logout() {
        session_destroy();
        $this->layout = 'default';
        header('Location:/');
        
    }

}
?>