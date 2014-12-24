<form method="post" action="index.php?aq=mod_test_prerequisites&tid=<?php echo $_GET['tid']; ?>">

<input type="checkbox" name="belongto_course" />Belong to a course:
<select name="belongto_coursename">
<?php
	$q = "SELECT * FROM courses WHERE published_status='1'";
	$r = sql_execute($q);
	while($d = sql_get($r)){
			echo '<option>';
			echo $d['ID'] . '-' . $d['NAME'];
			echo '</option>';
		}
?>
</select>
<br/>
<input type="checkbox" name="belongto_test" />Completed a previous test:
<select name="belongto_testname">
<?php
	$q = "SELECT * FROM tests";
	$r = sql_execute($q);
	while($d = sql_get($r)){
			echo '<option>';
			echo $d['ID'] . '-' . $d['NAME'];
			echo '</option>';
		}
?>
</select>
Minimum score:
<select name="belongto_testminimumscore">
<option>95+</option>
<option>90+</option>
<option>85+</option>
<option>80+</option>
<option>75+</option>
<option>70+</option>
<option>65+</option>
<option>60+</option>
<option>55+</option>
<option>50+</option>
<option>45+</option>
<option>40+</option>
<option>35+</option>
<option>30+</option>
<option>25+</option>
<option>20+</option>
<option>15+</option>
<option>10+</option>
<option>05+</option>
<option>00+</option>

</select>

<br/>
<input type="submit" value="Submit" />
</form>