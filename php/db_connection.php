<?php
//	$sqlusername="sql458992";
//	$sqlpassword="aX5%dR5*";
//	$sqlhost="sql4.freesqldatabase.com";
//	$sqlbaza="sql458992";

        $sqlusername="root";
	$sqlpassword="";
	$sqlhost="127.0.0.1";
	$sqlbaza="sql458992";

	@mysql_connect($sqlhost,$sqlusername,$sqlpassword) or die("Došlo je do problema prilikom konekcije na server.");
	@mysql_select_db($sqlbaza) or die("Došlo je do problema prilikom konekcije na bazu podataka.");
?>