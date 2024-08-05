<?php 
	class fichier extends Model {
		var $table = "fichier";

		//Retourne l'ensemble des fichiers pour une page donné trouvé dans la bdd
		function getFiles($id_sousdossier,$premierfichier,$nbfichier) {
			return $this->select(array("order"=>" nom asc ","condition"=>" id_sousdossier= :id_sousdossier ","limit"=>$premierfichier." , ".$nbfichier,"bindvalues"=>array(':id_sousdossier'=>$id_sousdossier)));
		}

		//Obtient le nombre de fichier du sous-dossier:
		function getNbFiles($id_sousdossier) {
			return $this->select(array("fields"=>"count(id_fichier) as count","condition"=>" id_sousdossier = :id_sousdossier ","bindvalues"=>array(':id_sousdossier'=>$id_sousdossier)));
		}

		//Enregistre un fichier et retourne son id 
		function saveFiles($id_sousdossier, $nom, $taille) {
			return $this->insert(array("id_sousdossier"=>$id_sousdossier,"nom"=>$nom,"taille"=>$taille)); 
		}

		//Supprime un fichier
		function deleteFile($nom, $id_sousdossier) {
			$this->delete(array("condition"=>" nom = :nom and id_sousdossier=:id_sousdossier ","bindvalues"=>array(':nom'=>$nom, ':id_sousdossier'=>$id_sousdossier)));
		}

}
?>