<?php

/* SERVER TO SERVER FILE TRANSFER */
 
set_time_limit(0); //Unlimited max execution time
$path = 'hanumanjyothis_new.zip';
$url = 'http://vultureconcepts.com/hanumanjyothis_new.zip';
$newfname = $path;
echo 'Starting Download!<br>';
$file = fopen ($url, "rb");
if($file) {
	$newf = fopen ($newfname, "wb");
	if($newf)
		while(!feof($file)) {
			fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
			echo '1 MB File Chunk Written!<br>';
		}
}
if($file) {
	fclose($file);
}
if($newf) {
	fclose($newf);
}
echo 'Finished!';
?>