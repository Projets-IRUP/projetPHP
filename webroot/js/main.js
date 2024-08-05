
//Flash message
jQuery(function($){
    
    var alert = $('#alert');
    if(alert.length>0){
        alert.hide().slideDown(500).delay(10000).slideUp();
    }
});

//Preview PDF

function ChargementPreview(path){
    // alert(path);
    document.getElementById('iframePreviewPdf').src = path;
}

//SERVICES:
// Ajax pour checkbox de gestion groupe :
function ajaxMajCheckboxGestionGroupe(id_groupe){
    // alert(id_groupe);
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("listService").innerHTML = this.responseText;
    }
 
    xhttp.open("GET", "/services/ajaxSelectGroupeServiceByGroupe/" + id_groupe );
    xhttp.send();
}
// Ajax pour checkbox de gestion utilisateur :
function ajaxMajCheckboxGestionUtilisateur(id_utilisateur){

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("listGroupe").innerHTML = this.responseText;
    }
 
    xhttp.open("GET", "/services/ajaxSelectGroupeUtilisateurByUtilisateur/" + id_utilisateur );
    xhttp.send();
}



//FICHIER:
//Ajax Rechargement du tableau de fichier dû à la pagination:
function RechargementTabFichierPagination(currentPage) {
    // alert(currentPage);
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("tableauAjax").innerHTML = this.responseText;
    }
    
    xhttp.open("GET", "/fichiers/chargementTableauDeFichier/" + currentPage );
    xhttp.send();
}


//Animation js bouton menu 
function actionToggle() {
    const action = document.querySelector('.action');
    action.classList.toggle('active')
}

//Service
function OpenAddServiceModal() {
    $('#ModalAddService').modal('show');
}
function OpenDeleteServiceModal() {
    $('#ModalDeleteService').modal('show');
}

//Utilisateur
function OpenAddUserModal() {
    $('#ModalAddUser').modal('show');
}
function OpenGestionUserModal() {
    $('#ModalGestionUser').modal('show');
}


function OpenDeleteUserModal() {
    $('#ModalDeleteUser').modal('show');
}

//Groupe 
function OpenAddGroupModal() {
    $('#ModalAddGroupe').modal('show');
}
function OpenGestionGroupModal() {
    $('#ModalGestionGroupe').modal('show');
}
function OpenDeleteGroupModal() {
    $('#ModalDeleteGroupe').modal('show');
}

//Image service
function OpenImageServiceModal() {
    $('#ModalAjoutImage').modal('show');
} 


//Dossier
function OpenImageDossierModal() {
    $('#ModalAjoutImageDossier').modal('show');
}

function OpenAddDossierModal() {
    $('#ModalAddDossier').modal('show');
}

function OpenDeleteDossierModal() {
    $('#ModalDeleteDossier').modal('show');
}
//Sous-dossier
function OpenImageSousDossierModal() {
    $('#ModalAjoutImageSousDossier').modal('show');
}

function OpenAddSousDossierModal() {
    $('#ModalAddSousDossier').modal('show');
}

function OpenDeleteSousDossierModal() {
    $('#ModalDeleteSousDossier').modal('show');
}
//Fichier
function OpenAddFichierModal() {
    $('#ModalAddFichier').modal('show');
}

function OpenDeleteFichierModal() {
    $('#ModalDeleteFichier').modal('show');
}
//             class CustomSelect {
//                 constructor(originalSelect) {
//                     this.originalSelect = originalSelect;
//                     this.customSelect = document.createElement("div");
//                     this.customSelect.classList.add("select");
            
//                     this.originalSelect.querySelectorAll("option").forEach((optionElement) => {
//                         const itemElement = document.createElement("div");
            
//                         itemElement.classList.add("select__item");
//                         itemElement.textContent = optionElement.textContent;
//                         this.customSelect.appendChild(itemElement);
            
//                         if (optionElement.selected) {
//                             this._select(itemElement);
//                         }
            
//                         itemElement.addEventListener("click", () => {
//                             if (
//                                 this.originalSelect.multiple &&
//                                 itemElement.classList.contains("select__item--selected")
//                             ) {
//                                 this._deselect(itemElement);
//                             } else {
//                                 this._select(itemElement);
//                             }
//                         });
//                     });
            
//                     this.originalSelect.insertAdjacentElement("afterend", this.customSelect);
//                     this.originalSelect.style.display = "none";
//                 }
            
//                 _select(itemElement) {
//                     const index = Array.from(this.customSelect.children).indexOf(itemElement);
            
//                     if (!this.originalSelect.multiple) {
//                         this.customSelect.querySelectorAll(".select__item").forEach((el) => {
//                             el.classList.remove("select__item--selected");
//                         });
//                     }
            
//                     this.originalSelect.querySelectorAll("option")[index].selected = true;
//                     itemElement.classList.add("select__item--selected");
//                 }
            
//                 _deselect(itemElement) {
//                     const index = Array.from(this.customSelect.children).indexOf(itemElement);
            
//                     this.originalSelect.querySelectorAll("option")[index].selected = false;
//                     itemElement.classList.remove("select__item--selected");
//                 }
//             }
            
//             document.querySelectorAll(".custom-select").forEach((selectElement) => {
//                 new CustomSelect(selectElement);
//             });
//             // Vérirification formulaire 
// let formAddService = document.getElementById('formAddService')

// Si le formulaire est envoyé 
// formAddService.addEventListener('submit', function (e) {

//     // Le formulaire est bon
//     let ok = true

//     // On envoie pas le formulaire
//     e.preventDefault()

//     // On récupère les valeurs
//     let nom = document.getElementById('nomService')
//     let droit = document.getElementById('droitService')

//     // Affichage des erreurs 
//     let erreurAddService = document.getElementById('erreurAddService')

//     erreurAddService.innerHTML = ""

//     // Si le nom est vide 
//     if (nom.value.trim() == "") {
//         erreurAddService.innerHTML += "Le nom est vide ! <br>"
//         // Formulaire plus valide
//         ok = false
//     }

//     if (droit.value.length <= 0) {
//         erreurAddService.innerHTML += "Aucun droit attribué !"
//         // Formulaire plus valide
//         ok = false
//     }

//     // Si le formaulaire est ok
//     if (ok) {
//         formAddService.submit()
//     }
// });
// Vérirification formulaire 
// let formDeleteService = document.getElementById('formDeleteService')

// Si le formulaire est envoyé 
// formDeleteService.addEventListener('submit', function (e) {

//     // Le formulaire est bon
//     let ok = true

//     // On envoie pas le formulaire
//     e.preventDefault()

//     // On récupère les valeurs
//     let idService = document.getElementById('deleteIdService')

//     // Affichage des erreurs 
//     let erreurDeleteService = document.getElementById('erreurDeleteService')

//     erreurDeleteService.innerHTML = ""

//     // Si le nom est vide 
//     if (idService.value.trim() == "") {
//         erreurDeleteService.innerHTML += "Le nom est vide ! <br>"
//         // Formulaire plus valide
//         ok = false
//     }

//     // Si le formaulaire est ok

//     if (check) {
//         if (confirm('Vous êtes sur le point de supprimer des services. \n\nLa suppression de ces services sont définitives et supprimera les sous services et les fichiers liées à cette dernière. \n\nContinuer ?')) {
//             formDeleteService.submit()
//         }
//     } else {
//         alert('Veuillez selectionner au moins un service')
//     }
// });
// function getRightService(id_service, WEBROOT2 ) {
//     // alert(id_service);
//    // alert(WEBROOT2);
//     const xhttp = new XMLHttpRequest();
//     xhttp.onload = function() {
//         document.getElementById("flashid").innerHTML = this.responseText;
//     }
//     //alert( "<?php echo WEBROOT2 ?>/collaborateurs/ajaxListCollaborateurs/" + str + "/<?php echo $Id_SOCIETE.'/'.$Id_SERVICE ?>")
//     //alert("/" + WEBROOT2 + "/services/ajaxAllowToAccesOfService/" + id_service)
//     //Utiliser ? si caractère spéciaux contenu
 
//     xhttp.open("GET", "/" + WEBROOT2 + "/services/ajaxAllowToAccesOfService/" + id_service );
//     xhttp.send();
//     }