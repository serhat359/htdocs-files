
<?php
	$start = 1869;
	
	$max = 1868;
	
	if($max > $start)
		echo '<span> fetching ' . ($max - $start + 1) . ' elements... </span>';
	else
		echo 'You mixed the numbers again... Reverse them and try again.';
	
	for($i = $start; $i <= $max; $i++){
		$url = 'http://xkcd.com/'.$i;
		
		$homepage = file_get_contents($url);
		
		$dom = new DOMDocument;
		$dom->loadHTML($homepage);
		$comic = $dom->getElementById('comic')->getElementsByTagName('img')->item(0);
		
		$img = $comic->getAttribute('src');
		
		$img = 'http://' . str_replace('//','',$img);
		
		file_put_contents('images/' . $i . '.jpg', fopen($img, 'r'));
		
		echo 'success! (' . $i . ')';
	}
?>