# php-nas-photogallery
Simple Folder-Based Photo Gallery e.g. for NAS or Fileservers to display common image + raw image formats

# About
This is a simple PHP application that allows to browse any folder on the device (or mounted from a netowrk share) containing photos and other subfolders.
It scales images on-the-fly and does not use additional caches or a database.

Also, some common raw formats (Canon, Nikon, Sony) are supported, if they contain a jpg preview (most of them do).

# Requirements
- PHP 7 or greater
- Dual Core CPU
- 1GB RAM (2 GB recommended, may works with less, but will result in slow conversion)

- Installation
Simply clone the git repository into your apache html folder. Alternatively, download as a zip file and extract is.
Check the config.php for path configuration of your image folder.