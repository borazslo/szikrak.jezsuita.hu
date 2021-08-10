<?php 

include 'sql.php';
 
error_reporting(E_ALL);
ini_set('display_errors', 1);


/* Date: Month & Day */
if(!isset($_GET['m']))
	$m = false;
elseif(intval($_GET['m']) < 1 OR  intval($_GET['m']) > 12) 
	$m = date('n');
else
	$m = intval($_GET['m']);
	
if(!isset($_GET['d']))
	$d = false;
elseif(intval($_GET['d']) < 1 OR  intval($_GET['d']) > date('t',strtotime('2000-'.$m.'-05'))) 	
	$d = date('j');
else 
	$d = intval($_GET['d']);
	
if (isset($_GET['random'])) {
		$m = rand(1,12);
		$d = rand(1, date('t',strtotime('2000-'.$m.'-05') ) );
}	
//default
if(!isset($_GET['tag']) AND !isset($_GET['random']) AND !$m) {
	$d = date('j');
	$m = date('n');
}


/* Formats */
if(isset($_GET['format']) AND in_array($_GET['format'],array('txt','format','json','html'))) 
	$format = $_GET['format'];
else
	$format = 'html';

	
/* Let's see what we have */

if(isset($_GET['tag'])) {
	// Témakör nézet
	if(!isset($tags[$_GET['tag']])) 
		die('Ilyen témakör nincs!');
	$tag = $tags[$_GET['tag']];
	switch ($format) {
		case 'txt':
			foreach($tag as $datum) {
				$d = explode('/',$datum);
				echo $szikrak[$d[0]][$d[1]]['text']." (".$szikrak[$d[0]][$d[1]]['dateHun'].")\n";
			}
			exit;        
		case 'json':
			header('Content-Type: application/json');
			$tmp = [];
			foreach($tag as $datum) {
				$d = explode('/',$datum);
				$tmp[] = $szikrak[$d[0]][$d[1]];
			}
			echo json_encode($tmp);
			exit;
		case 'image':
			die('Nincs ilyen oldal.');			
		case 'html':
			$pageTitle .= " - ".$_GET['tag'];
			$tmp = [];
			$content = '';
			foreach($tag as $datum) {
				$d = explode('/',$datum);
				$szikra = $szikrak[$d[0]][$d[1]];
				
				$content .= '<p class="dyn" id="dyn_full">'.trim($szikra['text']); 
				if (isset($szikra['comment'])) 
					$content .= "<a title=\"".strip_tags($szikra['comment'])."\">*</a>";
					
				$content .= " - <a href=\"".$url.$szikra['url']."\">".$szikra['dateHun']."</a>\n"; 
				$content .= "</p>\n";
				
				
			}
			include('html.php');
			exit;
	}		
					
} elseif($m AND $d) {	
	// Egy darab szikra nézet
	$szikra = $szikrak[$m][$d];
	
	switch ($format) {
		case 'txt':
			echo $szikra['text'];
			exit;        
		case 'json':
			header('Content-Type: application/json');
			echo json_encode($szikra);
			exit;
		case 'image':
			$url =  $url.'/image.php?d='.trim($szikra['url'],'/');	
			header('Location: '.$url);
			exit;
		case 'html':
			$pageTitle .= " - ".$szikra['dateHun'];
		
			$content = '<p class="dyn" id="dyn_full">'.$szikra['text'].'</p>';
			$content .= '<p align="right"><a href="'.$url."/".sprintf('%02d',$szikra['month']).'">'.$honapok[$szikra['month']].'</a> '.$szikra['day'].'.</p>';
			if (isset($szikra['comment']))  $content .= "<p>".$szikra['comment']."</p>";
					
			if (isset($szikra['tags'])) {
					$content .= "<p>";
					foreach($szikra['tags'] as $key=>$tag) {
						$content .= "<a href=\"".$url."/tema/".$tag."\">".$tag."</a>";
						if($key < count($szikra['tags'])-1) $content .=  ", ";
					}
					$content .= "</p>";
			}
		
			include('html.php');
			exit;
	}	
} elseif($m AND !$d) {
	// Hónap nézet
	switch ($format) {
		case 'txt':
			foreach($szikrak[$m] as $szikra) echo $szikra['text']."\n";
			exit;        
		case 'json':
			header('Content-Type: application/json');
			echo json_encode($szikrak[$m]);
			exit;
		case 'image':
			die('Nincs ilyen oldal.');			
		case 'html':		
			$pageTitle .= " - ".$honapok[$m];
			$content = '';
			foreach($szikrak[$m] as $szikra) {
				$content .= '<p class="dyn" id="dyn_full">'.trim($szikra['text']); 
				if (isset($szikra['comment'])) 
					$content .= "<a title=\"".strip_tags($szikra['comment'])."\">*</a>";
					
				$content .= " - <a href=\"".$url.$szikra['url']."\">".$szikra['dateHun']."</a>\n"; 
				$content .= "</p>\n";					
			}
			include('html.php');
			exit;
	}	
} else {
	die('Ilyen oldal sajnos nincs');
}

/* html format *
?>
	
// hónap és téma
	
	
