<?php session_start();

	$str="0123456789";
	
	$captcha="";
	
	for($i=1;$i<=6;$i++)
	{
		$captcha.=substr($str,rand(0,strlen($str)-1),1);
	}
	
	$img=imagecreate(75,40);
	
	imagecolorallocate($img,220,220,220);
	
	imagestring($img,6,4,10,$captcha,1);
	$_SESSION['captcha']=str_replace(" ","",$captcha);
	
	header("content-type:image/jpeg");
	imagejpeg($img);
	imagedestroy($img);
?>