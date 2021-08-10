<?php

$baseImage = 'szikra_ures.jpg';
$box = array(105, 220, 900, 600); // x,y bal fönt; x,y jobb lent

$fontPath = "arial.ttf";
$fontSize = 46;


include_once('functions.php');

if ($_GET['d'] == 'random') {
    $match = array(0, sprintf('%02d',rand(1,12),2), sprintf('%02d',rand(1,31),2));

} else if (!preg_match('/^([0-9]{2})\/([0-9]{2})$/', $_GET['d'], $match))  {
    $match = array(0, date('m'), date('d'));
} 

$szikra = getszikra($match[1],$match[2]);    

$img = false;

szikra_to_box($baseImage, $box, $fontSize, $szikra['szikra'], $szikra['date4']);


function szikra_to_box($image_path, $box, $font_size, $text, $date ) {
    global $img, $fontPath;

    #$text = preg_replace('/, ha /i', ", ha&nbsp;", $text);
    #$text = preg_replace('/, mint /i', ", ha&nbsp;", $text);



    $img = imagecreatefromjpeg($image_path); // 509 x 427

    $black = imagecolorallocate($img, 0x00, 0x00, 0x00);
    $white = imagecolorallocate($img, 255, 255, 255);


    //Test the Box
    //imagerectangle($img, $box[0], $box[1], $box[2], $box[3], $white);
    
    // Write time and date
    imagettftext($img, 20, 0, $box[0], $box[3] + 45, $white, $fontPath, $date); // "draws" the rest of the string


    $ypos = image_multiline_text($img, $font_size, 0, $box[0], $box[1], $white, $fontPath, $text, $box[2] - $box[0]); 

    if($ypos > $box[3]) {
        szikra_to_box($image_path, $box, $font_size - 3, $text, $date);        
    }

}


header('Content-Type: image/jpeg');
imagejpeg($img);
exit();




function image_multiline_text($image, $size, $angle, $xpos, $ypos, $color, $font, $text, $max_width, $next_line = '')
{
    $split = explode(" ", $text);    
    $string = "";
    $new_string = "";
    $box = imagettfbbox($size, 0, $font, $text);
    $lineHeight = $box[3]-$box[5];
    $ypos = $ypos + $lineHeight;
    $count = 0;
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
        if ($tbbox[4] - $tbbox[6] < $max_width)
        {
            $string .= $split[$i] . " ";
            //echo $string."<br>";
        }
          else
        {
            //echo "<br/><br/>";            
            $i--;
            $tb = imagettftext($image, $size, $angle, $xpos, $ypos, $color, $font, $string);
            $height =  $tb[3]-$tb[5]; 
            $ypos = $tb[3] + $lineHeight; // change this to adjust line-height.
            $string = "";
        }
    }
    $tb = imagettftext($image, $size, $angle, $xpos, $ypos, $color, $font, $string);
    return $ypos;
}    


?>