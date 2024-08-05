<div id="tableauAjax"  style = "padding: 0px; ">
<!-- Test viewer pdf et word  -->

    <!-- <iframe src="https://docs.google.com/gview?url=http%3A%2F%2Fintranet2%2Fwebroot%2Ffichiers%2F4%2F6%2F3%2Ftest%2Edoc&embedded=true"></iframe> -->
    <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http://remote.url.tld/intranet2/webroot/fichiers/1/4/1/test.docx' width='1366px' height='623px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe> --> 

        <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http%3A%2F%2Fintranet2%2Fwebroot%2Ffichiers%2F4%2F6%2F3%2Ftest%2Edoc' width='100%' height='623px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe> -->
            <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http%3A%2F%2Fieee802%2Eorg%3A80%2Fsecmail%2FdocIZSEwEqHFr%2Edoc' width='100%' height='100%' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe> -->
        <table class="table  table-class" id= "table-id" style="width: max;">
    
        <thead>
            <tr onMouseOver="this.style.cursor=''">
                <th>Nom du fichier</th>
                <th>Taille du fichier</th>
                <th>Date</th>
            </tr>
            
        </thead>
        
        <tbody>
        
            <?php 
                        // echo "<PRE>";
                        // print_r($listFichier);
                        // echo "</PRE>";        

                foreach ($listFichier as $key => $fichier) { 
                    //pour redirection target ne fonctionne pas
                   // echo' <tr onclick="location.href=\'/webroot/fichiers/'.$_SESSION['id_service'].'/'.$_SESSION['id_sousservice'].'/' .$fichier->nom.'\', target=\'_blank\';" title=\'Ouvrir le fichier\' onMouseOver="this.style.cursor=\'pointer\'">';
                        // echo' <tr onclick="window.open(\'/webroot/fichiers/'.$_SESSION['id_service'].'/'.$_SESSION['id_dossier'].'/'.$_SESSION['id_sousdossier'].'/' .$fichier->nom.'\', target=\'_blank\');" title=\'Ouvrir le fichier\' onMouseOver="this.style.cursor=\'pointer\'">';
                        echo' <tr onclick="ChargementPreview(\'/webroot/fichiers/'.$_SESSION['id_service'].'/'.$_SESSION['id_dossier'].'/'.$_SESSION['id_sousdossier'].'/' .$fichier->nom.'\');" title=\'Ouvrir le fichier\' onMouseOver="this.style.cursor=\'pointer\'">';
                            //avant les liens js balise liens a , plus utilise
                            // echo' <td><a target = "_blank" title="Ouvrir le fichier"href="/webroot/fichiers/'.$_SESSION['id_service'].'/'.$_SESSION['id_sousservice'].'/' .$fichier->nom.'">'.$fichier->nom.'</a></td>';
                            echo' <td>'.$fichier->nom.'</td>';
                            echo' <td>'.$fichier->taille.'</td>';
                            echo' <td>'.$fichier->date.'</td>';
                        echo' </tr>';
                    } 
            ?>
        </tbody>

    </table>

    <?php
    //echo $_SESSION['nbPage'];
    //echo $this->curentPage ;
    ?>
    

    <!-- Pagination -->
    <div style="position:fixed; bottom: 0; left: 0; right: 0; width:100% ; text-align:center; margin-right" >
    <nav > 
        <ul class="pagination justify-content-center">
            <li class="page-item <?= ($this->curentPage == 1) ? " disabled " : ""?>">
                <a onclick="RechargementTabFichierPagination(<?=$this->curentPage-1?>)" class="page-link"> Précedente </a>
            </li>
            <?php for($counter=1;$counter<= $_SESSION['nbPage'];$counter++):  ?>

                    <li class="page-item <?= ($this->curentPage == $counter) ? "active" : ""?>">
                        <a onclick="RechargementTabFichierPagination(<?=$counter?>)" class="page-link "> <?=$counter?> </a>
                    </li>
                    <?php  endfor ?>
            
        
            <li class="page-item <?= ($this->curentPage ==  $_SESSION['nbPage']) ? " disabled " : ""?> ">
                <a onclick="RechargementTabFichierPagination(<?=$this->curentPage+1?>)" class="page-link "> Suivante </a>
            </li>
        </ul>

    </nav>
    </div>
</div>
<!-- <iframe class="doc" id=""  style =" width: 400px; height: 700px; "src="http://intranet2/webroot/fichiers/4/6/3/F16_23-036.pdf"></iframe> -->
<!-- <iframe class="doc" id="iframePreviewPdf"  style =" width: 400px; height: 700px; "src=""></iframe> -->
<!-- Les modal sont rechargé en fonction de la page où l'on se trouve -->
<!-- Modal pour ajouter un fichier  -->
<div class="modal fade" tabindex="-1" id="ModalAddFichier" aria-labelledby="ModalAddFichier" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Ajouter un fichier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formAddFichier"  method="post"  action="/fichiers/ajoutFichier"  enctype="multipart/form-data"  >
                <div class="modal-body">

                    <div class="input-group ">
                        <!-- Entrée de fichiers à déposer -->
                        <input type="file" class="form-control" name="fichiers[]" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" required  aria-label="Upload">
                        <!-- Btn pour effacer les fichier chargé -->
                        <button class="btn btn-outline-secondary" type="button" onclick="$('#formAddFichier')[0].reset();"id="inputGroupFileAddon04">X</button>
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

<!-- Modal pour delete un fichier  -->
<div class="modal fade" tabindex="-1" id="ModalDeleteFichier"  aria-labelledby="ModalDeleteFichier" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title">Supprimer un fichier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formDeleteFichier"  method="post"  action="/fichiers/supprimerFichier/"  enctype="multipart/form-data"  >
                <div class="modal-body">
                
                    <select name="fichier" class="form-select" size="3" aria-label="size 3 select example">
                    
                    <?php foreach ($listFichier as $key => $fichier) {?>
                        <option value="<?= $fichier->nom?>"> <?= $fichier->nom ?></option>
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
