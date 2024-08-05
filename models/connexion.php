<?php 
	class connexion extends Model{
		var $table = "utilisateur";

        //Retourne l'utilisateur
        function getUser($login,$password,$limit=1) {
            return $this->select(array( 
            "fields"=>" * ", 
            "condition"=>" identifiant = :login and motdepasse= :password",
            "inner"=>"",
            "bindvalues"=>array(':login'=>$login,':password'=>md5($password)),
            "limit"=>$limit
            ));
        }
	}
?>