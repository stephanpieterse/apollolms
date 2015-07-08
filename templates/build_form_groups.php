<?php
$curgid = $_GET['gid'];
$q = "SELECT * FROM groupslist WHERE id='" . $curgid . "' LIMIT 1";
$r = sql_execute($q);
$d = sql_get($r);

	    $oldPermissions = $d['PARENTS'];

	    echo '<div class="permissions_area_box fancyPress" name="groupsArea">';
	    echo "Groups:";
	    $query = "SELECT * FROM groupslist";
	    $result = sql_execute($query);
	    while($row = sql_get($result)){
     	    if($curgid !=  $row['ID']){     
	    	    $link = '<input id="group-' . $row['ID'] .'" type="checkbox" name="add-group-' . $row['ID'] . '-' . $row['NAME'] .'" ';
	    	    if(xmlHasSpecifiedNode($oldPermissions,array('tagname'=>'group','id'=>$row['ID']))){
	    	    	    	    $link .= ' checked="checked" ';
                    }            
	    	    	    $link .= ' />'; 
	    	    	    echo $link;
	    	    echo '<label for="group-' . $row['ID'] .'">' . $row['NAME'] .'</label>';
	    	    echo '</div>'; 
                }
                }
}

?>                
