<div class = "row">
<div class="col-7">
<h2 class="display-7  " style="text-align:center; padding:0px;">
<a class="lienArbo" href="/services"><p style="text-transform: uppercase;display:inline; text-decoration: underline; text-decoration: bold;">Accueil </p> </a>
/
<a class="lienArbo" href="/dossiers/index/<?= $serviceinfo->id_service?>"><p style="text-transform: uppercase;display:inline; text-decoration: underline; text-decoration: bold;"><?= $serviceinfo->libelle ?></p> </a>
/ 
<a class="lienArbo" href="/sous_dossiers/index/<?= $dossierinfo->id_dossier?>"><p style="text-transform: uppercase;display:inline; text-decoration: underline; text-decoration: bold;"><?= $dossierinfo->libelle ?></p> </a>
/
<a class="lienArbo" href="/fichiers/index/<?= $sousdossierinfo->id_sousdossier?>"><p style="text-transform: uppercase;display:inline; text-decoration: underline; text-decoration: bold;"><?= $sousdossierinfo->libelle ?></p> </a>
</h2></br>




<?php 
    // var_dump($listUtilisateurs);
    // var_dump($listAttributions);
    // echo ( $this->Session['id_service']);
    // echo ( $this->Session['id_sous_service']);
    //    echo "<PRE>";
    //  print_r($_SESSION);
    //   echo "</PRE>";
    require(ROOT.'views/fichiers/tableauAjax.php');

    
    //On test si il a le droit d'ecriture et où d'admin pour ajouter des fichiers 
    //   2 = write
    //   3 = admin
    if($this->Session->isAdmin()){?>

        <div class="action" onclick="actionToggle();" id="buttonAdmin">
            <span>+</span>
            <ul>
                <li onclick="OpenAddFichierModal()"><i class="fa fa-plus" aria-hidden="true"></i>Ajouter un fichier</li>
                <li onclick="OpenDeleteFichierModal()"><i class="fa fa-trash" aria-hidden="true"></i>Supprimer un fichier</li>
            </ul>
        </div>
<?php
    }
?>
</div>
<div class="col-5" style=" padding:0; min-width: 400px;">
    <iframe class="doc" id="iframePreviewPdf"  style =" width: 100%;height:93.5vh ; "src=""></iframe>
    <!-- <div  style="text-align:center; vertical-align:midle;">
        <h2>PDF Preview</h2>
    </div> -->
</div>
</div>

