<?php


include("connect.php"); 
if(!isset($_SESSION["Member"])) 
		{
			header("Location: Login.php"); 
		}
		else
		{
			$Member = $_SESSION["Member"];
			
		}
	$sql = "SELECT * FROM Shipment WHERE  S_id = '$Member' ";
	$result = mysql_query($sql);
	
	while($rows=mysql_fetch_array($result)){ 
	
	
//include "qrlib.php";

//include('/phpqrcode/qrlib.php');
//include(dirname(__FILE__) . "/phpqrcode/qrlib.php");

//QRcode::png('code data text', 'filename.png'); // creates file
//QRcode::png("yipieeeee!!!", "test.png", "L", 4, 4);
//echo QRcode::png('aaaaaa'); // creates code image and outputs it directly into browser
include('phpqrcode/qrlib.php');
 
    $tempDir = EXAMPLE_TMP_SERVERPATH; 

     // how to save PNG codes to server 
     
    //tempDir = 'D:\XAMPP\htdocs\postmyid (1)\domains\post2myid.tk\public_html\phpqrcode\temp'; 
    /* $tempURL = 'D:\XAMPP\htdocs\postmyid (1)\domains\post2myid.tk\public_html\phpqrcode\temp'; 
    $codeContents = 'This Goes From File'; 
     
    // we need to generate filename somehow,  
    // with md5 or with database ID used to obtains $codeContents... 
    $fileName = '005_file_'.md5($codeContents).'.png'; 
     
    $pngAbsoluteFilePath = $tempDir.$fileName; 
    $urlRelativeFilePath =  $tempURL.$fileName; 
     
    // generating 
    if (!file_exists($pngAbsoluteFilePath)) { 
        QRcode::png($codeContents, $pngAbsoluteFilePath,QR_ECLEVEL_L,10); 
        echo 'File generated!'; 
        echo '<hr />'; 
    } else { 
        echo 'File already generated! We can use this cached file to speed up site on common codes!'; 
        echo '<hr />'; 
    } 
     
    echo 'Server PNG File: '.$pngAbsoluteFilePath; 
    echo '<hr />'; 
     
    // displaying 
    echo '<img src="http://localhost/postmyid%20(1)/domains/post2myid.tk/public_html/phpqrcode/temp'.$fileName.'" >'; 
	 echo 'x'; 
	 $name ='aaa';
    $phone =  'bbb';
	$back_color = 0xFFFF00;
$fore_color = 0xFF00FF;
	*/
	 $codeContents  = $rows['OrderID'].$rows['S_id'].$rows['R_id'];
	 $id = $rows['acc_ID'];
	//$name = $rows['firstname'];
   // $phone =  $rows['phone_no'];
    }
	  
	
    // we building raw data 
   // $codeContents  = 'BEGIN:VCARD'."\n"; 
   // $codeContents .= 'FN:'.$name."\n"; 
  // $codeContents .= 'TEL;WORK;VOICE:'.$phone."\n"; 
  //  $codeContents .= 'END:VCARD'; 
  //$encrypted_txt = "WC9YdDB6elBhTTZrY0huZHVESFJ4cUgwamE2V25vYktNeUcrbnBYblRoOGg4cXJWYnhpNWx1L3hXamFlWkFPZW4zeHA4U1BaZm5uZFpsNkFsajA2clo5azZZdXFuVk5TN0xkWHhtdGt2L1E9";
   // $codeContents = $encrypted_txt;
 
    $back_color = 0xFFFFFF;
	$fore_color =  0x006666	;
    // generating
//QRcode::png($codeContents,  false, 'h', 6, 1, false, $back_color, $fore_color);	
    echo QRcode::png($codeContents, $tempDir.$id.'.png', 'h', 10,1, false, $back_color, $fore_color); 
    //echo '<img src="http://localhost/postmyid%20(1)/domains/post2myid.tk/public_html/phpqrcode/temp025.png" >'; 
	   echo '<img src="'. $tempDir.$id.'.png" />'; 
  
//QRcode::png('some othertext 1234', false, 'h', 20, 1, false, $back_color, $fore_color);

?>

