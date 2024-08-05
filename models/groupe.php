<?php 
	class groupe extends Model{

		var $table = "groupe";


        //Ajout d'une attribution d'accès aux sous service en lecture ou en modification
        function insertGroupe($libelle){
            return $this->insert(array("libelle"=>$libelle)); 
        }

        //Retourne l'ensemble des services ou l'utilisateur à accès trouvé dans la bdd
		function getGroupes() {
            return $this->select(array(
            "fields"=>"  groupe.id_groupe, groupe.libelle",
            "order"=>" 2 asc"
            ));
        }
        //Supprime un groupe (en cascades sur les tables qui reference id_groupe)
        function deleteGroupe($id_groupe){
            $this->delete(array("condition"=>" id_groupe = :id_groupe","bindvalues"=>array(':id_groupe'=>$id_groupe)));
        }

	}
?>