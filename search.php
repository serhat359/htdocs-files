<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	        "http://www.w3.org/TR/html4/loose.dtd">
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

// my version

var uname = '<?=$_GET['user']; ?>';

function getChannelID(user, callback){
	var result;
	
	$.get(
   "https://www.googleapis.com/youtube/v3/channels",{
	part : 'contentDetails', 
	forUsername : user,
	key: apikey
   },
   function(data) {
		
          pid = data.items[0].id;
          result = pid;
		  callback(result);
      
  }
);
}

getChannelID(uname, function(id){
	
$.get(
   "https://www.googleapis.com/youtube/v3/search?key="+apikey+"&channelId="+id+"&part=snippet&maxResults=50&order=rating",
	{
		
	},
   function(data) {
	   
	   function getValue(item){
		   if(item.statistics.dislikeCount == 0)
			   item.statistics.dislikeCount = 1;
		   
		   var ratio = item.statistics.likeCount / (item.statistics.likeCount + item.statistics.dislikeCount);
		   return ratio * ratio * item.statistics.viewCount;
	   }
	   
	   // set the statistics
	   
	   setStats(data);
	   
	   data.items = data.items.filter(function(x){ return x.statistics.viewCount > 20000 });
	   
	  // sort the datas
	  
	  data.items.sort( (x,y) => {
		  return getValue(y) > getValue(x);
	  } );
	   
      $.each( data.items, function( i, item ) {
          
		  var labeled = '<p><a href="https://www.youtube.com/watch?v='+ item.id.videoId +'">'+item.snippet.title +'</a></p>';
		  
		  var views = '<p> View count: '+item.statistics.viewCount + ' ' +'</p>';
		  
		  var score = '<p> Score: '+ item.statistics.ratio + ' ' +'</p>';
		  
		  var extraScores = '<p> Like: ' + item.statistics.likeCount + ' , dislike: ' + item.statistics.dislikeCount +'</p>';
		  
		  var imged = '<img src="'+item.snippet.thumbnails.default.url+'">';
		  
		  results = '<tr>'+ columnize(imged) + columnize(labeled + views + score + extraScores) +'</tr>';
                $('#results').append(results);
      });
  }
);
});

function setStats(data){
	var ids = data.items.map(x => x.id.videoId).join(',');
	
	console.log(ids);
	
	$.ajax({
		url:"https://www.googleapis.com/youtube/v3/videos?key="+apikey+"&part=statistics&id="+ids,
		success:function (data2){ 
			for(var i = 0; i < data2.items.length; i++){
				data.items[i].statistics = data2.items[i].statistics;
				
				var like = parseInt(data.items[i].statistics.likeCount);
				var dislike = parseInt(data.items[i].statistics.dislikeCount);
				var total = like + dislike;
				var ratio = like * 100 / total;
				
				data.items[i].statistics.ratio = ratio;
			}
		},
		async:false
	});
}

function columnize(data){
	var imgtr = '<td>'+data+'<td>';
	return imgtr;
}

function debug(data){
	$('label').html(JSON.stringify(data));
}
	 </script>
	</body>
	</html>