<?php
	require "common.php";
	$path=cleanPath(@$_GET["path"]);
	//die($path);
	$files=@scandir(HOME."/".$path);
	usort($files,function($a,$b){
		global $path;
		if(isDirectory($a) && isDirectory($b)){
			return strcasecmp($a,$b);
		}
		if(isDirectory($a))
			return -1;
		if(isDirectory($b))
			return 1;
		
		//return strcmp($a,$b);
		$filea=HOME."/".$path."/".$a;
		$fileb=HOME."/".$path."/".$a;
		if(SORT_BY=="exifDate"){
			$exifa=exif_read_data($filea);
			$exifb=exif_read_data($fileb);
			return strcmp($exifa["DateTimeOriginal"],$exifb["DateTimeOriginal"]);
		}
		else{
			return strcasecmp($a,$b);
		}
	});
	if(dirname($path)){
		$items[]=["folder"=>true,
				"title"=>"[Go up]",
				"thumb"=>"assets/up.png",
				"href"=>"?path=".urlencode(dirname($path))
				];
	}
	foreach($files as $file){
		if($file=="." || $file==".." || in_array(strtolower($file),$HIDE))
			continue;
		$current=$path."/".$file;
		$thumb=NULL;
		if(isDirectory($file)){
			$image=NULL;
			$href="?path=".urlencode($current);
			$thumb="assets/directory.png";
			
		}
		else{
			$image=$current;
			$href="?view=".$current;
			$thumb="image.php?src=".urlencode($image)."&size=0";
		}
		$meta=NULL; //getMetadata(HOME."/".$image); // used for rating filter, optional
		
		$size=getSizeForFile(HOME."/".$image);
		/*echo '<div class="thumb"><a href="'.$href.'" data-large-src="image.php?path='.$image.'&size=1"><img src="image.php?path='.$image.'&size=0" /><br>'.
		$meta["rating"].'
		<br>'.$file.'</a></div>';
		*/
		$items[]=[
			"src"=>"image.php?src=".urlencode($image)."&size=2",
			//"msrc"=>"image.php?src=".$image."&size=1",
			"thumb"=>$thumb,
			"w"=>$size[0],
			"h"=>$size[1],
			"title"=>$file,
			"folder"=>$image==NULL,
			"href"=>$href,
			"meta"=>$meta,
		];
			
	}
	echo json_encode($items);