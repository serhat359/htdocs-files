<?php
$link = "http://mankin-trad.net/feed/";

if(file_put_contents("downloaded.xml", file_get_contents($link)))
	echo "Successful";
else
	echo "Error";

?>
