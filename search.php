<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>Youtube Better Search</title>
</head>
<body>
	<?php
	echo $_GET['user'] . ' videos';
	 ?>
<label id="debug"></label>
<table id="results"></table>
<script type="text/javascript" src="/jquery/jquery-3.0.0.js"></script>
<script type="text/javascript">

var apikey = 'AIzaSyBrbMk0ZR5638IrTlVBTra7NLYdoBjUt2o';

var username = '<?=$_GET['user']; ?>';

var testurl = "https://www.googleapis.com/youtube/v3/channels?part=contentDetails&forUsername=kurzgesagt&key=AIzaSyBrbMk0ZR5638IrTlVBTra7NLYdoBjUt2o";

$(document).ready(function(){
	var channelID = getChannelID(username);
	
	var url = "https://www.googleapis.com/youtube/v3/search?key="+apikey+"&channelId="+channelID+"&part=snippet&maxResults=50&order=viewCount"
	
	var data = httpcall(url, {});
	
	//debug(data);
	
	// set the statistics
	setStats(data);
	
	data.items = data.items.filter(function(x){ return x.statistics && x.statistics.viewCount > 20000 });
	
	// set the rating values
	setValues(data);
	
	// sort the datas
	data.items.sort((x,y) => {
		return y.ratingValue > x.ratingValue;
	});
	
	$.each(data.items, function(i, item){
		var br = '</br>';
		
		var labeled = '<a href="https://www.youtube.com/watch?v='+ item.id.videoId +'">'+item.snippet.title + '</a>' + br;
		
		var views = 'View count: '+item.statistics.viewCount + br;
		
		var score = 'Rating: '+ item.statistics.ratio + br;
		
		var extraScores = 'Like: ' + item.statistics.likeCount + ', dislike: ' + item.statistics.dislikeCount + br;
		
		var ratingValue = 'Rating Value: ' + item.ratingValue + br;
		
		var imged = '<img src="'+item.snippet.thumbnails.default.url+'">';
		
		results = '<tr>'+ columnize(imged) + columnize('<p>' + labeled + views + score + extraScores + ratingValue + '</p>') +'</tr>';
				$('#results').append(results);
	});
});

function httpcall(url, params){
	var result;
	
	$.ajax(url,{
		data: params,
		success: function(data){ result = data; },
		async: false
	});
	
	return result;
}

function getChannelID(user){
	var result;
	
	result = httpcall(
	"https://www.googleapis.com/youtube/v3/channels",
	{
		part : 'contentDetails', 
		forUsername : user,
		key: apikey
	});

	var pid = result.items[0].id;
	
	return pid;
}

function setStats(data){
	var ids = data.items.map(x => x.id.videoId).join(',');
	
	var url = "https://www.googleapis.com/youtube/v3/videos?key="+apikey+"&part=statistics&id="+ids;
	var data2 = httpcall(url, {});
	
	for(var i = 0; i < data2.items.length; i++){
		data.items[i].statistics = data2.items[i].statistics;
		
		var like = parseInt(data.items[i].statistics.likeCount);
		var dislike = parseInt(data.items[i].statistics.dislikeCount);
		var total = like + dislike;
		var ratio = like * 100 / total;
		
		data.items[i].statistics.ratio = ratio;
	}
}

function setValues(data){
	for(var i = 0; i < data.items.length; i++){
		data.items[i].ratingValue = getValue(data.items[i]);
	}
}

function columnize(data){
	var imgtr = '<td>'+data+'<td>';
	return imgtr;
}

function debug(data){
	$('label').html(JSON.stringify(data));
}

function getValue(item){
	if(item.statistics.dislikeCount == 0)
		item.statistics.dislikeCount = 1;
	
	var ratio = item.statistics.likeCount / (item.statistics.likeCount + item.statistics.dislikeCount);
	return ratio * ratio * item.statistics.viewCount;
}
	   
</script>
</body>
</html>