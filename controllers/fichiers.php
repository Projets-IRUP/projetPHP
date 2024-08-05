<?php

class fichiers extends controller {
    //On charge les classes model utilisées
    var $models = array("fichier","autorisation","sous_dossier","utilisateur","service","dossier");
    public $nbFichierParPage=12 ;
    public $nbFichier;
    public $curentPage = 1;

    
    function index($id_sousdossier) {
        $this->Session->write('id_sousdossier',$id_sousdossier); 
        if($this->Session->isLogged()) {
            if(empty($this->autorisation->getDroitAccesService($_SESSION['id_service'],$_SESSION['User']->id_utilisateur)) && !$this->Session->isAdmin() ) {
                $this->Session->setFlash("Vous n'avez pas accès à ce service.", "danger");
                header('Location:/services');
                 
            }else{
                //on charge le tableau 1ere page
                $this->nbFichier=current( $this->fichier->getNbFiles($id_sousdossier))->count;
                $this->Session->write('nbPage',Ceil($this->nbFichier / $this->nbFichierParPage)); 
                $premier =( ($this->nbFichierParPage*$this->curentPage)-$this->nbFichierParPage);

                $variable=array();
                $variable['listFichier'] = $this->fichier->getFiles($id_sousdossier, $premier, $this->nbFichierParPage);
                
                $variable['serviceinfo'] = current($this->service->getServiceById($_SESSION['id_service']));
                $variable['dossierinfo'] = current($this->dossier->getDossierById($_SESSION['id_dossier']));
                $variable['sousdossierinfo'] = current($this->sous_dossier->getSousDossierById($id_sousdossier));

                $this->set($variable);
                $this->layout='defaultlog';
                $this->render('index');
            }

        }else{
            $this->Session->setFlash("Veuillez-vous connecter pour accèder à cette page, merci", "danger");
            
            $this->layout = 'default';
            //je rends la vue index
            header('Location:/');
        }
     
    }

    function ajoutFichier(){
        // echo"<PRE>";
        // echo print_r($_FILES);
        // echo"</PRE>";
        if($this->Session->isAdmin()){
            if (isset($_FILES) && (!empty($_FILES))){
                        
                $nbFichiersEnvoyes = count($_FILES['fichiers']["name"]);

                for($i=0;$i<$nbFichiersEnvoyes;$i++ ){

                    //Chemin du fichier à enregistrer :
                    $cheminFichier="webroot/fichiers/".$_SESSION['id_service']."/".$_SESSION['id_dossier']."/".$_SESSION['id_sousdossier']."/". str_replace('\'',' ',$_FILES['fichiers']["name"][0]);              
                    //echo $im_src;

                    //On test si le fichier existe déjà si c'est le cas, on renvoie une erreur
                    if(file_exists( $cheminFichier)){
                        $this->Session->setFlash("Impossible d'ajouter le fichier ".$_FILES['fichiers']["name"][0].", un autre fichier du même nom existe déjà.", "warning");
                    }else{
                   
                        //on tente de upload le fichier dans le dossier fichiers
                        if(!move_uploaded_file($_FILES['fichiers']["tmp_name"][$i], $cheminFichier)){
                            $this->Session->setFlash("Telechargelment KO","danger");
                        }else {
                            // On enregistre le lien vers le fichier dans la table fichier 
                            $idFichier = $this->fichier->saveFiles( $_SESSION['id_sousdossier'],str_replace('\'',' ',$_FILES['fichiers']["name"][0]),$_FILES['fichiers']["size"][0]);
                            $this->Session->setFlash("Le fichier a bien été ajouté.", "success");
                        }
                    }
                }

            } else {
                $this->Session->setFlash("Une erreur s'est produite sur l'ajout de fichier.", "danger");
            }
            //On recharge la page afin, afficher flash msg et raffraichier la liste des fichiers du tableau:
            header('Location:/fichiers/index/'.$_SESSION['id_sousdossier']);
        }

    }
    
    function supprimerFichier(){
            // echo"<PRE>";
            // echo print_r($_POST);
            // echo"</PRE>";

        if($this->Session->isAdmin()){
            if (isset($_POST) && (!empty($_POST))){

                // On supprime le lien vers le fichier dans la table fichier 
                $this->fichier->deleteFile( $_POST['fichier'], $_SESSION['id_sousdossier']);
                    
                //On supprime le fichier du dossier
                unlink("webroot/fichiers/".$_SESSION['id_service']."/".$_SESSION['id_dossier']."/".$_SESSION['id_sousdossier']."/". $_POST['fichier'] );

                //on retourne à la vue liste de fichiers
                $this->Session->setFlash("Le fichier a bien été supprimé.", "success");
                header('Location:/fichiers/index/'.$_SESSION['id_sousdossier']);
            } else {
                $this->Session->setFlash("Une erreur s'est produite lors de la suppression du fichier.", "danger");
                header('Location:/fichiers/index/'.$_SESSION['id_sousdossier']);
            }
        }

        
    }

    //Function de chargement du tableau de fichier lors de l'appel AJAX
    function chargementTableauDeFichier($currentPage=null){
        if(isset($currentPage)){
            $this->curentPage=$currentPage;
        }
        $premier =( ($this->nbFichierParPage * $this->curentPage)-$this->nbFichierParPage);
        $listFichier=$this->fichier->getFiles($_SESSION['id_sousdossier'], $premier,$this->nbFichierParPage);
        require(ROOT.'views/fichiers/tableauAjax.php'); 
    }
}

?>