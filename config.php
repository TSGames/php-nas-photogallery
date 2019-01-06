<?php
// path to root folder, can also be absolute
define("HOME","images");

// Size of the thumbnails
define("THUMB_SIZE",300);
// JPG Quality (0 - 100)
define("THUMB_QUALITY",25);

// Full size for preview, you may use 0 to send the original image (although not recommended)
define("FULL_SIZE",2000);
// JPG Quality (0 - 100)
define("FULL_SIZE_QUALITY",80);
// either "name" (faster) or "exifDate" (slower)
define("SORT_BY","name");
//define an array of all file names that should be ignored, write them all in lower case!
$HIDE=["thumbs.db","@eaDir",".picasa.ini"];
?>