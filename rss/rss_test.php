<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
>
<channel xml:base="http://localhost/">
	<title>Pokemon Feed</title>
	<link>http://localhost/</link>
	<language>en</language>
	<description>Description</description>
	
	<?php
	
	$con = mysqli_connect('localhost:3306', 'root', '', 'pokemon') or die("Error " . mysqli_error($con));

	echo mysqli_error($con);
	
	$result = mysqli_query($con, "select * from stat limit 5") or die("executing query failed");

	mysqli_close($con);
	
	while($row = mysqli_fetch_array($result)){
	?>
	<item>
		<title><?php echo $row['name']?></title>
		<link>http://bulbapedia.bulbagarden.net/wiki/<?php echo $row['name'];?>_%28Pok%C3%A9mon%29</link>
		<dc:creator>andysislands</dc:creator>
		<!--tarih-->
		<pubDate>Thu, 17 Apr 2014 04:20:40 +0200</pubDate>
		<description><![CDATA[
			<a href="">
			<img class="right" title="" src="../pokemon_dosyalar/images/<?php echo $row['id']?>MS.png" />
			</a>
			<p>The description for <?php echo $row['name'];?></p>
		]]></description>
	</item>
	<?php
	}
	?>
	
	</channel>
</rss>