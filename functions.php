<?php

$base_url = "http://szikrak.jezsuita.hu/";

$honapok = array(0=>'','01'=>'január','02'=>'február','03'=>'március','04'=>'április','05'=>'május','06'=>'június','07'=>'július','08'=>'augusztus','09'=>'szeptember','10'=>'október','11'=>'november','12'=>'december');

$honapok = array(0=>'','01'=>'Január','02'=>'Február','03'=>'Március','04'=>'Április','05'=>'Május','06'=>'Június','07'=>'Július','08'=>'Augusztus','09'=>'Szeptember','10'=>'Október','11'=>'November','12'=>'December');

getconnection();

function getconnection() {
		$user="jezsuweb_szikrak";
		$password="***";
		$database="***";
		@mysql_connect('localhost',$user,$password) or print( "Error :".mysql_errno() . ": " . mysql_error());
		@mysql_select_db($database) or die( "Unable to select database");
		
		return '';
		return $connection;
	}
function setvar($name,$value) {
	$test = getvar($name);
	if( $test == false) {
		$query="INSERT INTO vars (name, value) VALUES ('$name','$value')";
	} else {	
		$query='UPDATE vars SET value = \''.$value.'\' WHERE name = \''.$name.'\'';
	}
	if(!mysql_query($query)) echo'<br>Error during \'setvar\': '.$name."/".$value."--".$query;
	//mysql_query($query);
	//echo "---".mysql_errno() . ": " . mysql_error(). "\n";	
}
function getvar($name) {
	$query="SELECT * FROM vars WHERE name = '".$name."' ORDER BY id DESC LIMIT 0,1";
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$return = $row[2];
	}
	if(!$return) $return = false;
	return $return;
}
function getszikra($m='',$d='') {
	global $p, $honapok, $base_url;
	if($m=='' and $d=='') { $m = date("m"); $d = date("d"); }
	if($m!='' and $d=='') {
		$query="SELECT * FROM szikrak WHERE date >= '0000-".$m."-00' AND date <= '0000-".$m."-32' ORDER BY date ASC";
	} elseif($p == 'tema' AND $_GET['tag'] != '') {
		//$query="SELECT * FROM szikrak WHERE tags LIKE '%".mb_convert_encoding($_GET['tag'],'utf-8','ISO-8859-1')."%' ORDER BY date ASC";
		$query="SELECT * FROM szikrak WHERE tags LIKE '%".mb_convert_encoding($_GET['tag'],'utf-8','utf-8')."%' ORDER BY date ASC";
		//echo $query;
	}
	else
		$query="SELECT * FROM szikrak WHERE date <= '0000-".$m."-". $d."' ORDER BY date DESC LIMIT 0,1";
	$result = mysql_query($query);

	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {

		    $szikrak[] = array(
				"id" => $row[0],
				"url" => $base_url.$row[1]{5}.$row[1]{6}."/".$row[1]{8}.$row[1]{9},
				"date" => $row[1],
				"szikra" => $row[2],
				"megj" => $row[3],
				"date2" => $row[1]{5}.$row[1]{6}.". ".$row[1]{8}.$row[1]{9}.".",
				"date3" => $row[1]{5}.$row[1]{6}."-".$row[1]{8}.$row[1]{9},
				"date4" => $honapok[$row[1]{5}.$row[1]{6}]." ".intval($row[1]{8}.$row[1]{9}).".",
				"m" => $row[1]{5}.$row[1]{6},
				"d" => $row[1]{8}.$row[1]{9},
				"tags_row" => $row[4],
				"tags" => explode(', ',$row[4]));
		   // echo $row[1]." ".$row[2]."...<br>"; 
		}
	if(($m != '' And $d == '') OR ($p == 'tema' AND $_GET['tag'] != '')) return $szikrak;
	return $szikrak[count($szikrak)-1];
}
	

?>