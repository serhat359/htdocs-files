<html>
<head>
<script>
function convert(date){
	var regex = "[A-Za-z]+, [0-9]+ [A-Za-z]+ [0-9]+ [0-9]+:[0-9]+:[0-9]+ [+-][0-9]+";
	var pat = new RegExp(regex);
	if(pat.test(date)){
		var toks = date.split(" ");
		var toks2 = toks[4].split(":");
		var numDate = 0;
		
		// set the minute
		numDate |= parseInt(toks2[1]);
		
		// get the hour
		var hour = parseInt(toks2[0]);
		
		// adjust the hour
		var tempInt = parseInt(toks[5]) / 100;
		hour -= tempInt;
		
		// get the day
		var day = parseInt(toks[1]);
		if(hour < 0){
			hour += 24;
			day--;
		}
		else if(hour > 24){
			hour -= 24;
			day++;
		}
		
		// get the month
		var month;
		toks[2] = toks[2].toLowerCase();
		switch(toks[2]){
			case "jan": month = 1; break;
			case "feb": month = 2; break; 
			case "mar": month = 3; break; 
			case "apr": month = 4; break; 
			case "may": month = 5; break; 
			case "jun": month = 6; break; 
			case "jul": month = 7; break; 
			case "aug": month = 8; break; 
			case "sep": month = 9; break; 
			case "oct": month = 10; break; 
			case "nov": month = 11; break; 
			case "dec": month = 12; break; 
			default: return 0;
		}
		
		if(day < 0){
			day += 32;
			month--;
		}
		
		// get the year
		var year = parseInt(toks[3]) - 1970;
		if(month < 0){
			month += 12;
			year--;
		}
		
		numDate |= year << 20;
		numDate |= month << 16;
		numDate |= day << 11;
		numDate |= hour << 6;
		
		return numDate;
	}
	else
		return 0;
}

function init(){
	var date = "Tue, 07 Oct 2014 14:16:27 +0000";
	titleLink.innerHTML = convert(date);
	text2.innerHTML = date;
}
</script>
</head>
<body onload='init()'>
	hey, we've got work to do
	<br />
	<br />
	<a id="titleLink"></a>
	<a id="text"></a>
	<a id="text2"></a>
	<br />
	<?php
		$link = mysqli_connect('localhost', 'root', '', 'pokemon'); 
	
		echo 'test';
		
		$query = "SELECT name FROM stat";
		
		$result = $link->query($query) or die("Error in the consult.." . mysqli_error($link));
		
		while($row = mysqli_fetch_array($result)) {
			echo $row["name"] . ',';
		} 
	?>
</body>
</html>