<?php 
	class service extends Model {
		var $table = "service";

        //Retourne l'ensemble des services trouvé dans la bdd
		function getServices() {
            return $this->select(array("order"=>" 2 asc"));
        }
        //Retourne le  service trouvé dans la bdd
		function getServiceById( $id_service) {
			return $this->select(array("condition"=>" id_service = :id_service ","bindvalues"=>array(':id_service'=>$id_service)));
		}

        //Supprime un service
        function deleteService($id_service) {
            $this->delete(array("condition"=>" id_service = :id_service","bindvalues"=>array(':id_service'=>$id_service)));
        }
        
        //admin création service
		function createService($libelleService) {
            return $this->insert(array("libelle"=>$libelleService)); 
        }
        
        //Update image du service
        function updateServiceImage($id_service, $filename){
            echo($id_service);
            echo($filename);
            return $this->update(array("fields"=>array('image' => $filename),"bindvalues"=>array('id_service'=>$id_service , 'image' => $filename),"condition"=>" id_service = :id_service ")); 
        }
	}
?>