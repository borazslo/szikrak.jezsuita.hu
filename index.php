<?php 

 include 'sql.php';
 
 print_r($szikrak);
 
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*

if (isset($_GET['p']) )  {
	$p = $_GET['p'];
} else {
	$p = '';
}
if (isset($_GET['m']) )  {
	$m = $_GET['m'];
} else {
	$m = '';
}
if (isset($_GET['d']) )  {
	$d = $_GET['d'];
} else {
	$d = '';
}

//print_R($_GET);

include_once ('functions.php');
		
if($p == "rss") {
	
	require_once("rss/RSSFeed.class");
	$myfeed = new RSSFeed();
	$myfeed->SetChannel('http://feeds.feedburner.com/ignaci_szikrak',
	          'Ignáci Szikrák',
	          'Aki erre nem sajnálja a fáradságot, az a Szikrákat olvasva megismerheti Loyolai Ignácot, a róla alkotott sablonos elképzelések közül kilépő, az isteni és emberi dolgokban egyaránt nagyszerűen tájékozódó koraújkori szentet. És megismerheti egy "normális" lelkiség alapköveit is, amelyben az izzó istenszeretet jó megfér a világban való tájékozódás képességével... A legismertebb ignáci jelmondat (...Mindent Isten nagyobb dicsőségére!) így kaphat új tartalmat, és így segíthet abban, hogy töredezett világunkra új szemmel tekintsünk. (Lukács János SJ tartományfőnök előszava nyomán)',
	          'hu',
	          'JTMR',
	          'EL',
	          'spirituality');
//	$myfeed->SetImage('http://www.mysite.com/mylogo.jpg');

	$szikra = getszikra();
	
	#$text = '<p class="dyn" id="dyn_full">'.$szikra['szikra'].'</p>';
	$text = '<div class="content"><p class="dyn" id="dyn_full">'.$szikra['szikra'].'</p></div>';
			if ($szikra['megj']!='' AND (isset($_REQUEST['note']) AND $_REQUEST['note'] != 'false') )
				$text .= '<div class="note"><p><i>'.$szikra['megj'].'</i></p></div>';
			if ($szikra['tags']!='' AND (isset($_REQUEST['tags']) AND $_REQUEST['tags'] != 'false')) {
					$text .= '<div class="tags"><p>';
					foreach($szikra['tags'] as $key=>$tag) {
						$text .= "<a href=\"".$base_url."tema/".$tag."\">#".$tag."</a>";
						if($key < count($szikra['tags'])-1) $text .= ", ";
					}
					$text .= "</div></p>";
				}
	$text = htmlspecialchars($text);
	//if($_GET['test']!='true') $text = $szikra['szikra'];
	$myfeed->SetItem(
			$base_url.$szikra['m']."/".$szikra['d'],
	        'Ignáci Szikrák '.$szikra['date2'],
	        $text,
			date("Y-m-d",mktime(0, 0, 0, $szikra['date']{5}.$szikra['date']{6}, $szikra['date']{8}.$szikra['date']{9}, date("Y"))).'T01:00:00+02:00',
			date('Y')."-".$szikra['m']."-".$szikra['d']
	);

	header('Content-type: application/rss+xml');
	echo $myfeed->output();
}



elseif($p == 'txt') {
	$szikra = getszikra($m,$d);
	echo $szikra['szikra'];
}
else {
	$szikra = getszikra($m,$d);
	
	$startDate = '1878-01-01';	$endDate = '2547-12-31';
	$randm = date("m",strtotime("$startDate + ".rand(0,round((strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24)))." days"));
	$randd = date("d",strtotime("$startDate + ".rand(0,round((strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24)))." days"));
	
	if($p == '404') $szikra = array('szikra'=>'Ilyen oldal sajnos nincs. :(');
	elseif($p == 'HH/NN') $szikra = array('szikra'=>'/HH/NN oldal nincs, ez csak egy sablon akar lenni, hogy a hónap két számjeggyel és a nap két számjegyel. Például  <a href="'.$base_url.$randm.'/'.$randd.'">/'.$randm.'/'.$randd.'</a>, de más is lehetne!');
	elseif($p == 'veletlen') $szikra = getszikra($randm,$randd);
	//elseif($p == 'ho') { print_R($_GET); print_R($szikra); exit; }
?>
	


<!DOCTYPE html> 
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, target-densitydpi=160, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="format-detection" content="telephone=no, email=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	
	<?php
	if($p != 'ho' and $p != 'tema') {
#print_r($szikra);



 

		echo '	<meta property="fb:app_id"        content="133165076817014" />'."\n";
		echo '	<meta property="og:type" content="article" />'."\n";
		echo '	<meta property="og:url"        content="'.$szikra['url'].'" />'."\n";
		echo '	<meta property="og:title"        content="Ignáci Szikra - '.$szikra['date4'].'" />'."\n";
		echo '	<meta property="og:description"        content="'.$szikra['szikra'].'" />'."\n";
		echo '	<meta property="og:image" content="http://szikrak.jezsuita.hu/image.php?d='.preg_replace('/-/','/',$szikra['date3']).'" />'."\n";

	}
	?>


	http://szikrak.jezsuita.hu/image.php?d=03/06

	<title>Ignáci szikrák<?php if($p == 'ho') echo ": ".$honapok[$m];
			  elseif($p == 'tema' AND isset($_GET['tag'])) echo ": ".$_GET['tag']; 
			  elseif($p == 'tema') echo ": témák"; ?> 
		</title> 
	<meta name="description" content="">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
	<link rel="stylesheet" href="<?php echo $base_url; ?>style.css" />

	<script type="text/javascript">
	
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-10397001-12']);
	  _gaq.push(['_setDomainName', 'szikrak.jezsuita.hu']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
</head> 
<body> 

<!-- Start of first page: #home -->
<div data-role="page" id="home" data-theme="a">

	<div data-role="none" id="home_header">
		<a id="home_help" href="#help" title="Súgó"><span>Súgó</span></a>
		<h1>Ignáci szikrák<?php if($p == 'ho') echo ": ".$honapok[$m];
			  elseif($p == 'tema' AND isset($_GET['tag'])) echo ": ".$_GET['tag']; 
			  elseif($p == 'tema') echo ": témák"; ?> 
		</h1>
	</div><!-- /header -->

	<div data-role="none" >	
		<div id="full_prayer">
			<p></p>
			<?php if($p != 'ho' and $p != 'tema'): ?> 
				<p class="dyn" id="dyn_full"><?php echo $szikra['szikra']; ?></p>
				<p align="right"><?php echo "<a href=\"".$base_url.$szikra['m']."\">".$honapok[$szikra['m']]."</a> ".$szikra['d']."."; ?></p>
				<?php if ($szikra['megj']!=''): ?><p><?php echo $szikra['megj']; ?></p><? endif; ?>
				<?php if ($szikra['tags']!=''): ?><p><?php 
						foreach($szikra['tags'] as $key=>$tag) {
							echo "<a href=\"".$base_url."tema/".$tag."\">".$tag."</a>";
							if($key < count($szikra['tags'])-1) echo ", ";
						}
						?></p><? endif; ?>
			<? elseif($p == 'tema' AND !isset($_REQUEST['tag'])): ?>
				<? 
				$query="SELECT tags FROM szikrak WHERE tags <> '' ";
				$result = mysql_query($query);
				$tags = array();
				while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
					$tmp = explode(',',$row[0]);
					foreach($tmp as $t) {
						if(!in_array(trim($t),$tags)) { $tags[] = trim($t); $tagscount[trim($t)] = 1;}
						else $tagscount[trim($t)] ++;
					}
				}
				asort($tags);
				foreach($tags as $tag) {
					echo '<p class="dyn" id="dyn_full"><a href="'.$base_url.'tema/'.$tag.'">'.$tag.'</a> ('.$tagscount[$tag].')</p>';
				}
				
				?>			
			<? else: ?>
				<? $szikrak = $szikra; foreach($szikrak as $szikra) { ?>
					<p class="dyn" id="dyn_full"><?php echo trim($szikra['szikra']); 
					?><?php if ($szikra['megj']!=''): ?><?php echo "<a title=\"".strip_tags($szikra['megj'])."\">*</a>"; ?><? endif; ?>
					<?php echo "- <a href=\"".$base_url.$szikra['m']."/".$szikra['d']."\">".$honapok[$szikra['m']]." ".$szikra['d'].".</a>"; ?></p>
					
				<? } ?>
			<? endif; ?>
		</div>
	</div><!-- /content -->
</div><!-- /page home -->

<div data-role="page" id="help" data-theme="a">
	<div data-role="header" data-position="fixed">
		<h1>Súgó</h1><a href="#home" data-direction="reverse" data-role="button" data-theme="b">Vissza</a>
	</div><!-- /header -->

	<div data-role="content">
		<p>Loyolai Szent Ignác válogatott gondolatai az év minden napjára.</p>
	
		<div data-role="collapsible-set">
			<div data-role="collapsible" data-iconpos="right">
				<h3>Háromszáz éves mű</h3>
				<p>Loyolai Szent Ignácnak, a jezsuita rend alapítójának, jellegzetes, frappáns tömörséggel megfogalmazott mondásainak gyűjteménye először 1705-ben jelent meg Hevenesi Gábor magyar jezsuita összeállításában. Az évszázadok során egyre újabb kiadásokat ért meg szinte változatlan formában. Különböző korok jezsuitái minden bizonnyal úgy érezték, hogy a gyűjtemény hűségesen adja vissza Ignácot.</p>
			</div>
			<div data-role="collapsible" data-iconpos="right">
				<h3>Ha meg akarod venni</h3>
				<p>A könyvet „Ignáci szikrák” címmel 2009-ben Kecskeméten adta ki a Korda Kiadó</p>
				<p><a href="http://www.kordakonyv.hu">kordakonyv.hu</a>
			</div>
			<div data-role="collapsible" data-iconpos="right">
				<h3>Másutt is az interneten</h3>
				<p><a href="https://www.facebook.com/ignaciszikrak" title="Hol másutt?">Facebookon</a></p>
				<p><a href="http://feedburner.google.com/fb/a/mailverify?uri=ignaci_szikrak" title="Add meg a címedet, és megkapod minden nap emailben.">Emailben</a></p>
				<p><a href="http://feeds.feedburner.com/ignaci_szikrak" title="Iratkozz fel, és kedvenc RSS olvasódban követheted a szikrákat.">RSS-ben</a></p>
				<p><a href="http://twitter.com/ignaciszikrak" title="Napi egy tweet igazán nem sok.">Twitteren</a></p>
			</div>
			<div data-role="collapsible" data-iconpos="right">
				<h3>A honlap titkai</h3>
				<p>Valamennyi szikrát megkeresheted a <? echo $base_url ?>HH/NN formátummal. Például: <a href="<? echo $base_url.$randm.'/'.$randd; ?>"><? echo $base_url.$randm.'/'.$randd; ?></a></p>
				<p>Egy-egy hónap összes szikráját is lekérheted. Például: <a href="<? echo $base_url.$randm ?>"><? echo $base_url.$randm; ?></a></p>
				<p>Egy témához kapcsolódó minden mondás szintén elérhető. Például: <a href="<? echo $base_url ?>tema/választás"><? echo $base_url; ?>tema/választás</a></p>
				<p>Választhatsz véletlen szikrát is a <a href="<? echo $base_url; ?>veletlen"><? echo $base_url; ?>veletlen</a> oldalon.
				<p>Egész nyers szöveget kapsz, ha az url végére teszed, hogy „txt”. Például: <? echo $base_url.$randm.'/'.$randd; ?>/txt</p>
			</div>
		</div>
		<div align="center"><a href="http://jezsuita.hu"><img src="<? echo $base_url; ?>logo.png" alt="Jezsuiták" title="Készült a Jézus Társasása Magyarországi Rendtartománya támogatásával"></a></div>
	</div>
	
</div><!-- /page help -->

</body>
</html>
<?php }


function curlRedir($url)
{
    $go = curl_init($url);
    curl_setopt ($go, CURLOPT_URL, $url);

    static $curl_loops = 0;
    static $curl_max_loops = 20;

    if ($curl_loops++>= $curl_max_loops)
    {
        $curl_loops = 0;
        return FALSE;
    }

	$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

curl_setopt($go, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($go, CURLOPT_VERBOSE, true);
curl_setopt($go, CURLOPT_RETURNTRANSFER, true);
curl_setopt($go, CURLOPT_USERAGENT, $agent);
    curl_setopt($go, CURLOPT_HEADER, true);
    curl_setopt($go, CURLOPT_RETURNTRANSFER, true);

    $data = curl_exec($go);
    $pattern = '/self\.location\.href=\'(.+)\';/';
    preg_match($pattern, $data, $matches);
    curl_close($go);
    return $data;
	return $matches[1];
}
*/
 ?>
