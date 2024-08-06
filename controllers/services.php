<?php

class services extends controller {

    var $models = array("service","autorisation","dossier","utilisateur","groupe","groupe_service","groupe_utilisateur");

    function index() {
        if($this->Session->isLogged()) {
           
            $variable=array();

            //Si l'utilisateur est admin on affiche tous les services
            if($this->Session->isAdmin()){
                
                $variable['listUtilisateurs'] = $this->utilisateur->getUtilisateurs();
                $variable['listGroupes'] = $this->groupe->getGroupes();
            }
            
            $variable['listServices'] = $this->service->getServices();
           
            $this->set($variable);
            $this->layout='defaultlog';
            $this->render('index');
    
            // echo"ok";
            // echo "<PRE>";
            // print_r($listServices);
            // echo "</PRE>";   
        }else{
            $this->Session->setFlash("Veuillez-vous connecter pour accèder à cette page, merci", "danger");
            $this->layout = 'default';
            //je rends la vue index
            header('Location:/');
        }
     
    }

    //Ajout d'un service
    function adminAjoutService(){
        //On test si l'utilisateur est admin :
        var_dump($_POST);
        if($this->Session->isAdmin()){
            $id=$this->service->createService($_POST['nomService']);
            if(!empty($id)){
                $cheminNouveauDossier="webroot/fichiers/".$id;

                //test inutile normalement car id unique autoincrement
                if(!file_exists( $cheminNouveauDossier)){
                    echo $cheminNouveauDossier;
                    if(mkdir( $cheminNouveauDossier)){
                        $this->Session->setFlash("Le service a été créé avec succès.", "success");
                    }else{
                        $this->Session->setFlash("Impossible de créer le service.", "danger"); 
                    }
                }else{
                    $this->Session->setFlash("Le service existe déjà.", "warning"); 
                }
            }else{
                $this->Session->setFlash("Impossible de créer le service dans la base de donnée.", "danger");
            }
           
        }
        header('Location:/services');
    }

    //Suppression d'un service
    function adminDeleteService(){
        //On test si l'utilisateur est admin :
        if($this->Session->isAdmin()){
            $id_service = $_POST['id_service'];
            if(!empty($id_service)){
                if(empty($this->dossier->getDossiers($id_service))){
                    $cheminDossier="webroot/fichiers/".$id_service;
                    echo $cheminDossier;
                    if(rmdir($cheminDossier)){
                        $this->service->deleteService($id_service);
                        $this->Session->setFlash("Le service a été supprimé avec succès.", "success");
                    }else{
                        $this->Session->setFlash("Impossible de supprimer le service dans la base de donnée.1", "danger");
                    }
                   
                }else{
                    $this->Session->setFlash("Impossible de supprimer le service car il a des sous-service attribués.", "danger");
                }
            }else{
                $this->Session->setFlash("Impossible de supprimer le service dans la base de donnée.2", "danger");
            }
        }
        header('Location:/services');
    }

     //Ajout image d'un service
     function adminAjoutImage(){
        
        //On test si l'utilisateur est admin :
        if($this->Session->isAdmin()){
            $id_service = $_POST['id_service'];
            // echo ($id_service);
            $nbFichiersEnvoyes = count($_FILES['fichiers']["name"]);
            // echo ($nbFichiersEnvoyes);
            if(!empty($id_service) && isset($_FILES) && !empty($_FILES)){
                 //Chemin de l'image à enregistrer :
                 $im_src="webroot/img/imagesServices/".$_FILES['fichiers']["name"][0];              
                 //echo $im_src;

                 //On test si le fichier existe déjà 
                 if(file_exists( $im_src)){
                    unlink ($im_src);
                    //  $this->Session->setFlash("Impossible d'ajouter le fichier ".$_FILES['fichiers']["name"][0].", un autre fichier du même nom existe déjà.", "warning");
                 }
                //on tente de upload le fichier dans le dossier imagesServices
                if(!move_uploaded_file($_FILES['fichiers']["tmp_name"][0], $im_src)){
                    $this->Session->setFlash("Téléchargement impossible, l'image attribuée au service est supprimée. ","warning");
                    $this->service->updateServiceImage($id_service,null);
                }else {
                    // On enregistre le lien de l'images du service
                    $this->service->updateServiceImage($id_service, $_FILES['fichiers']["name"][0]);
                    $this->Session->setFlash("L'image a bien été ajoutée.", "success");
                }

            }else{
                $this->Session->setFlash("Impossible d'ajouter l'image au service", "danger");
            }
        }
        header('Location:/services');
    }

    //Ajoute un utilisateur
    function adminAjoutUser(){
        //var_dump($_POST);
        if($this->Session->isAdmin()){
            $this->Session->setFlash("Impossible de créer l'utilisateur dans la base de donnée.", "danger");
            if(!empty($_POST['login'])){
                $id = $this->utilisateur->insertUtilisateur($_POST['nom'],$_POST['prenom'],$_POST['login'],$_POST['password']);
                if($id=="erreur"){
                    $this->Session->setFlash("Impossible de créer l'utilisateur, le login existe déjà.", "warning");
                }else{
                    $this->Session->setFlash("L'utilisateur ".$_POST['nom']." a été créé avec succès.", "success");
                }
            }
        }
        header('Location:/services');
    }

    //Ajoute groupe_utilisateur (utilisateur lié à tel ou tel groupe pour l'accès)
    function adminGestionUtilisateur(){
        //var_dump($_POST);
        if($this->Session->isAdmin()){
            $this->Session->setFlash("Les groupes de l'utilisateur ont  étaient mise à jour.", "success");
            if(!empty($_POST['id_utilisateur'])){

                // On supprime les enregistrements pour les recréer encsuite.
                $this->groupe_utilisateur->deleteGroupeUtilisateur($_POST['id_utilisateur']);

                //Insertions des enregistrements.
                foreach ($_POST['groupes'] as $key=> $id_groupe){
                    $e = $this->groupe_utilisateur->insertGroupeUtilisateur($_POST['id_utilisateur'],$id_groupe);

                    if($e == "erreur"){
                        $this->Session->setFlash("Impossible d'ajouter des groupes àl'utilisateur dans la base de donnée.", "danger");
                    }
                }
                

            }
        }
        header('Location:/services');
    }

    //AJAX Affichage des groupe de l'utilisateur
    function ajaxSelectGroupeUtilisateurByUtilisateur($id_utilisateur){
        if(!empty($id_utilisateur)){
            $list = $this->groupe_utilisateur->getGroupeUtilisateurByUtilisateur($id_utilisateur);
            $listGroupeUtilisateur = array();
            foreach($list as $value){ 
                
                array_push($listGroupeUtilisateur,$value->id_groupe);
            }
            $listGroupe = $this->groupe->getGroupes();
        }
        // echo "OK";
        // echo "<PRE>";
        //     print_r($listGroupeService);
        // echo "</PRE>";   
            require(ROOT.'views/services/ajaxGestionUtilisateur.php'); 

    }

    //Supprime un utilisateur(En cascade vers groupe utilisateur)
    function adminDeleteUser(){
        if($this->Session->isAdmin()){
            $this->Session->setFlash("Impossible de supprimer l'utilisateur dans la base de donnée.", "danger");
            if(!empty($_POST['id_utilisateur'])){
                $this->utilisateur->deleteUtilisateur($_POST['id_utilisateur']);
                $this->Session->setFlash("L'utilisateur a été supprimé avec succès.", "success");
            }
        } 
        header('Location:/services');
    }
    //Ajoute un groupe
    function adminAjoutGroupe(){
        //var_dump($_POST);
        if($this->Session->isAdmin()){
            $this->Session->setFlash("Impossible de créer le groupe dans la base de donnée.", "danger");
            if(!empty($_POST['libelle'])){
                $id = $this->groupe->insertGroupe($_POST['libelle']);
                if($id=="erreur"){
                    $this->Session->setFlash("Impossible de créer le groupe, le libelle existe déjà.", "warning");
                }else{
                    $this->Session->setFlash("Le groupe ".$_POST['libelle']." a été créé avec succès.", "success");
                }
            }
        }
        header('Location:/services');
    }

    //Ajoute groupe_service(acces d'un groupe sur tel ou tel service)
    function adminGestionGroupe(){
        //var_dump($_POST);
        if($this->Session->isAdmin()){
            $this->Session->setFlash("Les droits du groupe ont  étaient mise à jour.", "success");
            if(!empty($_POST['id_groupe'])){

                // On supprime les enregistrements pour les recréer encsuite.
                $this->groupe_service->deleteGroupeService($_POST['id_groupe']);

                //Insertion des enregistrements.
                foreach ($_POST['services'] as $key=>$id_service ){
                    $e = $this->groupe_service->insertGroupeService($_POST['id_groupe'],$id_service);
                    if($e == "erreur"){
                        $this->Session->setFlash("Impossible d'ajouter les droits aux groupes dans la base de donnée.", "danger");
                    }
                }
                

            }
        }
        header('Location:/services');
    }

    //AJAX Affichage des droits d'un groupe
    function ajaxSelectGroupeServiceByGroupe($id_groupe){
        if(!empty($id_groupe)){
            $list = $this->groupe_service->getGroupesServiceByGroupe($id_groupe);
            $listGroupeService = array();
            foreach($list as $value){ 
                
                array_push($listGroupeService,$value->id_service);
            }
            $listServices =$this->service->getServices();
        }
        // echo "OK";
        // echo "<PRE>";
        //     print_r($listGroupeService);
        // echo "</PRE>";   
            require(ROOT.'views/services/ajaxGestionGroupe.php'); 

    }

    //Supprime un groupe (en cascade sur les tables groupe_service et groupe_utilisateur)
    function adminDeleteGroupe(){
        if($this->Session->isAdmin()){
            $this->Session->setFlash("Impossible de supprimer le groupe dans la base de donnée.", "danger");
            if(!empty($_POST['id_groupe'])){
                $this->groupe->deleteGroupe($_POST['id_groupe']);
                $this->Session->setFlash("Le groupe a été supprimé avec succès.", "success");
            }
        } 
        header('Location:/services');
    }
}

?>