<?php
if($file = fopen("tabloHtml2.php","r"))
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

// tehlikeli olduðu için kapatýldý
// $data = mysql_query("delete from stats");

echo "<hr>";
$total = 0;

while(!feof($file)){
	$line = fgets($file);
	$line = fgets($file);
	$line = fgets($file);
	$line = fgets($file);
	$id = strip_tags($line);
	$id = substr($id,2,3);
	echo "\"".$id."\"\n";
	$total++;
	
	while(!strpos($line,"</tr>"))
	$line = fgets($file);
	
	$query = "update stats set sinnoh=1 where id=".$id;
	
	// yeni eklemeye gerek yok
	mysql_query($query);
}

//close connection
if(mysql_close($con))
	echo "connection closed";
else
	echo "connection closing failed";

echo "\ntotal: ".$total;
fclose($file);
?>