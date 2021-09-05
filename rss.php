<?php
header('Content-type: text/xml');
?>
<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/">
<?php
	include 'sql.php'; 
	srand(strtotime("today"));
	$pubTime = strtotime(rand(3,7).":".rand(0,59));
	
	if($pubTime > time()) {
		srand(strtotime("yesterday"));
		$pubTime = strtotime("Yesterday ".rand(3,7).":".rand(0,59));
	}
	
	$szikra = $szikrak[date('n', $pubTime)][date('j', $pubTime)];	
?>
	<channel>
		<language>hu</language>
		<link><?php echo $url; ?></link>
		<title><?php echo $pageTitle; ?></title>
		<description><?php echo $pageDescription; ?></description>
		<category><?php echo $pageCategory; ?></category>		
		<copyright><?php echo $pageCopyright; ?></copyright>		
			
	<!--
		<image>
			<url>http://www.feedforall.com/feedforall-temp.gif</url>
			<title>FeedForAll Sample Feed</title>
			<link>http://www.feedforall.com/industry-solutions.htm</link>
			<description>FeedForAll Sample Feed</description>
			<width>144</width>
			<height>117</height>
		</image>
	-->
		<item>
			<guid isPermaLink="false"><?php echo date('Y', $pubTime).preg_replace('/\//','-',$szikra['url']);  ?></guid>			
			<title><?php echo $pageTitle." - ".$szikra['dateHun']; ?></title>
			<description><?php echo $szikra['text']; ?></description>
			<link><?php echo $url.$szikra['url']; ?></link>			
			<image:image xmlns:image="http://szikrak.jezsuita.hu/image.php?d=<?php echo trim($szikra['url'],'/'); ?>" />
			<media:content url="http://szikrak.jezsuita.hu/image.php?d=<?php echo trim($szikra['url'],'/'); ?>" medium="image" />
			<pubDate><?php echo date('r', $pubTime); ?></pubDate>
		</item>

	</channel>
</rss>