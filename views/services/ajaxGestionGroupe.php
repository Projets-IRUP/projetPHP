<div id="listService">

<?php

        //     echo "<PRE>";
        //         print_r($listGroupeService);
        //     echo "</PRE>";   
        //     echo "<PRE>";
        //     print_r($listServices);
        // echo "</PRE>"; 
if(isset($listGroupeService) ){
    ?>
    <h6>Droits d'accès aux services :</h6>
    <?php

foreach ($listServices as $key => $service) {
    if( in_array($service->id_service, $listGroupeService)){ 

?>
        <div id="" class="form-check">
            <input class="form-check-input"  name="services[]"type="checkbox" value="<?=$service->id_service?>" id="flexCheckChecked" checked >
            <label class="form-check-label" for="flexCheckChecked"><?=strtoupper($service->libelle)?></label>
        </div>
        
<?php
    }else{
?>
        <div id="" class="form-check">
            <input class="form-check-input" name="services[]"type="checkbox" value="<?=$service->id_service?>" id="flexCheckChecked" >
            <label class="form-check-label" for="flexCheckChecked"><?=strtoupper($service->libelle)?></label>
        </div>

<?php
        }
 } }
 ?>
 </div>
