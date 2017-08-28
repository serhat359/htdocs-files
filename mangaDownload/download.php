<?php
	function get_inner_html( $node ) {
		$innerHTML= '';
		$children = $node->childNodes;
		foreach ($children as $child) {
			$innerHTML .= $child->ownerDocument->saveXML( $child );
		}

		return $innerHTML;
	}
	
	function intToTwoChar($num){
		return sprintf('%02d', $num);
	}
	
	function str_replace_first($from, $to, $subject)
	{
		$from = '/'.preg_quote($from, '/').'/';

		return preg_replace($from, $to, $subject, 1);
	}
	
	function get_next_url($imgUrl){
		$lastUnderScorePos = strrpos($imgUrl, '_');
		$lastDotPos = strrpos($imgUrl, '.');
		$substr = substr($imgUrl, $lastUnderScorePos + 1, $lastDotPos - $lastUnderScorePos - 1);
		$num = intval($substr);
		$newnum = $num + 1;
		$newSubStr = intToTwoChar($newnum);
		$newUrl = str_replace($substr.'.jpg', $newSubStr.'.jpg', $imgUrl);
		return $newUrl;
	}
	
	function put_contents_or_die($filename, $stream){
		$content = file_put_contents($filename, $stream);
		
		if($content === FALSE || $content === 0){
			throw new Exception("The field is undefined.");
		}
	}
	
	error_reporting(E_ERROR);
	
	$folderName = "levi8.7"; $url = 'http://www.mangainn.net/manga/chapter/154950_attack-on-titan-the-birth-of-levi-chapter';

	$pageHtml = file_get_contents($url);
	
	$dom = new DOMDocument;
	libxml_use_internal_errors(true);
	$dom->loadHTML($pageHtml);
	
	$bElement = $dom->getElementById('combopages')->getElementsByTagName('b')->item(0);
	$pageCount = intval(get_inner_html($bElement));
	
	$image = $dom->getElementById('imgPage'); // <img>
	$firstImgUrl = $image->getAttribute('src');
	
	$intBase = intToTwoChar(1) . '_';
	
	$baseImgUrl = str_replace_first($intBase, "___", $firstImgUrl);
	
	ini_set('max_execution_time', 300); //300 seconds = 5 minutes
	
	/// loop
	for($i = 1; $i <= $pageCount; $i++){
		
		$imgUrl = str_replace_first("___", intToTwoChar($i) . '_', $baseImgUrl);
		
		echo $i . '<br/>';
		
		echo $imgUrl . '<br/>';
		
		try {
			put_contents_or_die($folderName . '/' . $i . '.jpg', file_get_contents($imgUrl) );
		}
		catch (Exception $e) {
			$newUrl = get_next_url($imgUrl);
			
			try{
				put_contents_or_die($folderName . '/' . $i . '.jpg', file_get_contents($newUrl) );
			}
			catch (Exception $e) {
				$newnewUrl = get_next_url($newUrl);
				
				try{
					put_contents_or_die($folderName . '/' . $i . '.jpg', file_get_contents($newnewUrl) );
				}
				catch (Exception $e) {
					$newnewnewUrl = get_next_url($newnewUrl);
					
					try{
						put_contents_or_die($folderName . '/' . $i . '.jpg', file_get_contents($newnewnewUrl) );
					}
					catch (Exception $e) {
						echo 'Caught exception: ',  $e->getMessage(), "\n";
						break;
					}
				}
			}
		}
	}
?>