<?
include('../config.php');

backup_tables(DB_DSN_HOST,DB_USERNAME,DB_PASSWORD,DB_DSN_DB);
backup_structure(DB_DSN_HOST,DB_USERNAME,DB_PASSWORD,DB_DSN_DB);

/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*')
{	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = sql_execute('SHOW TABLES');
		while($row = sql_getrow($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$return.= 'DROP TABLE IF EXISTS '.$table.';';
		$row2 = sql_getrow(sql_execute('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
	
		$result = sql_execute('SELECT * FROM '.$table);
		$num_fields = mysqli_num_fields($result);
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = sql_getrow($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = preg_replace("/\r\n/","\\r\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	$handle = fopen('db-backup-'.time().'-'.$name.'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}

function backup_structure($host,$user,$pass,$name,$tables = '*')
{

	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = sql_execute('SHOW TABLES');
		while($row = sql_getrow($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
		
	//cycle through
	foreach($tables as $table)
	{
		//$return.= 'DROP TABLE IF EXISTS '.$table.';';
		$row2 = sql_getrow(sql_execute('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
	
	/*
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = preg_replace("/\r\n/","\\r\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	*/
	}
	//save file
	$handle = fopen('db-structure-'.time().'-'.$name.'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}


?>