<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title><?=$_GET['user']?> - Music Search</title>
</head>
<body>
	<?php
	echo $_GET['user'] . ' musics';
	 ?>
<label id="debug"></label>
<table id="results"></table>
 <textarea class="boxsizingBorder" cols="150" rows="5" onChange="onChange(this.value)">

</textarea> 
<script type="text/javascript" src="/jquery/jquery-3.0.0.js"></script>
<script type="text/javascript">

var apikey = '57ee3318536b23ee81d6b27e36997cde';

var username = '<?=$_GET['user']; ?>';

var testurl = "http://ws.audioscrobbler.com/2.0/?method=artist.gettoptracks&artist=model&api_key=57ee3318536b23ee81d6b27e36997cde&format=json";

$(document).ready(function(){
	
});

function onChange(value){
	var data = JSON.parse(value);
	
	var array = data.tracks;
	
	$.each(array, function(i, item){
		var br = '</br>';
		
		var name = 'Name: '+item.name + br;
		
		var popularity = 'Popularity: '+ item.popularity + br;
		
		var album = 'Albüm: ' + item.album.name + br;
		
		//var imged = '<img src="' + item.image[1]["#text"] + '">';
		
		console.log(item.name);
		
		results = '<tr>' + columnize('<p>' + name + popularity + album + '</p>') +'</tr>';
		
		$('#results').append(results);
	});
}

function httpcall(url, params){
	var result;
	
	$.ajax(url,{
		data: params,
		success: function(data){ result = data; },
		error: function(data){ debugData(data); },
		async: false
	});
	
	return result;
}

function columnize(data){
	var imgtr = '<td>'+data+'<td>';
	return imgtr;
}

function debugData(data){
	var str = JSON.stringify(data);
	$('label').html(str);
	console.log(str);
}
 
</script>
</body>
</html>