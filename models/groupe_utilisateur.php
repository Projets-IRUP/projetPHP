<?php 
	class groupe_utilisateur extends Model{

		var $table = "groupe_utilisateur";
        
        //Supprime les droits d'un utilisateur sur un groupe
        function deleteGroupeUtilisateur($id_utilisateur){
            $this->delete(array("condition"=>" id_utilisateur = :id_utilisateur","bindvalues"=>array(':id_utilisateur'=>$id_utilisateur)));
        }

        //Enregistre les groupes d'un utilisateur
        function insertGroupeUtilisateur($id_utilisateur,$id_groupe){
            return $this->insert(array("id_utilisateur"=>$id_utilisateur,"id_groupe"=>$id_groupe )); 
        }

        //Selectionne les groupes d'un utilisateur
		function getGroupeUtilisateurByUtilisateur($id_utilisateur) {
            return $this->select(array("fields"=>"id_groupe","condition"=>" id_utilisateur = :id_utilisateur","bindvalues"=>array(':id_utilisateur'=>$id_utilisateur)));
        }

	}
?>