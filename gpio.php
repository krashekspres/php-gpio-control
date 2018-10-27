﻿<?php
if (isset ( $_GET["pic"] )) {
	$pic = strip_tags ($_GET["pic"]);
	
	//test if value is a number
	if ( (is_numeric($pic)) && ($pic == 7)) {
		
		//set the gpio's mode to output		
		system("gpio mode ".$pic." out");
		//reading pin's status
		exec ("gpio read ".$pic, $status, $return );
		//set the gpio to high/low
		if ($status[0] == "0" ) { $status[0] = "1"; }
		else if ($status[0] == "1" ) { $status[0] = "0"; }
		system("gpio write ".$pic." ".$status[0] );
		sleep(1);
		// reset gpio status
		exec ("gpio read ".$pic, $status, $return );
		if ($status[0] == "0" ) { $status[0] = "1"; }
		else if ($status[0] == "1" ) { $status[0] = "0"; }
		//reading pin's status
		exec ("gpio read ".$pic, $status, $return );
		//print it to the client on the response
		echo($status[0]);
		
	}
	else { echo ("fail"); }
} //print fail if cannot use values
else { echo ("fail"); }
?>