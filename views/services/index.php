<h2 class="display-7  " style="text-align:center; padding:0px;"><a class="lienArbo" href="/services"><p style="text-transform: uppercase;display:inline; text-decoration: underline; text-decoration: bold;">Accueil </p> </a></h2></br>
<section id="card">
    <div class="container h-100">
        <div class="row">

            <?php 
                // echo "<PRE>";
                // print_r($listServices);
                // echo "</PRE>";        

            foreach ($listServices as $key => $service) { 
               
                // echo' <div class="col-md-6 col-lg-4 column" onclick=" getRightService('.$service->id_service.',\''.WEBROOT2.'\')">';
                echo' <div class="col-md-6 col-lg-4 column">';
                echo'    <a href="/dossiers/index/'.$service->id_service.'">';
                echo'       <div class="card gr-1">';
                echo'          <div class="txt">';
                echo'              <h1 class="display-1"> '. $service->libelle .'</h1>';
                echo'           </div>';
                echo'           <div class="ico-card">';
            
                if($service->image == null){
                    echo'              <i class="fa fa-folder-open" aria-hidden="true"></i>';
                }else{
                    echo'              <div  style="float:right; width: 170px; height: 170px; align-items:center; justify-content:center; display:flex;">';
                    echo'              <img src="/webroot/img/imagesServices/'.$service->image.'" style=" max-width: 160px;">';
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
                        <!-- Modal service -->
                        <li onclick="OpenAddServiceModal()"><i class="fa fa-plus" aria-hidden="true"></i>Ajouter un service</li>
                        <li onclick="OpenDeleteServiceModal()"><i class="fa fa-trash" aria-hidden="true"></i>Supprimer un service</li>
                        <!-- Modal utilisateur -->
                        <li onclick="OpenAddUserModal()"><i class="fa fa-plus" aria-hidden="true"></i>Ajouter un utilisateur</li>
                        <li onclick="OpenGestionUserModal()"><i class="fa fa-pencil" aria-hidden="true"></i>Gestion utilisateur</li>
                        <li onclick="OpenDeleteUserModal()"><i class="fa fa-trash" aria-hidden="true"></i>Supprimer un utilisateur</li>
                        <!-- Modal groupe -->
                        <li onclick="OpenAddGroupModal()"><i class="fa fa-plus" aria-hidden="true"></i>Ajouter un groupe</li>
                        <li onclick="OpenGestionGroupModal()"><i class="fa fa-pencil" aria-hidden="true"></i>Gestion groupe</li>
                        <li onclick="OpenDeleteGroupModal()"><i class="fa fa-trash" aria-hidden="true"></i>Supprimer un groupe</li>
                        <!-- Modal image -->
                        <li onclick="OpenImageServiceModal()"><i class="fa fa-plus" aria-hidden="true"></i>Ajouter une image</li>
                      
                    </ul>
                </div>
<?php
}
?>

<!-- Modal pour images des Service  -->
<div class="modal fade" tabindex="-1" id="ModalAjoutImage" aria-labelledby="ModalAjoutImage" aria-hidden="true" enctype="multipart/form-data">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Ajouter une image à un service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formAjoutImage"  method="post"  action="/services/adminAjoutImage" enctype="multipart/form-data"  >
                <div class="modal-body">
                    <select name="id_service" class="form-select" size="3" aria-label="size 3 select example">
                        
                        <?php foreach ($listServices as $key => $service) {?>
                            <option  value="<?= $service->id_service?>"> <?= $service->libelle ?></option>
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
<!-- Modal pour ajouter un Service  -->
<div class="modal fade" tabindex="-1" id="ModalAddService" aria-labelledby="ModalAddService" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Ajouter un service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post"  action="/services/adminAjoutService"  enctype="multipart/form-data"  >
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="nomService" id="floatingNomService" placeholder="Nom du service" required>
                        <label for="floatingNomService">Nom du service</label>
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

<!-- Modal pour supprimer un Service  -->
<div class="modal fade" tabindex="-1" id="ModalDeleteService" aria-labelledby="ModalDeleteService" aria-hidden="true" enctype="multipart/form-data">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Supprimer un service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formDeleteFichier"  method="post"  action="/services/adminDeleteService"  >
                <div class="modal-body">
                    <select name="id_service" class="form-select" size="3" aria-label="size 3 select example">
                    
                    <?php foreach ($listServices as $key => $service) {?>
                        <option  value="<?= $service->id_service?>"> <?= $service->libelle ?></option>
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

<!-- Modal pour ajouter un User  -->
<div class="modal fade" tabindex="-1" id="ModalAddUser" aria-labelledby="ModalAddUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Ajouter un Utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post"  action="/services/adminAjoutUser"  enctype="multipart/form-data"  >
                <div class="modal-body">

                    <div class="form-floating">
                        <input type="text" class="form-control" name="nom" id="floatingNom" placeholder="Nom" required>
                        <label for="floatingNom">Nom</label>
                    </div></br>

                    <div class="form-floating">
                        <input type="text" class="form-control" name="prenom" id="floatingPrenom" placeholder="Prénom" required>
                        <label for="floatingPrenom">Prénom</label>
                    </div></br>

                    <div class="form-floating">
                        <input type="text" class="form-control" name="login" id="floatingLogin" placeholder="Login" required>
                        <label for="floatingLogin">Login</label>
                    </div></br>

                    <div class="form-floating">
                        <input type="text" class="form-control" name="password" id="floatingPassword" placeholder="Mot de passe" required>
                        <label for="floatingPassword">Mot de passe</label>
                    </div></br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Modal Gestion Utilisateur -->
<div class="modal fade" tabindex="-1" id="ModalGestionUser" aria-labelledby="ModalGestionUser" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Gestion utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formGestionGroupe"  method="post"  action="/services/adminGestionUtilisateur">
                <div class="modal-body">
                    <h6>Utilisateur :</h6>
                    <select name="id_utilisateur" onChange="ajaxMajCheckboxGestionUtilisateur(value)" class="form-select" aria-label="Default select example" required>
                    <option  value=""> </option>
                    <?php foreach ($listUtilisateurs as $key => $utilisateur) {?>
                        <option  value="<?= $utilisateur->id_utilisateur?>"> <?= $utilisateur->nom." ".$utilisateur->prenom?></option>
                     <?php  } ?>

                    </select></br>
                    
                    <?php require(ROOT.'views/services/ajaxGestionUtilisateur.php');?>
                    

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal pour supprimer un User  -->
<div class="modal fade" tabindex="-1" id="ModalDeleteUser" aria-labelledby="ModalDeleteUser" aria-hidden="true" enctype="multipart/form-data">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Supprimer un utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formDeleteFichier"  method="post"  action="/services/adminDeleteUser"  >
                <div class="modal-body">
                <select name="id_utilisateur" class="form-select" size="15" aria-label="size 3 select example">
                    
                    <?php foreach ($listUtilisateurs as $key => $utilisateur) {?>
                        <option  value="<?= $utilisateur->id_utilisateur?>"> <?= $utilisateur->nom." ".$utilisateur->prenom?></option>
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

<!-- Modal pour ajouter un Groupe  -->
<div class="modal fade" tabindex="-1" id="ModalAddGroupe" aria-labelledby="ModalAddGroupe" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Ajouter un Groupe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post"  action="/services/adminAjoutGroupe"  enctype="multipart/form-data"  >
                <div class="modal-body">

                    <div class="form-floating">
                        <input type="text" class="form-control" name="libelle" id="floatingLibelle" placeholder="Libelle" required>
                        <label for="floatingLibelle">Libellé du groupe</label>
                    </div></br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>

        </div>
    </div>
</div>



<!-- Modal Gestion Groupe -->
<div class="modal fade" tabindex="-1" id="ModalGestionGroupe" aria-labelledby="ModalGestionGroupe" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Gestion groupe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formGestionGroupe"  method="post"  action="/services/adminGestionGroupe">
                <div class="modal-body">
                    <h6>Groupes :</h6>
                    <select name="id_groupe" onChange="ajaxMajCheckboxGestionGroupe(value)" class="form-select" aria-label="Default select example" required>
                    <option  value=""> </option>
                        <?php foreach ($listGroupes as $key => $groupe) {?>
                            <option  value="<?= $groupe->id_groupe?>"> <?= $groupe->libelle?></option>
                        <?php  } ?>

                    </select></br>
                    
                    <?php require(ROOT.'views/services/ajaxGestionGroupe.php');?>
                    

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal pour supprimer un groupe  -->
<div class="modal fade" tabindex="-1" id="ModalDeleteGroupe" aria-labelledby="ModalDeleteGroupe" aria-hidden="true" enctype="multipart/form-data">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Supprimer un groupe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form  method="post"  action="/services/adminDeleteGroupe"  >
                <div class="modal-body">
                <select name="id_groupe" class="form-select" size="15" aria-label="size 3 select example">
                    
                    <?php foreach ($listGroupes as $key => $groupe) {?>
                        <option  value="<?= $groupe->id_groupe?>"> <?= $groupe->libelle?></option>
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