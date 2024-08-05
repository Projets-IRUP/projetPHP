<?php 
	// hérite de la classe Model
	class groupe_service extends Model{

		var $table = "groupe_service";
        
        //Supprime les droits d'un groupe
        function deleteGroupeService($id_groupe){
            $this->delete(array("condition"=>" id_groupe = :id_groupe","bindvalues"=>array(':id_groupe'=>$id_groupe)));
        }

        //Enregistre les droits d'un groupe sur un service
        function insertGroupeService($id_groupe,$id_service){
            return $this->insert(array("id_groupe"=>$id_groupe,"id_service"=>$id_service )); 
        }

        //Selectionne les services d'un groupe
		function getGroupesServiceByGroupe($id_groupe) {
            return $this->select(array("fields"=>"id_service","condition"=>" id_groupe = :id_groupe","bindvalues"=>array(':id_groupe'=>$id_groupe)));
        }


	}
?>