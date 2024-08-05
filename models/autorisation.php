<?php 
	class autorisation extends Model{
		var $table = "utilisateur";

        //Accès au service
        function getDroitAccesService($id_service,$id_utilisateur){
            return $this->select(array(
                "fields"=>" gs.id_service ",
                "condition"=>" u.id_utilisateur = :id_utilisateur and gs.id_service = :id_service ",
                "inner"=>"  u INNER JOIN groupe_utilisateur gu on   u.id_utilisateur = gu.id_utilisateur 
                INNER JOIN groupe_service gs on gu.id_groupe = gs.id_groupe ",
                "bindvalues"=> array(':id_utilisateur'=>$id_utilisateur,':id_service'=>$id_service)
        
        ));
        }

        
	}
?>