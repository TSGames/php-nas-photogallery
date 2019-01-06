<?php
	require("common.php");
	$path=HOME.'/'.cleanPath(@$_GET["src"]);
	if(@$_GET["reportSize"]){
		echo json_encode(getSizeForFile($path));
		die();
	}
	$size=@$_GET["size"];
	header('Content-Type: image/jpeg');
	if($size<2){
		$data=exif_thumbnail($path);
		if($data){
			$img=@imagecreatefromstring($data);
		}
	}
	if(@$img==NULL){
		$img=@imagecreatefromjpeg($path);
	}
	if(@$img==NULL){
		$img=getRaw($path,$size==0);
	}
	$width=imagesx($img);
	$height=imagesy($img);
	if($size==0){

		// calculating the part of the image to use for thumbnail
		if ($width > $height) {
		  $y = 0;
		  $x = ($width - $height) / 2;
		  $smallestSide = $height;
		} else {
		  $x = 0;
		  $y = ($height - $width) / 2;
		  $smallestSide = $width;
		}
		$thumb = imagecreatetruecolor(THUMB_SIZE, THUMB_SIZE);
		imagecopyresized($thumb, $img, 0, 0, $x, $y, THUMB_SIZE, THUMB_SIZE, $smallestSide, $smallestSide);

		imagejpeg($thumb,NULL,THUMB_QUALITY);
	}
	else if($size==1){
		
		/*list($thumb_w,$thumb_h)=getSize($width,$height,PREVIEW_SIZE);
		$thumb        =   ImageCreateTrueColor($thumb_w,$thumb_h);

		imagecopyresized($thumb,$img,0,0,0,0,$thumb_w,$thumb_h,$width,$height); */
		imagejpeg($img,NULL,QUALITY);

	}
	else{
		if(FULL_SIZE>0){
			list($thumb_w,$thumb_h)=getSize($width,$height,FULL_SIZE);
			$thumb  =   ImageCreateTrueColor($thumb_w,$thumb_h);
			imagecopyresized($thumb,$img,0,0,0,0,$thumb_w,$thumb_h,$width,$height); 
			imagejpeg($thumb,NULL,FULL_SIZE_QUALITY);
		}
		else{
			imagejpeg($img,NULL,FULL_SIZE_QUALITY);			
		}
	}
	imagedestroy($thumb);
	imagedestroy($img);


?>