<?php
	require("common.php");
	function outputImage($img,$quality){
		if(IMAGE_FORMAT=="jpeg"){
			header('Content-Type: image/jpeg');		
			imagejpeg($img,NULL,$quality);
		}
		else if(IMAGE_FORMAT=="webp"){
			header('Content-Type: image/webp');		
			imagewebp($img,NULL,$quality);
		}
		else
			throw new Exception("Unsupported image format ".IMAGE_FORMAT);
		imagedestroy($img);
	}
	$path=HOME.'/'.cleanPath(@$_GET["src"]);
	if(@$_GET["reportSize"]){
		echo json_encode(getSizeForFile($path));
		die();
	}
	$size=@$_GET["size"];
	if($size<2 && THUMB_EXIF_THUMBNAIL){
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

		outputImage($thumb,THUMB_QUALITY);
	}
	$max_size=$size==1 ? THUMB_SIZE : FULL_SIZE;
	$quality=$size==1 ? THUMB_QUALITY : FULL_SIZE_QUALITY;
	if($max_size>0){
		list($thumb_w,$thumb_h)=getSize($width,$height,$max_size);
		$thumb  =   ImageCreateTrueColor($thumb_w,$thumb_h);
		imagecopyresized($thumb,$img,0,0,0,0,$thumb_w,$thumb_h,$width,$height); 
		outputImage($thumb,$quality);
	}
	else{
		outputImage($img,$quality);			
	}
?>