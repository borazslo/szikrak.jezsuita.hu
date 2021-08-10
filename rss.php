<?php
header('Content-type: text/xml');
?>
<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/">
<?php
	include 'sql.php'; 
	$szikra = $szikrak[date('n')][date('j')];	
?>
	<channel>
		<language>hu</language>
		<link><?php echo $url; ?></link>
		<title><?php echo $pageTitle; ?></title>
		<description><?php echo $pageDescription; ?></description>
		<category><?php echo $pageCategory; ?></category>		
		<copyright><?php echo $pageCopyright; ?></copyright>		
		<lastBuildDate><?php echo date('r', strtotime(date('Y').preg_replace('/\//','-',$szikra['url']))); ?></lastBuildDate>
			
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
			<guid isPermaLink="false"><?php echo date('Y').preg_replace('/\//','-',$szikra['url']);  ?></guid>			
			<title><?php echo $pageTitle." - ".$honapok[$szikra['month']]." ".$szikra['day']."."; ?></title>
			<description><?php echo $szikra['text']; ?></description>
			<link><?php echo $url.$szikra['url']; ?></link>			
			<image:image xmlns:image="http://szikrak.jezsuita.hu/image.php?d=<?php echo trim($szikra['url'],'/'); ?>" />
			<media:content url="http://szikrak.jezsuita.hu/image.php?d=<?php echo trim($szikra['url'],'/'); ?>" medium="image" />
			<pubDate><?php echo date('r', strtotime(date('Y').preg_replace('/\//','-',$szikra['url']))); ?></pubDate>
		</item>

	</channel>
</rss>