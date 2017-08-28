<!DOCTYPE HTML>
<html class="client-js" dir="ltr" lang="en"><head>
<meta http-equiv="content-type" content="text/html" charset="ISO-8859-1">
<title>List of Pokémon by base stats - Localhost</title>

<meta name="generator" content="MediaWiki 1.20.6">
<link rel="canonical" href="http://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_base_stats">
<link rel="shortcut icon" href="http://bulbapedia.bulbagarden.net/favicon.ico">
<link rel="search" type="application/opensearchdescription+xml" href="http://bulbapedia.bulbagarden.net/w/opensearch_desc.php" title="Bulbapedia (en)">
<link rel="EditURI" type="application/rsd+xml" href="http://bulbapedia.bulbagarden.net/w/api.php?action=rsd">
<link rel="copyright" href="http://creativecommons.org/licenses/by-nc-sa/2.5/">
<link rel="alternate" type="application/atom+xml" title="Deneme Feed (Do not use!)" href="/feed.php">
<link rel="stylesheet" href="pokemon_dosyalar/load_002.css">
<style>.mw-collapsible-toggle{float:right} li .mw-collapsible-toggle{float:none} .mw-collapsible-toggle-li{list-style:none}
.suggestions{overflow:hidden;position:absolute;top:0;left:0;width:0;border:none;z-index:1099;padding:0;margin:-1px -1px 0 0} html > body .suggestions{margin:-1px 0 0 0}.suggestions-special{position:relative;background-color:white;cursor:pointer;border:solid 1px #aaaaaa;padding:0;margin:0;margin-top:-2px;display:none;padding:0.25em 0.25em;line-height:1.25em}.suggestions-results{background-color:white;cursor:pointer;border:solid 1px #aaaaaa;padding:0;margin:0}.suggestions-result{color:black;margin:0;line-height:1.5em;padding:0.01em 0.25em;text-align:left}.suggestions-result-current{background-color:#4C59A6;color:white}.suggestions-special .special-label{color:gray;text-align:left}.suggestions-special .special-query{color:black;font-style:italic;text-align:left}.suggestions-special .special-hover{background-color:silver}.suggestions-result-current .special-label,.suggestions-result-current .special-query{color:white}.autoellipsis-matched,.highlight{font-weight:bold}
</style><meta name="ResourceLoaderDynamicStyles" content="">
<link rel="stylesheet" href="pokemon_dosyalar/load.css">
<style>a:lang(ar),a:lang(ckb),a:lang(fa),a:lang(kk-arab),a:lang(mzn),a:lang(ps),a:lang(ur){text-decoration:none}
/* cache key: themozz_mediawiki:resourceloader:filter:minify-css:7:2f7a3fe48d60637a1f7f1bebfb8f1993 */</style>
<!-- BEGIN TRIGGER TAG INITIALIZATION -->

<!-- END TRIGGER TAG INITIALIZATION --></head><body class="mediawiki ltr sitedir-ltr ns-0 ns-subject page-List_of_Pokémon_by_base_stats skin-monobook action-view site-bulbapedia">
<div id="globalWrapper">
<div id="column-content"><div id="content" class="mw-body-primary">
<div style="position: relative; min-height: 250px;">
<div>
	<br>
	<?php
	$subq = "select * from stat ";
	echo $subq;
	?>
	<form name="form" method="post" action="">
	<textarea name="query"><?php echo isset($_POST['query']) ? $_POST['query'] : "order by greatest(attack,spattack)*speed desc"?></textarea>
	<input type="submit" value="Execute">
	<b>Coloumn names: gen, id, name, hp, attack, defense, spattack, spdefense, speed, total, sinnoh, hoenn, type1, type2.</b>
	<form>
	<h1 id="firstHeading" class="firstHeading"><span dir="auto">List of Pokémon by base stats</span></h1>
	<div id="bodyContent" class="mw-body">
		<div id="jump-to-nav" class="mw-jump">Jump to: <a href="#column-one">navigation</a>, <a href="#searchInput">search</a></div>
		<!-- start content -->
<div id="mw-content-text" dir="ltr" class="mw-content-ltr" lang="en"><dl><dd>
</dd></dl>
<table class="sortable roundy jquery-tablesorter" style="margin: auto; background: none repeat scroll 0% 0% rgb(204, 204, 255); border: 3px solid rgb(190, 190, 209);">
<thead><tr>
<th><a href="http://bulbapedia.bulbagarden.net/wiki/National_Pok%C3%A9dex" title="National Pokédex">#</a>
</th>
<th> &nbsp;
</th>
<th> Pokémon
</th>
<th class="headerSort" style="background: rgb(255, 0, 0); -moz-border-radius-topleft: 10px; -moz-border-radius-topright: 10px;"> <small>HP</small>
</th>
<th class="headerSort" style="background: rgb(240, 128, 48); -moz-border-radius-topleft: 10px; -moz-border-radius-topright: 10px;"> <small>Attack</small>
</th>
<th class="headerSort" style="background: rgb(248, 208, 48); -moz-border-radius-topleft: 10px; -moz-border-radius-topright: 10px;"> <small>Defense</small>
</th>
<th class="headerSort" style="background: rgb(104, 144, 240); -moz-border-radius-topleft: 10px; -moz-border-radius-topright: 10px;"> <small>Sp. Attack</small>
</th>
<th class="headerSort" style="background: rgb(120, 200, 80); -moz-border-radius-topleft: 10px; -moz-border-radius-topright: 10px;"> <small>Sp. Defense</small>
</th>
<th class="headerSort" style="background: rgb(248, 88, 136); -moz-border-radius-topleft: 10px; -moz-border-radius-topright: 10px;"> <small>Speed</small>
</th>
<th class="headerSort"> <small>Total</small>
</th>
<th class="headerSort"> <small>Type</small>
</th>
</tr></thead><tbody>

<!--satır burada başlıyor----------------------------------------------------------------------------------->
<?php
//connect to database
$con = mysqli_connect('localhost:3306', 'root', '', 'pokemon') or die("Error " . mysqli_error($con));

echo mysqli_error($con);

if(isset($_POST['query']))
	$subq .= $_POST['query'];
$result = mysqli_query($con, $subq) or die("executing query failed");

mysqli_close($con);

while($row = mysqli_fetch_array($result)){
?>
<tr style="background: none repeat scroll 0% 0% rgb(255, 255, 255);" align="center">
<td align="right"> <b><?php echo $row['id'];?></b>
</td>
<td><span class="plainlinks"><a href="http://bulbapedia.bulbagarden.net/wiki/<?php echo $row['name'];?>_%28Pok%C3%A9mon%29"><img src="pokemon_dosyalar/images/<?php echo $row['id'];?>MS.png" height="32" width="32"></a></span>
</td>
<td align="left"><a href="http://bulbapedia.bulbagarden.net/wiki/<?php echo $row['name'];?>_%28Pok%C3%A9mon%29"><?php echo $row['name'];?></a></td>
<td style="background: rgb(255, 89, 89);"><?php echo $row['hp'];?></td>
<td style="background: rgb(245, 172, 120);"><?php echo $row['attack'];?></td>
<td style="background: rgb(250, 224, 120);"><?php echo $row['defense'];?></td>
<td style="background: rgb(157, 183, 245);"><?php echo $row['spattack'];?></td>
<td style="background: rgb(167, 219, 141);"><?php echo $row['spdefense'];?></td>
<td style="background: rgb(248, 88, 136);"><?php echo $row['speed'];?></td>
<td><?php echo $row['total'];?></td>
<td><img src="pokemon_dosyalar/types/<?php echo $row['type1'];?>IC.gif">
<?php if($row['type2']!=null) echo '<img src="pokemon_dosyalar/types/'.$row['type2'].'IC.gif">';?></td>
</tr>
<?php
}
?>
<!--satır burada bitiyor------------------------------------------------------------------------------------------------------->
</tbody><tfoot></tfoot></table>

</div>
</div>
</div>
</div>
</div>
</div>
</body></html>