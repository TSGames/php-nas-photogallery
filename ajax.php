<?php
	require "common.php";
	$path=cleanPath(@$_GET["path"]);
	$files=@scandir(HOME."/".$path);
	usort($files,function($a,$b){
		global $path;
		if(isDirectory($a) && isDirectory($b)){
			return strcmp($a,$b);
		}
		if(isDirectory($a))
			return -1;
		if(isDirectory($b))
			return 1;
		
		//return strcmp($a,$b);
		
		$exifa=exif_read_data(HOME."/".$path."/".$a);
		$exifb=exif_read_data(HOME."/".$path."/".$b);
		return strcmp($exifa["DateTimeOriginal"],$exifb["DateTimeOriginal"]);
		
	});
	if(dirname($path)){
		$items[]=["folder"=>true,
				"title"=>"[Up]",
				"href"=>"?path=".dirname($path)
				];
	}
	foreach($files as $file){
		if($file=="." || $file==".." || in_array($file,$HIDE))
			continue;
		$current=$path."/".$file;
		if(isDirectory($file)){
			$image=NULL;
			$href="?path=".$current;
			
		}
		else{
			$image=$current;
			$href="?view=".$current;
		}
		$meta=getMetadata(HOME."/".$image);
		
		$size=getSizeForFile(HOME."/".$image);
		/*echo '<div class="thumb"><a href="'.$href.'" data-large-src="image.php?path='.$image.'&size=1"><img src="image.php?path='.$image.'&size=0" /><br>'.
		$meta["rating"].'
		<br>'.$file.'</a></div>';
		*/
		$items[]=[
			"src"=>"image.php?src=".$image."&size=2",
			"msrc"=>"image.php?src=".$image."&size=1",
			"thumb"=>"image.php?src=".$image."&size=0",
			"w"=>$size[0],
			"h"=>$size[1],
			"title"=>$file,
			"folder"=>$image==NULL,
			"href"=>$href,
			"meta"=>$meta,
		];
			
	}
	echo json_encode($items);