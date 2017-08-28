<?php
if($file = fopen("tabloHtml.php","r"))
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

// tehlikeli olduðu için kapatýlmalý
$data = mysql_query("delete from stats");

echo "<hr>";

while(!feof($file)){
	$line = fgets($file);
	$line = fgets($file);
	$id = strip_tags($line);
	$id = substr($id,1);
	
	$line = fgets($file);
	$line = fgets($file);
	$line = fgets($file);
	$line = fgets($file);
	$name = strip_tags($line);
	// Harf ve rakam dýþýnda herþeyi temizleme kodu
	//$name = preg_replace("/[^A-Za-z0-9()]/", '', $name);
	// Harf dýþýnda herþeyi temizleme kodu
	// $name = preg_replace("/[^A-Za-z]/", '', $name);
	
	
	$line = fgets($file);
	$line = fgets($file);
	$hp = strip_tags($line);
	
	$line = fgets($file);
	$line = fgets($file);
	$atk = strip_tags($line);
	
	$line = fgets($file);
	$line = fgets($file);
	$def = strip_tags($line);
	
	$line = fgets($file);
	$line = fgets($file);
	$spatk = strip_tags($line);
	
	$line = fgets($file);
	$line = fgets($file);
	$spdef = strip_tags($line);
	
	$line = fgets($file);
	$line = fgets($file);
	$spd = strip_tags($line);
	
	$line = fgets($file);
	$line = fgets($file);
	$total = strip_tags($line);
	
	$line = fgets($file);
	$line = fgets($file);
	$line = fgets($file);
	
	//echo $name.",";
	//echo "id: ".$id." name: ".$name." atk: ".$atk." def: ".$def." spatk: ".$spatk." spdef: ".$spdef." speed: ".$spd." total: ".$total."<hr>";
	if($id<=151)
		$gen = 1;
	elseif($id<=251)
		$gen = 2;
	elseif($id<=386)
		$gen = 3;
	elseif($id<=493)
		$gen = 4;
	elseif($id<=649)
		$gen = 5;
	
	$query = "INSERT INTO stats (`gen`, `id`, `name`, `hp`, `attack`, `defense`, `spattack`, `spdefense`, `speed`, `total`) VALUES ('".$gen."', '".$id."', '".$name."', '".$hp."', '".$atk."', '".$def."', '".$spatk."', '".$spdef."', '".$spd."', '".$total."')";
	
	// yeni eklemeye gerek yok
	mysql_query($query);
	// echo $query.'<br>';
}

//close connection
if(mysql_close($con))
	echo "connection closed";
else
	echo "connection closing failed";

include("getdata_hoenn.php");
include("getdata_sinnoh.php");
include("getdata_types.php");

fclose($file);
?>