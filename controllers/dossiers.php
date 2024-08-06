<?php

class dossiers extends controller {

    var $models = array("dossier","autorisation","fichier","service","sous_dossier");

    function index($id_service) {
        //Test si la personne est connecté
        if($this->Session->isLogged()) {
            //Test si cet utilisateur à le droit d'accèder au dossier du service
            if(empty($this->autorisation->getDroitAccesService($id_service,$_SESSION['User']->id_utilisateur)) && !$this->Session->isAdmin() ) {
                $this->Session->setFlash("Vous n'avez pas accès à ce service.", "danger");
                header('Location:/services');
                
            }else{
                
               
                $variable['listDossier'] = $this->dossier->getDossiers($id_service);
                $this->Session->write('id_service',$id_service); 
                $variable['serviceinfo'] = current($this->service->getServiceById($_SESSION['id_service']));
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
  //Ajout image d'un dossier
  function adminAjoutImage(){
    if($this->Session->isAdmin()){
        $id_dossier = $_POST['id_dossier'];
        //  echo ($id_sousservice);
        // $nbFichiersEnvoyes = count($_FILES['fichiers']["name"]);
        //  echo ($nbFichiersEnvoyes);
        if(!empty($id_dossier) && isset($_FILES) && !empty($_FILES)){
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
                $this->Session->setFlash("Téléchargement impossible, l'image attribuée au dossier est supprimée. ","warning");
                $this->dossier->updateDossierImage($id_dossier,null);
            }else {
                // On enregistre le lien de l'images du service
                $this->dossier->updateDossierImage($id_dossier, $_FILES['fichiers']["name"][0]);
                $this->Session->setFlash("L'image a bien été ajoutée.", "success");
            }

        }else{
            $this->Session->setFlash("Impossible d'ajouter l'image au dossier", "danger");
        }
    }
     header('Location:/dossiers/index/'.$_SESSION['id_service']);
}
    //Ajout d'un dossier
    function adminAjoutDossier(){
        //var_dump($_POST);
        if($this->Session->isAdmin()){
            $id=$this->dossier->createDossier($_SESSION['id_service'],$_POST['nomDossier']);
            if(!empty($id)){
                $cheminNouveauDossier="webroot/fichiers/".$_SESSION['id_service']."/".$id;

                //test inutile normalement car id unique autoincrement
                if(!file_exists( $cheminNouveauDossier)){
                    if(mkdir( $cheminNouveauDossier)){
                        $this->Session->setFlash("Le dossier a été créé avec succès.", "success");
                    }else{
                        $this->Session->setFlash("Impossible de créer le dossier.", "danger"); 
                    }
                }else{
                    $this->Session->setFlash("Le dossier existe déjà.", "warning"); 
                }
            }else{
                $this->Session->setFlash("Impossible de créer le dossier dans la base de donnée.", "danger");
            }
        }
        header('Location:/dossiers/index/'.$_SESSION['id_service']);
    }
        //Suppression d'un dossier
        function adminDeleteDossier(){
            if($this->Session->isAdmin()){
                $id_dossier = $_POST['id_dossier'];
                //echo $id_sousservice;
                if(!empty($id_dossier)){
    
                    if(empty($this->sous_dossier->getSousDossiers($id_dossier,0,1))){
                        $cheminDossier="webroot/fichiers/".$_SESSION['id_service']."/".$id_dossier;;
                        if(rmdir($cheminDossier)){
                            $this->dossier->deleteDossier($id_dossier);
                            $this->Session->setFlash("Le dossier a été supprimé avec succès.", "success");
                        }else{
                            $this->Session->setFlash("Impossible de supprimer le dossier dans la base de donnée.1", "danger");
                        }
                    }else{
                        $this->Session->setFlash("Impossible de supprimer le dossier car il contient des sous-dossier.", "danger");
                    }
                }else{
                    $this->Session->setFlash("Impossible de supprimer le dossier dans la base de donnée.2", "danger");
                }
            }
            header('Location:/dossiers/index/'.$_SESSION['id_service']);
        }
}

?>