<?php
/* if($file = fopen("urlList.html","r"))
	echo "File successfully opened";
else
	echo "Opening file failed";
	
echo '<br>';

while(!feof($file)){
	$line = trim(fgets($file));
	
	$parts = explode("')\">", $line);
	echo $parts[0];
	echo " ";
	echo $parts[1];
	echo '<br>';
	
	if(file_put_contents("img/".$parts[1].".jpg", fopen($parts[0], 'r')))
		echo "Successfull";
	else
		echo "Error";
	
	echo '<br>';
}

echo "Completed"; */

echo "Ýþi bittiði için kapatýldý";

//file_put_contents("Tmpfile.zip", fopen("http://someurl/file.zip", 'r'));
?>