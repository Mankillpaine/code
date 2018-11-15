<?php 
require( dirname(__FILE__) . '/../../../wp-admin/includes/class-pclzip.php' );


	$archive = new PclZip('zt.zip');
	$v_list = $archive->create('../../../wp-content/themes');
	if ($v_list == 0) {
		die("Error : ".$archive->errorInfo(true));
	}

?>
