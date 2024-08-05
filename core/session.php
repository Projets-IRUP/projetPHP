<?php
	//définir une classe
	class Session {
	
		function  __construct() {
			if(!isset($_SESSION)) {
				session_start();
			}
		}


		//méthode pour affecter un message (d'erreur ou pas...)
		public function setFlash($message,$type="success",$icon="") {
			$_SESSION['flash'] = array (
				'message'=>$message,
				'icon'=>$icon,
				'type'=>$type

			);

		}

		//méthode pour afficher un message (d'erreur ou pas...)
		public function flash() {
			if(isset($_SESSION['flash']['message'])) {
				// echo "<PRE>";
				// print_r($_SESSION['flash']);
				// echo "</PRE>";
				$html = '<div id="alert" class="alert alert-'.$_SESSION['flash']['type'].' " role="alert" style="text-align:center;">';
				$html .= $_SESSION['flash']['icon'];
				$html .= $_SESSION['flash']['message'];
				$html .= '</div>';
				unset($_SESSION['flash']);
				return $html;
	;
				
			}
		}

		//initialisation d'une variable de SESSION
		public function write($key,$value) {
			$_SESSION[$key] = $value;
			// echo "<PRE>";
			// print_r($value);
			// echo "</PRE>";
			
		}

		//lecture d'une variable de SESSION
		public function read($key) {
			if($key) {
				if(isset($_SESSION[$key])) {
					return $_SESSION[$key];
				} else {
					return false;
				}
			} else {
				return $_SESSION;
			}
		}

		//Savoir si l'utilisateur est connecté
		public function isLogged() {
			return isset($_SESSION['User']->nom);
			
		}

		//Savoir si l'utilisateur est un administrateur
		public function isAdmin() {
			return ($_SESSION['User']->admin==1);
			
		}

		//Obtient l'utilisateur 
		public function user($key) {
			if($this->read('User')) {
				if(isset($this->read('User')->$key)) {
					return $this->read('User')->$key;
				} else {
					return false;
				}
			}
			return false;
		}
	}
?>