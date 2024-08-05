<h2 class="display-7  " style="text-align:center; padding:0px;"><a class="lienArbo" href="/services"><p style="text-transform: uppercase;display:inline; text-decoration: underline; text-decoration: bold;">Accueil </p> </a>/
<a class="lienArbo" href="/dossiers/index/<?= $serviceinfo->id_service?>"><p style="text-transform: uppercase;display:inline; text-decoration: underline; text-decoration: bold;"><?= $serviceinfo->libelle ?></p> </a>/
<a class="lienArbo" href="/sous_dossiers/index/<?= $dossierinfo->id_dossier?>"><p style="text-transform: uppercase;display:inline; text-decoration: underline; text-decoration: bold;"><?= $dossierinfo->libelle ?></p> </a>
</h2></br>

<section id="card">
    <div class="container h-100">
        <div class="row">

            <?php 
                // echo "<PRE>";
                // print_r($listDossier);
                // echo "</PRE>";        
                // echo "<PRE>";
                // print_r($id_service);
                // echo "</PRE>"; 
                
            foreach ($listSousDossier as $key => $sousdossier) { 
                
                // echo' <div class="col-md-6 col-lg-4 column" onclick=" getRightService('.$service->id_service.',\''.WEBROOT2.'\')">';
                echo' <div class="col-md-6 col-lg-4 column">';
                echo'    <a href="/fichiers/index/'.$sousdossier->id_sousdossier.'">';
                echo'       <div class="card gr-1">';
                echo'          <div class="txt">';
                echo'              <h1 class="display-1"> '. $sousdossier->libelle .'</h1>';
                echo'           </div>';
                echo'          <div class="ico-card">';
                if($sousdossier->image == null){
                    echo'              <i class="fa fa-folder-open" aria-hidden="true"></i>';
                }else{
                    echo'              <div  style="float:right; width: 170px; height: 170px; align-items:center; justify-content:center; display:flex;">';
                    echo'              <img src="/webroot/img/imagesServices/'.$sousdossier->image.'" style=" max-width: 160px;">';
                    echo'              </div>';
                }
                echo'          </div>';
                echo'      </div>';
                echo'   </a>';
                echo'</div>';
   

             } 
             ?>
        </div>
    </div>
</section>

<!-- Icone + afficher ou non en fonction du type de compte utiliser si il est admin du systeme ou non -->
 <?php 
//var_dump( $_SESSION['User']);
if( $_SESSION['User']->admin ==1){?>
                
                <div class="action" onclick="actionToggle();" id="buttonAdmin">
                    <span>+</span>
                    <ul>
                        <li onclick="OpenAddSousDossierModal()"><i class="fa fa-plus" aria-hidden="true"></i>Ajouter un sous-dossier</li>
                        <li onclick="OpenDeleteSousDossierModal()"><i class="fa fa-trash" aria-hidden="true"></i>Supprimer un sous-dossier</li>
                        <li onclick="OpenImageSousDossierModal()"><i class="fa fa-plus" aria-hidden="true"></i>Ajouter une image</li>
                    </ul>
                </div>
	
<?php
}
?>
<!-- Modal pour images au sous-dossier  -->
<div class="modal fade" tabindex="-1" id="ModalAjoutImageSousDossier" aria-labelledby="ModalAjoutImageSousDossier" aria-hidden="true" enctype="multipart/form-data">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Ajouter une image à un sous-dossier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formAjoutImage"  method="post"  action="/sous_dossiers/adminAjoutImage" enctype="multipart/form-data"  >
                <div class="modal-body">
                    <select name="id_sousdossier" class="form-select" size="3" aria-label="size 3 select example">
                        <?php foreach ($listSousDossier as $key => $sousdossier) {?>
                            <option  value="<?= $sousdossier->id_sousdossier?>"> <?= $sousdossier->libelle ?></option>
                        <?php  } ?>

                    </select></br>
                    <div class="input-group ">
                        <!-- Entrée de fichiers à déposer -->
                        <input type="file" class="form-control" name="fichiers[]"id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"   aria-label="Upload"  accept=".jpg, .jpeg, .png">
                        <!-- Btn pour effacer les fichier chargé -->
                        <button class="btn btn-outline-secondary" type="button" onclick="$('#formAjoutImage')[0].reset();"id="inputGroupFileAddon04">X</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter l'image</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Modal pour ajouter un sous-dossier  -->
<div class="modal fade" tabindex="-1" id="ModalAddSousDossier" aria-labelledby="ModalAddSousDossier" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Ajouter un sous-dossier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post"  action="/sous_dossiers/adminAjoutSousDossier"  enctype="multipart/form-data"  >
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="nomSousDossier" id="floatingNomSousDossier" placeholder="Nom du sous-dossier" required>
                        <label for="floatingNomSousDossier">Nom du sous-dossier</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal pour supprimer un sous-dossier  -->
<div class="modal fade" tabindex="-1" id="ModalDeleteSousDossier" aria-labelledby="ModalDeleteSousDossier" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Supprimer un sous-dossier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post"  action="/sous_dossiers/adminDeleteSousDossier"  >
                <div class="modal-body">
                <select name="id_sousdossier" class="form-select" size="3" aria-label="size 3 select example">
                    
                    <?php foreach ($listSousDossier as $key => $sousdossier) {?>
                        <option  value="<?= $sousdossier->id_sousdossier?>"> <?= $sousdossier->libelle ?></option>
                     <?php  } ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Supprimer</button>
                </div>
            </form>

        </div>
    </div>
</div>


