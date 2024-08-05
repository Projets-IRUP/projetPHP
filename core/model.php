<?php
	//définir une classe
	class Model {
		//propriétés de la classe
	
		public $table;
		public $conf="default";
		public $conn;
		public $db;

		function  __construct() {
			//on fait appel à notre configuration bdd par défaut
			$conf=conf::$databases[$this->conf];
			
			try {
				$this->conn = new PDO('mysql:host='.$conf['host'].';dbname='.$conf['database'].';',
                    $conf['login'],
                    $conf['password'],
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')     //on force Mysql à se connecter en utf8
				);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
 			} catch (PDOException $e) {
				print "Erreur !: " . $e->getMessage() . "<br/>";
				die();
			}
		}
				//DELETE : 
		function delete($data) {

			/* Exécute une requête préparée en passant un tableau de valeurs */
			$sql='DELETE FROM '.$this->table.' WHERE '. $data['condition'];

			// echo $sql;
			$stmt = $this->conn->prepare($sql);

			//bind value
			if (isset($data["bindvalues"])) {
				foreach($data["bindvalues"] as $clef => $valeur){
					$stmt->bindValue($clef, $valeur);  
					// echo($clef.'=>'.$valeur);
				}
				
			}else{
				echo "<br /> erreur SQL 2";
			}

			if (!$stmt->execute()) {
				echo "<br /> erreur SQL";
			} 
		}

		//INSERT 
		function insert($data) {
			// var_dump($data);
			// echo "<PRE>";
			// print_r($data);
			//  echo "</PRE>";
			//construction de la requete SQL
			$sql= "INSERT INTO ".$this->table." (";
			$values="";
			foreach ($data as $key=>$value){
				$sql.=$key.",";
				$values.=" :".$key." ,";
			}
			//enleve la derniere virgule
			$sql = substr($sql, 0, -1);
			$values = substr($values, 0, -1); 
			$sql.=") VALUES (".$values.");";
			
			 echo $sql;
			//préparation
			$stmt = $this->conn->prepare($sql);

			//bindvalue
			foreach($data as $clef => $valeur){
				// $stmt->bindValue(":".$clef, $valeur,PDO::PARAM_STR);  
				$stmt->bindValue(":".$clef, $valeur);  

				//echo($clef.'=>'.$valeur);
			}
			
			try{
				if ($stmt->execute()) {
					
					//On récupère l'id sql du fichier
					return $this->conn->lastinsertId();
					
				} else {
					//echo "<br /> Erreur SQL";
					return "erreur";
				}
			}catch(PDOException $e){
				print "ERREUR MODEL insert: " . $e->getMessage() . "<br/>";
				return "erreur";
			}
		}

		//Update 
		function update($data) {
			// var_dump($data);
			// echo "<PRE>";
			// print_r($data);
			//  echo "</PRE>";
			//construction de la requete SQL
			$sql= "UPDATE ".$this->table." SET ";
			
			foreach ($data["fields"] as $key=>$value){
				$sql.=$key." = :".$key." ,";
				
			}
			//enleve la derniere virgule
			$sql = substr($sql, 0, -1);
			
			$sql .= " WHERE ".$data["condition"];

			echo $sql;
			//préparation
			$stmt = $this->conn->prepare($sql);

			//bindvalue
			foreach($data["bindvalues"] as $clef => $valeur){
				// $stmt->bindValue(":".$clef, $valeur,PDO::PARAM_STR);  
				$stmt->bindValue(":".$clef, $valeur);  

				//echo($clef.'=>'.$valeur);
			}
			
			try{
				if ($stmt->execute()) {
					
					//On récupère l'id sql du fichier
					return $this->conn->lastinsertId();
					
				} else {
					//echo "<br /> Erreur SQL";
					return "erreur";
				}
			}catch(PDOException $e){
				print "ERREUR MODEL UPDATE: " . $e->getMessage() . "<br/>";
				return "erreur";
			}
		}
		// SELECT :
		function select($data) {
			
				$fields=" * ";
				$inner=" ";
				$condition=" 1=1 ";
				$order=" 1 asc ";
				$limit=" ";
				
				if (isset($data["fields"])) {
					$fields=$data["fields"]. " ";
				}
				if (isset($data["inner"])) {
					$inner=$data["inner"]. " ";
				}
				if (isset($data["condition"])) {
					$condition=$data["condition"]. " ";
				}
				if (isset($data["order"])) {
					$order=$data["order"]. " ";
				}
				if (isset($data["limit"])) {
					$limit= " LIMIT " .$data["limit"];
				}
				
				/* Exécute une requête préparée en passant un tableau de valeurs */
				$sql=	'SELECT '.$fields.' FROM '.$this->table.' '.$inner.' WHERE '.$condition.' ORDER BY '.$order.$limit.' ;';
				
				// echo ($sql);
				//préparation
				$stmt = $this->conn->prepare($sql);
				
				//bind value
				if (isset($data["bindvalues"])) {
					foreach($data["bindvalues"] as $clef => $valeur){
						$stmt->bindValue($clef, $valeur,PDO::PARAM_STR);  
						//echo($clef.'=>'.$valeur);
					}
				}
		

				try{
					if ($stmt->execute()) {
						$data = $stmt->fetchAll(PDO::FETCH_OBJ);
						// echo "<PRE>";
						// print_r($data);
						//  echo "</PRE>";
						return $data;
				} else {
					echo "<br /> Erreur SQL";
				}
				}catch(PDOException $e){
					
					print "ERREUR LECTURE SQL. " . $e->getMessage() . "<br/>";
				}

			}

			

		
	}
?>