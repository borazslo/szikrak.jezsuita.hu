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
		
		
		<meta property="fb:app_id" content="133165076817014" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="'.$szikra['url'].'" />
		<meta property="og:title" content="<?php echo $pageTitle; ?>" />
		<meta property="og:description" content="'.$szikra['szikra'].'" />
		<meta property="og:image" content="http://szikrak.jezsuita.hu/image.php?d='.preg_replace('/-/','/',$szikra['date3']).'" />

		<title><?php echo $pageTitle; ?></title> 
		<meta name="description" content="">
		
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
		<link rel="stylesheet" href="<?php echo $url; ?>/style.css" />

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
			<h1><?php echo $pageTitle; ?></h1>
		</div><!-- /header -->

		<div data-role="none" >	
			<div id="full_prayer">
				<p></p>
				<?php 
				
					 echo $content 
								 
				 ?>
					
				<!--<php elseif($p == 'tema' AND !isset($_REQUEST['tag'])): ?>
					< php
					
					foreach($tags as $tag) {
						echo '<p class="dyn" id="dyn_full"><a href="'.$base_url.'tema/'.$tag.'">'.$tag.'</a> ('.$tagscount[$tag].')</p>';
					}
					
					?>			-->
				<?php if (4 == 8 ): ?>
					<php $szikrak = $szikra; foreach($szikrak as $szikra) { ?>
						<p class="dyn" id="dyn_full"><?php echo trim($szikra['szikra']); 
						?><?php if ($szikra['megj']!=''): ?><?php echo "<a title=\"".strip_tags($szikra['megj'])."\">*</a>"; ?><?php endif; ?>
						<?php echo "- <a href=\"".$url.'/'.$szikra['m']."/".$szikra['d']."\">".$honapok[$szikra['m']]." ".$szikra['d'].".</a>"; ?></p>
						
					<php } ?>
				<?php endif; ?>
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
					<?php
					$randm = sprintf('%02d', rand(1,12));
					$randd = sprintf('%02d', rand(1,28));
					
					?>
					<p>Valamennyi szikrát megkeresheted a <?php echo $url ?>/HH/NN formátummal. Például: <a href="<?php echo $url.'/'.$randm.'/'.$randd; ?>"><?php echo $url.'/'.$randm.'/'.$randd; ?></a></p>
					<p>Egy-egy hónap összes szikráját is lekérheted. Például: <a href="<?php echo $url.'/'.$randm ?>"><?php echo $url.'/'.$randm; ?></a></p>
					<p>Egy témához kapcsolódó minden mondás szintén elérhető. Például: <a href="<?php echo $url ?>/tema/választás"><?php echo $url; ?>/tema/választás</a></p>
					<p>Választhatsz véletlen szikrát is a <a href="<?php echo $url; ?>/veletlen"><?php echo $url; ?>/veletlen</a> oldalon.
					<p>Egész nyers szöveget kapsz, ha az url végére teszed, hogy „txt”. Például: <a href="<?php echo $url.'/'.$randm.'/'.$randd; ?>/txt" target="_blank"><?php echo $url.'/'.$randm.'/'.$randd; ?>/txt</a></p>
				</div>
			</div>
			<div align="center"><a href="http://jezsuita.hu"><img src="<?php echo $url; ?>/logo.png" alt="Jezsuiták" title="Készült a Jézus Társasása Magyarországi Rendtartománya támogatásával"></a></div>
		</div>
		
	</div><!-- /page help -->

	</body>
</html>
