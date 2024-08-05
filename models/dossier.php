<?php 
	class dossier extends Model {
		var $table = "dossier";

        //Retourne l'ensemble des dossiers d'un service
		function getDossiers($id_service) {
            return $this->select(array("order"=>" 3 asc","condition"=>" id_service = :id_service ","bindvalues"=>array(':id_service'=>$id_service)));
		}
		//Retourne le dossier trouvé
		function getDossierById($id_dossier) {
			return $this->select(array("condition"=>" id_dossier = :id_dossier","bindvalues"=>array(':id_dossier'=>$id_dossier)));
		}

		//Supprime un dossier
		function deleteDossier($id_dossier) {
			$this->delete(array("condition"=>" id_dossier = :id_dossier","bindvalues"=>array(':id_dossier'=>$id_dossier)));
		}
	
		//Création d'un dossier 
		function createDossier($id_service,$libelleDossier) {
			return $this->insert(array("id_service"=>$id_service,"libelle"=>$libelleDossier)); 
		}

		//Update image du dossier
		function updateDossierImage( $id_dossier, $filename){
			return $this->update(array("fields"=>array('image' => $filename),"bindvalues"=>array('id_dossier'=>$id_dossier , 'image' => $filename),"condition"=>" id_dossier = :id_dossier ")); 
		}
}
?>