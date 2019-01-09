<?php
// path to root folder, can also be absolute
define("HOME","images");

// either "jpeg" or "webp"
// webp is recommended as it reduces bandwidth, as long as your target browser supports it
define("IMAGE_FORMAT","webp");
// Size of the thumbnails
define("THUMB_SIZE",500);
// JPG Quality (0 - 100)
define("THUMB_QUALITY",30);

// allow to use the exif thumbnail (if available)
// results in much faster thumbs, but they may have lower quality
define("THUMB_EXIF_THUMBNAIL",true);

// Full size for preview, you may use 0 to send the original size
define("FULL_SIZE",3000);
// JPG Quality (0 - 100)
define("FULL_SIZE_QUALITY",70);
// either "name" (faster) or "exifDate" (slower)
define("SORT_BY","name");
//define an array of all file names that should be ignored, write them all in lower case!
$HIDE=["thumbs.db","@eaDir",".picasa.ini"];
?>