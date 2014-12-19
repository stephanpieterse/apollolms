<?php
/**
 * @package ApolloLMS
 * */

	if(isset($_GET['id'])){
		$cid = $_GET['id'];
		$q = 'SELECT * FROM courses WHERE id="' . $_GET['id'] . '"';
		$result = sql_execute($q);
		$data = sql_get($result);

		$avBetDates = explode('%',$data['AVAIL_DURING']);
		$avFor = explode('-',$data['AVAIL_FOR']);

		if(!isset($avFor[0])){$avFor[0] = 0;}
		if(!isset($avFor[1])){$avFor[1] = 0;}
		if(!isset($avFor[2])){$avFor[2] = 0;}

		$avBetSince = explode('-',$avBetDates[0]);
		$avBetTill = isset($avBetDates[1]) ? explode('-',$avBetDates[1]) : null;
		
		if(!isset($avBetSince[0])){$avBetSince[0] = 0;}
		if(!isset($avBetSince[1])){$avBetSince[1] = 0;}
		if(!isset($avBetSince[2])){$avBetSince[2] = 0;}
		
		if(!isset($avBetTill[0])){$avBetTill[0] = 0;}
		if(!isset($avBetTill[1])){$avBetTill[1] = 0;}
		if(!isset($avBetTill[2])){$avBetTill[2] = 0;}
	}
?>
<?php
echo tooltip('Creating and editing courses','Courses:Creating');
if(isset($cid)){
echo '<form method="POST" action="courses.php?pq=updateCourse">';
echo '<input type="hidden" name="id" value="'.$cid.'"';
}else{
echo '<form method="POST" action="courses.php?pq=addCourse">';
}
?>
<div style="border:1px solid; padding: 5px;">
	<h1>BASIC</h1>
<table class="admin_view_table">
<tr>
<td>Course name:</td>
<td><input style="width:250px;" type="text" name="courseName" value="<?php
	if(isset($cid)){echo $data['NAME'];}
?>" /></br>
</td></tr><tr>
<td>Description:</td><td><textarea type="text" name="courseDescription"><?php if(isset($cid)){echo $data['DESCRIPTION'];} ?></textarea></br></td>
</tr><tr>
<td>Code:</td><td><input style="width:150px;" type="text" name="courseCode" value="<?php if(isset($cid)){echo $data['CODE'];} ?>" /></br></td>
</tr><tr>
<td>Auto-Join:</td><td><input type="checkbox" name="autojoin" <?php if(isset($cid) && $data['AUTOJOIN'] == 1){ echo 'checked'; }?>/></br>NOTE:
Auto-Join only works for free courses (Price at R0)</td>
</tr><tr>
<td>Published:</td>
<td>
<select name="publishedStatus">
<option>Yes</option>
<option>No</option>
</select>
</td></tr><tr>
<td>Cost: R</td><td><input style="width:50px;" type="text" name="price" value="<?php if(isset($cid)){echo $data['PRICE'];}else{echo '0';} ?>" /></br></td>
</tr><tr>
<td>Par Time (Hours):</td><td><input style="width:50px;" type="text" name="partime" value="<?php if(isset($cid)){echo $data['PAR_HOURS'];}else{echo '0';} ?>" /></br></td>
</tr><tr>
<td>Tags: (seperated by ;)</td><td><textarea style="width:100%;" type="text" name="tags"><?php if(isset($cid)){echo $data['TAGS'];} ?></textarea></br></td>
</tr><tr><td>
	Available during:
</td>
<td>
	From:
	DD <input class="shortinput" name="open_since_d" type="text" value="<?php if(isset($cid)){echo $avBetSince[0];}else{echo '01';} ?>" />
	MM <input class="shortinput" name="open_since_m" type="text" value="<?php if(isset($cid)){echo $avBetSince[1];}else{echo '01';} ?>" />
	YYYY <input class="shortinput" name="open_since_y" type="text" value="<?php if(isset($cid)){echo $avBetSince[2];}else{echo '1980';} ?>" />
	<br/>
	To: 
	DD <input class="shortinput" name="open_till_d" type="text" value="<?php if(isset($cid)){echo $avBetTill[0];}else{echo '01';} ?>" />
	MM <input class="shortinput" name="open_till_m" type="text" value="<?php if(isset($cid)){echo $avBetTill[1];}else{echo '01';} ?>" />
	YYYY <input class="shortinput" name="open_till_y" type="text" value="<?php if(isset($cid)){echo $avBetTill[2];}else{echo '2100';} ?>" />
	<br/>
</td></tr><tr><td>
	Available for duration:
</td><td>
    D <input class="shortinput" name="open_for_d" type="text" value="<?php if(isset($cid)){echo $avFor[0];}else{echo '0';} ?>" />
    M <input class="shortinput" name="open_for_m" type="text" value="<?php if(isset($cid)){echo $avFor[1];}else{echo '0';} ?>" />
    Y <input class="shortinput" name="open_for_y" type="text" value="<?php if(isset($cid)){echo $avFor[2];}else{echo '0';} ?>" />
    <br/>
</td></tr>
</table>
</div>
<br />
<h1>INTRO PAGE</h1>
<textarea style="width:80%;" id="courseIntroContent" name="courseIntroContent"><?php if(isset($cid)){echo $data['HTML_CONTENT'];} ?></textarea>
<br />
<div class="thinBorder"><h1>Permissions</h1>
<?php
	if(isset($cid)){
		buildPermissionsForm($data['PERMISSIONS']);
	}else{
		buildPermissionsForm();
	}
?>
</div>
<p><input type="submit" value="Submit" /></p>
</form>
<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<script>
    window.onload = function() {
        CKEDITOR.replace( 'courseIntroContent' );
        CKEDITOR.replace( 'courseDescription' );
		CKEDITOR.config();
    };
</script>
