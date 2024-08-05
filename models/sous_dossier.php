<?php 

class sous_dossier extends Model {
		var $table = "sous_dossier";

        //Retourne l'ensemble des dossiers d'un service
		function getSousDossiers($id_dossier) {
            return $this->select(array("order"=>" 3 asc","condition"=>" id_dossier = :id_dossier ","bindvalues"=>array(':id_dossier'=>$id_dossier)));
		}
		//Retourne le dossier trouvé
		function getSousDossierById($id_sousdossier) {
			return $this->select(array("condition"=>" id_sousdossier = :id_sousdossier","bindvalues"=>array(':id_sousdossier'=>$id_sousdossier)));
		}

		//Supprime un dossier
		function deleteSousDossier($id_sousdossier) {
			$this->delete(array("condition"=>" id_sousdossier = :id_sousdossier","bindvalues"=>array(':id_sousdossier'=>$id_sousdossier)));
		}
	
		//Création d'un dossier 
		function createSousDossier($id_dossier,$libelleSousDossier) {
			return $this->insert(array("id_dossier"=>$id_dossier,"libelle"=>$libelleSousDossier)); 
		}

		//Update image du dossier
		function updateSousDossierImage( $id_sousdossier, $filename){
			return $this->update(array("fields"=>array('image' => $filename),"bindvalues"=>array( 'id_sousdossier' =>$id_sousdossier , 'image' => $filename),"condition"=>" id_sousdossier = :id_sousdossier ")); 
		}
}
?>