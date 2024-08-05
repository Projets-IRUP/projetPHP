<?php

class sous_dossiers extends controller {

    var $models = array("dossier","autorisation","fichier","sous_dossier","service");

    function index($id_dossier) {
        //Test si la personne est connecté
        if($this->Session->isLogged()) {
            //Test si cet utilisateur à le droit d'accèder au dossier du service
            if(empty($this->autorisation->getDroitAccesService($_SESSION['id_service'],$_SESSION['User']->id_utilisateur)) && !$this->Session->isAdmin() ) {
                $this->Session->setFlash("Vous n'avez pas accès à ce service.", "danger");
                header('Location:/services');
                
            }else{
                $variable['listSousDossier'] = $this->sous_dossier->getSousDossiers($id_dossier);
                $this->Session->write('id_dossier',$id_dossier); 
                $variable['serviceinfo'] = current($this->service->getServiceById($_SESSION['id_service']));
                $variable['dossierinfo'] = current($this->dossier->getDossierById($_SESSION['id_dossier']));
                $this->set($variable);
                $this->layout='defaultlog';
                $this->render('index');

                //  echo "<PRE>";
                //  print_r($listSousServices);
                //  echo "</PRE>";
                echo ( $this->Session->Flash());
            }
        }else{
            $this->Session->setFlash("Veuillez-vous connecter pour accèder à cette page, merci", "danger");
            $this->layout = 'default';
            header('Location:/');
        }
     
    }
  //Ajout image d'un sous-dossier
  function adminAjoutImage(){
        
    //On test si l'utilisateur est admin :
    if($this->Session->isAdmin()){
        $id_sousdossier = $_POST['id_sousdossier'];
        //  echo ($id_sousservice);
        // $nbFichiersEnvoyes = count($_FILES['fichiers']["name"]);
        //  echo ($nbFichiersEnvoyes);
        if(!empty($id_sousdossier) && isset($_FILES) && !empty($_FILES)){
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
                $this->Session->setFlash("Téléchargement impossible, l'image attribuée au sous-dossier est supprimée. ","warning");
                $this->sous_dossier->updateSousDossierImage($id_sousdossier,null);
            }else {
                // On enregistre le lien de l'images du service
                $this->sous_dossier->updateSousDossierImage($id_sousdossier, $_FILES['fichiers']["name"][0]);
                $this->Session->setFlash("L'image a bien été ajoutée.", "success");
            }

        }else{
            $this->Session->setFlash("Impossible d'ajouter l'image au sous-dossier", "danger");
        }
    }
     header('Location:/sous_dossiers/index/'.$_SESSION['id_dossier']);
}
    //Ajout d'un sous-dossier
    function adminAjoutSousDossier(){
        //var_dump($_POST);
        if($this->Session->isAdmin()){
            $id=$this->sous_dossier->createSousDossier($_SESSION['id_dossier'],$_POST['nomSousDossier']);
            if(!empty($id)){
                $cheminNouveauDossier="webroot/fichiers/".$_SESSION['id_service']."/".$_SESSION['id_dossier']."/".$id;

                //test inutile normalement car id unique autoincrement
                if(!file_exists( $cheminNouveauDossier)){
                    if(mkdir( $cheminNouveauDossier)){
                        $this->Session->setFlash("Le sous-dossier a été créer avec succès.", "success");
                    }else{
                        $this->Session->setFlash("Impossible de créer le sous-dossier.", "danger"); 
                    }
                }else{
                    $this->Session->setFlash("Le sous-dossier existe déjà.", "warning"); 
                }
            }else{
                $this->Session->setFlash("Impossible de créer le sous-dossier dans la base de donnée.", "danger");
            }
        }
        header('Location:/sous_dossiers/index/'.$_SESSION['id_dossier']);
    }
        //Suppression d'un dossier
        function adminDeleteSousDossier(){
            if($this->Session->isAdmin()){
                $id_sousdossier = $_POST['id_sousdossier'];
                //echo $id_sousservice;
                if(!empty($id_sousdossier)){
    
                    if(empty($this->fichier->getFiles($id_sousdossier,0,1))){
                        $cheminDossier="webroot/fichiers/".$_SESSION['id_service']."/".$_SESSION['id_dossier']."/".$id_sousdossier;
                        if(rmdir($cheminDossier)){
                            $this->sous_dossier->deleteSousDossier($id_sousdossier);
                            $this->Session->setFlash("Le sous-dossier a été supprimé avec succès.", "success");
                        }else{
                            $this->Session->setFlash("Impossible de supprimer le sous-dossier dans la base de donnée.1", "danger");
                        }
                    }else{
                        $this->Session->setFlash("Impossible de supprimer le sous-dossier car il contient des sous-dossier.", "danger");
                    }
                }else{
                    $this->Session->setFlash("Impossible de supprimer le sous-dossier dans la base de donnée.2", "danger");
                }
            }
            header('Location:/sous_dossiers/index/'.$_SESSION['id_dossier']);
        }

}

?>