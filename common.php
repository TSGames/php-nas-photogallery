<?php
ini_set("memory_limit","1000M");
set_time_limit(300);
require "config.php";
function cleanPath($path){
	return str_replace(array('.\\','./','..'),'',$path);
}
function getMetadata($path){
	$content = file_get_contents($path,false,NULL,0,1024*1024);
	$xmp_data_start = strpos($content, '<x:xmpmeta');
	$xmp_data_end   = strpos($content, '</x:xmpmeta>');
	$xmp_length     = $xmp_data_end - $xmp_data_start;
	$xmpData       = substr($content, $xmp_data_start, $xmp_length + 12);
	//$xmp            = DOMDocument::loadXML($xmp_data);
	$data["rating"]=parseXMP($xmpData,"xmp:Rating");
	return $data;
}
function getRaw($path,$thumb=true){
	// limit size, otherwise some files like videos may cause performance issues
	$content = file_get_contents($path,false,NULL,0,10*1024*1024);
	for($i=0;$i<100;$i++){
		$content=strstr(substr($content,2),chr(0xff).chr(0xd8));
		
		$img=@imagecreatefromstring($content);
		if(@imagesx($img) && $thumb)
			return $img;
		$size=@imagesx($img)*@imagesy($img);
		$images[]=["img"=>$img,"size"=>$size];
		if($size>500000)
			break;
	}
	usort($images,function($a,$b){
		return $a["size"]<$b["size"]?1:-1;
	});
	//print_r($images);
	//die();
	return $images[0]["img"];
}
function parseXMP($xmp,$node){
	$str=strstr($xmp,$node);
	$str=substr($str,strlen($node)+2);
	$str=substr($str,0,strpos($str,'"'));
	return $str;
}
function getImage($path){
	$files=@scandir(HOME."/".$path);
	foreach($files as $file){
		if(is_file(HOME."/".$path."/".$file))
			return $file;
	}
	return NULL;
	}
function getSizeForFile($path){
	$size=getimagesize($path);
	if($size)
		return getSize($size[0],$size[1],FULL_SIZE);
	$img=getRaw($path,false);
	return getSize(imagesx($img),imagesy($img),FULL_SIZE);
}
function isDirectory($file){
	//$content = file_get_contents($file,false,NULL,0,1);
	//return !$content;
	//return !strpos($file,".");
	return is_dir($file);
}
function getSize($width,$height,$max){
	if($max<=0 || $width==0 || $height==0)
		return [$width,$height];
	if($width > $height) 
		{
			$thumb_w    =   $max<$width ? $max : $width;
			$thumb_h    =   $height*($thumb_w/$width);
		}
		else 
		{
			$thumb_h    =   $max<$height ? $max : $height;
			$thumb_w    =   $width*($thumb_h/$height);
		}
	return [$thumb_w,$thumb_h];
	}
?>