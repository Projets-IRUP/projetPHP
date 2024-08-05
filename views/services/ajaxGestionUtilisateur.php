<div id="listGroupe">

<?php

        //     echo "<PRE>";
        //         print_r($listGroupeService);
        //     echo "</PRE>";   
        //     echo "<PRE>";
        //     print_r($listServices);
        // echo "</PRE>"; 
if(isset($listGroupeUtilisateur) ){
    ?>
    <h6>Fait partie des groupes :</h6>
    <?php

foreach ($listGroupe as $key => $groupe) {
    if( in_array($groupe->id_groupe, $listGroupeUtilisateur)){ 

?>
        <div  class="form-check">
            <input class="form-check-input"  name="groupes[]"type="checkbox" value="<?=$groupe->id_groupe?>" id="flexCheckChecked" checked >
            <label class="form-check-label" for="flexCheckChecked"><?=strtoupper($groupe->libelle)?></label>
        </div>
        
<?php
    }else{
?>
        <div  class="form-check">
            <input class="form-check-input" name="groupes[]"type="checkbox" value="<?=$groupe->id_groupe?>" id="flexCheckChecked" >
            <label class="form-check-label" for="flexCheckChecked"><?=strtoupper($groupe->libelle)?></label>
        </div>

<?php
        }
 } }
 ?>
 </div>
