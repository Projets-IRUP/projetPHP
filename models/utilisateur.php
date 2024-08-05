<?php
    class utilisateur extends Model {
        var $table = "utilisateur";

        //Obtient la liste des utilisateur enregistrés
        function getUtilisateurs(){
            return $this->select(array("order"=>" 2,1 asc"));
        }

        //Ajout d'un utilisateur
        function insertUtilisateur($nom,$prenom,$login,$password){
            return $this->insert(array("nom"=>$nom,"prenom"=>$prenom,"identifiant"=>$login,"motdepasse"=>md5($password))); 
        }

        //Supprime un utilisateur
        function deleteUtilisateur($id_utilisateur){
            $this->delete(array("condition"=>" id_utilisateur = :id_utilisateur","bindvalues"=>array(':id_utilisateur'=>$id_utilisateur)));
        }
    }

?>
