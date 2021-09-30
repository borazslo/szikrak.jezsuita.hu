<?php

$oldSettings = [
	'path' => __DIR__ . '/szikra_ures.jpg',
	'text' => [
		'box' => array(105, 220, 900, 600), // x,y bal fönt; x,y jobb lent
		'font' => __DIR__ .'/arial.ttf',
		'color' => [255,255,255]
	],
	'date' => [
		'box' => array(105, 600, 900, 745 ),
		'font' => __DIR__ .'/arial.ttf',
		'size' => 30,
		'color' => [255,255,255]
	],	
];

$newSettings = [
	'path' => __DIR__ . '/IgnaciSzikrak_ures.png',
	'text' => [
		'box' => array(130, 560, 1110, 1136), // x,y bal fönt; x,y jobb lent
		'font' => __DIR__ .'/Alegreya-Medium.ttf',
		'color' => [0,0,0],
		'size' => 65, // maxSize. optional
		'align' => 'center', // optional. left, right, center
		'valign' => 'middle', // optional. top, middle, bottom
	],
	'date' => [
		'box' => array(750, 370, 1135, 436 ),
		'font' => __DIR__ .'/Alegreya-BoldItalic.ttf',
		'size' => 36,
		'color' => [255,255,255],
		'align' => 'center'
	],	
];
	
$imageSource = $newSettings;

$imageSource['text']['box']['width'] = $imageSource['text']['box'][2] - $imageSource['text']['box'][0];
$imageSource['text']['box']['height'] = $imageSource['text']['box'][3] - $imageSource['text']['box'][1];
	
$imageSource['date']['box']['width'] = $imageSource['date']['box'][2] - $imageSource['date']['box'][0];
$imageSource['date']['box']['height'] = $imageSource['date']['box'][3] - $imageSource['date']['box'][1];

//defaults
if(!isset($imageSource['text']['size']))
	$imageSource['text']['size'] = 40;

include 'sql.php'; 

$fontPath = $imageSource['fontPath'];

$fontSize = 46;

if ($_GET['d'] == 'random') {
    $match = array(0, sprintf('%02d',rand(1,12),2), sprintf('%02d',rand(1,31),2));

} else if (!preg_match('/^([0-9]{2})\/([0-9]{2})$/', $_GET['d'], $match))  {
    $match = array(0, date('m'), date('d'));
} 

$szikra = $szikrak[intval($match[1])][intval($match[2])];    

$img = false;

szikra_to_box($imageSource, $fontSize, $szikra['text'], $szikra['dateHun']);


function szikra_to_box($imageSource, $font_size, $text, $date ) {
	global $img;
		
	// CREATE empty image
	$image_path = $imageSource['path'];	
	if(!file_exists($image_path)) die('Alap kép nem elérhető!');
	if(preg_match('/\.jpg$/i',$image_path)) {
		$img = imagecreatefromjpeg($image_path); // 509 x 427
	} else if(preg_match('/\.png$/i',$image_path)) {
		$img = imagecreatefrompng($image_path); // 509 x 427
	} else {
		die('A kép png vagy jpg kell legyen.');
	}
	if(!$img) die('Nem sikerült a képet létrehozni!');
	
    $black = imagecolorallocate($img, 0x00, 0x00, 0x00);
    $white = imagecolorallocate($img, 255, 255, 255);
	
    
    // WRITE DATE into the center of the date box
	$tbbox = imagettfbbox($imageSource['date']['size'], 0, $imageSource['date']['font'], $date);
	$tbbox['height'] = $tbbox[1] - $tbbox[7];	
	$tbbox['width'] = $tbbox[4] - $tbbox[6];	
		
	if(isset($imageSource['date']['align'])) $align = $imageSource['date']['align']; else $align == false;	
	if($align == 'left' OR $align == false) {
		$x = $imageSource['date']['box'][0];
	} else if ($align == 'center') {
		$x = $imageSource['date']['box'][0] + ( $imageSource['date']['box']['width'] - $tbbox['width'] ) / 2;
	} else if ($align == 'right') {
		$x = $imageSource['date']['box'][2] - $tbbox['width'];
	} else 
		die ('Invalid align!');

	if(isset($imageSource['data']['valign'])) $valign = $imageSource['date']['valign']; else $valign == false;
	
	$valign = 'middle';
	if($valign == 'top' OR $valign == false) {
		$y = $imageSource['date']['box'][1] + $tbbox['height'];
	} else if ($valign == 'middle') {
		$y = $imageSource['date']['box'][1] + ( $imageSource['date']['box']['height'] - $tbbox['height'] ) / 2 + $tbbox['height'];
	} else if ($valign == 'bottom') {
		$y = $imageSource['date']['box'][3];
	} else 
		die ('Invalid align!');
		
	//call_user_func_array('imagerectangle',array_merge([$img],array_slice($imageSource['date']['box'],0,4,true),[$black])); 
	//call_user_func_array('imagerectangle',array_merge([$img],[$x,$y,$x + $tbbox['width'],$y - $tbbox['height']],[$white])); 
    imagettftext($img, 
		$imageSource['date']['size'], 0,  // sizen and angle
		$x, $y ,  // lower left coordinates
		call_user_func_array('imagecolorallocate',array_merge([$img], $imageSource['date']['color'])), // color
		$imageSource['date']['font'],  // font file
		$date // "text
	); 

	// WRITE TEXT into the center of the text box
	#$text = preg_replace('/, ha /i', ", ha&nbsp;", $text);
    #$text = preg_replace('/, mint /i', ", ha&nbsp;", $text);

	//Test the Box
    //call_user_func_array('imagerectangle',array_merge([$img], array_slice($imageSource['text']['box'],0,4,true), [$black]));
	
	// Split text to line adjusting font size if neccesary
    list($imageSource['text']['lines'], $imageSource['text']['lineHeight'], $height) = image_multiline_text($img, $imageSource['text'], $text ); 
	while($height >  $imageSource['text']['box']['height']) {
		$imageSource['text']['size'] = $imageSource['text']['size'] - 3;		
		list($imageSource['text']['lines'], $imageSource['text']['lineHeight'], $height) = image_multiline_text($img, $imageSource['text'], $text ); 	
    }

	foreach($imageSource['text']['lines'] as $lineN => $line) {

		if(isset($imageSource['text']['align'])) $align = $imageSource['text']['align']; else $align = false;
		if($align == 'left' OR $align == false) {
			$x = $imageSource['text']['box'][0];
		} else if ($align == 'center' ) {
			$tbbox = imagettfbbox($imageSource['text']['size'], 0, $imageSource['text']['font'], $line);
			$x = $imageSource['text']['box'][0] + ( $imageSource['text']['box']['width'] - $tbbox[4] - $tbbox[6]     ) / 2 ;
		} else if ($align == 'right') {
			$tbbox = imagettfbbox($imageSource['text']['size'], 0, $imageSource['text']['font'], $line);
			$x = $imageSource['text']['box'][2] - (  $tbbox[4] - $tbbox[6]     )  ;
		} else 
			die('Invalid align!');
			
		if(isset($imageSource['text']['valign'])) $valign = $imageSource['text']['valign']; else $valign = false;
		if($valign == 'top' OR $valign == false) {
			$y = $imageSource['text']['box'][1];
		} else if ($valign == 'middle') {			
			$y = $imageSource['text']['box'][1] + ( $imageSource['text']['box']['height'] -  ( $imageSource['text']['lineHeight'] * count( $imageSource['text']['lines'] ) ) ) / 2;			
		} else if ($valign == 'bottom') {
			$y = $imageSource['text']['box'][3] - $imageSource['text']['lineHeight'] * count( $imageSource['text']['lines'] ) ;
		} else 
			die('Invalid valign!');
		$y += ( $lineN + 1 ) *  $imageSource['text']['lineHeight'];
		
		
		imagettftext($img, 
			$imageSource['text']['size'], 0,  // sizen and angle
			$x, $y ,  // lower left coordinates
			call_user_func_array('imagecolorallocate',array_merge([$img], $imageSource['text']['color'])), // color
			$imageSource['text']['font'],  // font file
			$line // "text
		); 
				
	}	
}

header('Content-Type: image/jpeg');
imagejpeg($img);
imagedestroy($img);
exit();




function image_multiline_text($image, $source, $text)
{
	
	foreach($source as $key => $value) $$key = $value;
	
	$color = call_user_func_array('imagecolorallocate',array_merge([$image], $color));
	
	
    $split = explode(" ", $text);    
    $string = "";
    $new_string = "";
    $linebox = imagettfbbox($size, 0, $font, $text);	
    $lineHeight = $linebox[3]-$linebox[5];
    $ypos = $box[1] + $lineHeight;
    $count = 0;
	$lines = [];
    for ($i = 0; $i < count($split); $i++)
    {
        // check size of string
        $tbbox = imagettfbbox($size, 0, $font, $string . $split[$i]);
        /*
        0   lower left corner, X position
        1   lower left corner, Y position
        2   lower right corner, X position
        3   lower right corner, Y position
        4   upper right corner, X position
        5   upper right corner, Y position
        6   upper left corner, X position
        7   upper left corner, Y position
        */
        if ($tbbox[4] - $tbbox[6] < ( $box[2] - $box[0] ) )
        {
            $string .= $split[$i] . " ";
            //echo $string."<br>";
        }
          else
        {
			if($i == 1) {			
					return [false,false,10000000000000000];
			}			
			$i--;
			$lines[] = $string;            
            $string = "";
        }
    }
	$lines[] = $string;
	return [$lines, $lineHeight, count($lines) * $lineHeight];
		
	
    //$tb = imagettftext($image, $size, $angle, $xpos, $ypos, $color, $font, $string);
    //exit;
    
	//return $ypos;
	
}    


?>