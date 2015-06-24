<?php
/**
 * @author Stephan Pieterse
 * @pacakge ApolloLMS
 * */
		$query = "SELECT * FROM modules ORDER BY id ASC";
		$r = sql_execute($query);
		
		echo '<table class="admin_view_table">';
		
		while($x = sql_get($r)){
		echo "<tr>";
		echo "<td>";
			echo $x['NAME'];
			if($x['ACTIVE'] == 0){
				echo ' (Disabled)';
			}
			br();
			echo $x['DESCRIPTION'];
		echo "</td>";
		echo "<td>";
			if($x['ACTIVE'] == 0){
				echo '<a href="modules.php?q=setStatus&mid=' . $x['ID'] . '&setto=1"> <img src="' . ICONS_PATH . "accept.png\" alt=\"Activate Module\"/></a>";
			}else{
				echo '<a href="modules.php?q=setStatus&mid=' . $x['ID'] . '&setto=0"> <img src="' . ICONS_PATH . "tick.png\" alt=\"De-activate Module\"/></a>";
		}
		$link = "<a href=\"modules.php?f=settingsView&mid=" . $x['ID'] ." \"> <img src=\"" . ICONS_PATH . "cog.png\" alt=\"Module Settings\"/></a>";
		echo $link;
		echo "</td>";
			//br();
		echo "</tr>";
		}
		
		echo "</table>";
?>
