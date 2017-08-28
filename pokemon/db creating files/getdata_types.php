<?php
if($file = fopen("national.htm","r"))
	echo "File successfully opened";
else
	echo "Opening file failed";

echo "<hr>";

//connect to database
$con = mysql_connect('localhost', 'root', '');
if($con)
	echo "connected to database established";
else
	echo "could not connect to database";

//choose database
mysql_select_db('pokemon',$con);

echo "<hr>";

while(!feof($file)){
	$line = fgets($file);
	$line = str_replace(chr(10), '', $line);
	$id = strip_tags($line, '<br>');
	$char = ':';
	$id = str_replace('<br>', $char, $id);
	$id = str_replace(' &middot; ', $char, $id);
	$id = str_replace('#', '', $id);
	$array = explode($char,$id);
	
	$id = intval($array[1]);
	
	echo $id.','.$array[3];
	if(array_key_exists(4, $array))
		echo ','.$array[4];
	echo ' ';
	
	//$id = substr($id,1);
	//echo $id."<br>";
	
	$query = "update stats set type1='".$array[3];
	if(array_key_exists(4, $array))
		$query .= "', type2='".$array[4];
	$query .= "' where id=".$id;
	
	// echo $query . "<br>";
	
	// yeni eklemeye gerek yok
	mysql_query($query);
}

// Fairy temizlemek için extra kod
mysql_query("update stats set type1='Normal' where type1='Fairy'");
mysql_query("update stats set type2='' where type2='Fairy'");

//close connection
if(mysql_close($con))
	echo "connection closed";
else
	echo "connection closing failed";

fclose($file);
?>