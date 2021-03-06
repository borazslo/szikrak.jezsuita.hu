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
	
		<title><?php echo strip_tags($pageTitle); ?></title> 
		
		<meta property="fb:app_id" content="133165076817014" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" />
		<meta property="og:title" content="<?php echo strip_tags($pageTitle); ?>" />
		<meta property="og:description" content="<?php echo $pageDescription; ?>" />
		<?php if (isset($szikra)) : ?>
		<meta property="og:image" content="<?php echo $url; ?>/image.php?d=<?php echo preg_replace('/^\//','',$szikra['url']); ?>" />
		<?php endif; ?>
	
		<meta name="description" content="<?php echo $pageDescription; ?>">
		
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
			<a id="home_help" href="#help" title="S??g??"><span>S??g??</span></a>
			<h1><?php echo $pageTitle; ?></h1>
		</div><!-- /header -->

		<div data-role="none" >	
			<div id="full_prayer">
				<p></p>
				<?php 
				
					 echo $content 
								 
				 ?>
			</div>
		</div><!-- /content -->
	</div><!-- /page home -->




	<div data-role="page" id="help" data-theme="a">
		<div data-role="header" data-position="fixed">
			<h1>S??g??</h1><a href="#home" data-direction="reverse" data-role="button" data-theme="b">Vissza</a>
		</div><!-- /header -->

		<div data-role="content">
			<p>Loyolai Szent Ign??c v??logatott gondolatai az ??v minden napj??ra.</p>
		
			<div data-role="collapsible-set">
				<div data-role="collapsible" data-iconpos="right">
					<h3>H??romsz??z ??ves m??</h3>
					<p>Loyolai Szent Ign??cnak, a jezsuita rend alap??t??j??nak, jellegzetes, frapp??ns t??m??rs??ggel megfogalmazott mond??sainak gy??jtem??nye el??sz??r 1705-ben jelent meg Hevenesi G??bor magyar jezsuita ??ssze??ll??t??s??ban. Az ??vsz??zadok sor??n egyre ??jabb kiad??sokat ??rt meg szinte v??ltozatlan form??ban. K??l??nb??z?? korok jezsuit??i minden bizonnyal ??gy ??rezt??k, hogy a gy??jtem??ny h??s??gesen adja vissza Ign??cot.</p>
				</div>
				<div data-role="collapsible" data-iconpos="right">
					<h3>Ha meg akarod venni</h3>
					<p>A k??nyvet ???Ign??ci szikr??k??? c??mmel 2009-ben Kecskem??ten adta ki a Korda Kiad??</p>
					<p><a href="http://www.kordakonyv.hu">kordakonyv.hu</a>
				</div>
				<div data-role="collapsible" data-iconpos="right">
					<h3>M??sutt is az interneten</h3>
					<p><a href="https://www.facebook.com/ignaciszikrak" title="Hol m??sutt?">Facebookon</a></p>
					<p><a href="http://feedburner.google.com/fb/a/mailverify?uri=ignaci_szikrak" title="Add meg a c??medet, ??s megkapod minden nap emailben.">Emailben</a></p>
					<p><a href="http://feeds.feedburner.com/ignaci_szikrak" title="Iratkozz fel, ??s kedvenc RSS olvas??dban k??vetheted a szikr??kat.">RSS-ben</a></p>
					<p><a href="http://twitter.com/ignaciszikrak" title="Napi egy tweet igaz??n nem sok.">Twitteren</a></p>
				</div>
				<div data-role="collapsible" data-iconpos="right" data-collapsed="false">
					<h3>A honlap titkai</h3>
					<?php
					$randm = sprintf('%02d', rand(1,12));
					$randd = sprintf('%02d', rand(1,28));
					
					?>
					<p>Minden napnak van k??l??n el??rhet??s??ge ??gy az ??v valamennyi szikrj??t el??rheted. P??ld??ul: <a href="<?php echo $url.'/'.$randm.'/'.$randd; ?>"><?php echo '/'.$randm.'/'.$randd; ?></a></p>
					<p>Egy-egy h??nap ??sszes szikr??j??t is lek??rheted. P??ld??ul: <a href="<?php echo $url.'/'.$randm ?>"><?php echo '/'.$randm; ?></a></p>
					<p>Egy t??m??hoz kapcsol??d?? minden mond??s szint??n el??rhet??. P??ld??ul: <a href="<?php echo $url ?>/tema/v??laszt??s">/tema/v??laszt??s</a></p>
					<p>A t??m??kat pedig kilist??zhatod: <a href="<?php echo $url; ?>/temak">/temak</a></p>
					<p>V??laszthatsz v??letlen szikr??t is a <a href="<?php echo $url; ?>/veletlen">/veletlen</a> oldalon.
					<p>Speci??lis form??tumokban is le lehet k??rni az adatokat. 
					<br/>K??pk??nt is meglehet n??zni valamennyi szikr??t (ak??r a v??letlenekt is) ??gy: <a href="<?php echo $url.'/'.$randm.'/'.$randd; ?>/kep" target="_blank"><?php echo '/'.$randm.'/'.$randd; ?>/kep</a>
					<br/>Eg??sz nyers sz??veget kapsz, ha az url v??g??re teszed, hogy ???txt???. P??ld??ul: <a href="<?php echo $url.'/'.$randm.'/'.$randd; ?>/txt" target="_blank"><?php echo '/'.$randm.'/'.$randd; ?>/txt</a>.
					<br/>Vagy json form??tumban a ???json??? kieg??sz??t??vel. P??ld??ul: <a href="<?php echo $url; ?>/tema/v??laszt??s/json" target="_blank">/tema/v??laszt??s/json</a></p>
				</div>
			</div>
			<div align="center"><a href="http://jezsuita.hu"><img src="<?php echo $url; ?>/logo.png" alt="Jezsuit??k" title="K??sz??lt a J??zus T??rsas??sa Magyarorsz??gi Rendtartom??nya t??mogat??s??val"></a></div>
		</div>
		
	</div><!-- /page help -->

	</body>
</html>
