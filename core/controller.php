<?php

// layout : lorsqu'on a un site web, on a le coeur de notre page avec ce qui tourne autour (entete, menu, pied du site) :
// ces trois éléments sont le layout
class controller  {

    var $variables = array();
    var $layout = "default";

    function __construct() {
        // chargement de tous nos modèles en mémoire
        if(isset($this->models)) {
            foreach($this->models as $m) {
                $this->loadmodel($m);
            }
        }
        $this->Session = new Session();
    }

    //méthode static load (bien pratique)
    function loadmodel($name) {
        //chargement du model
        require (ROOT."models/".strtolower($name).".php");
        //je retourne une instance de ma classe passée en paramètre
        $this->$name = new $name();
    }

    function render($filename) {
        // echo $filename;
      
        // echo "<PRE>";
        // print_r($this->variables);
        // echo "</PRE>";
        //il transforme chaque élément d'un tableau en variables
        extract($this->variables);
        //  echo "<PRE>";
        //  print_r($listFichier);
        //  echo "</PRE>"; 
    
        // je démarre une mise en mémoire tampon. Au lieu d'afficher, le ob_start intercepte
        ob_start();

        //get_class($this) : retourne le nom de l'objet : category...
        require (ROOT."views/".get_class($this)."/".$filename.".php");

        $content_for_layout = ob_get_clean();

        // si on n'a pas de layout
        if($this->layout==false) {
            echo $content_for_layout;
        } else {
            require (ROOT."views/layout/".$this->layout.".php");
        }
    }

    function set($d) {
        //fusion des données à envoyer avec les données déjà présentes dans $vars
        $this->variables=array_merge($this->variables,$d);

    }
}


?>