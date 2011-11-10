<?php
echo '[loaded] mysql_connect<br/>';
echo 'Connected as: '.$user.' on '.$database.'<br/>';
mysql_connect( $server,$user,$password);
if ($encodage=="utf-8") mysql_query("SET NAMES utf8;");
@mysql_select_db($database) or die( "Unable to select database");
//à préciser lorsqu'on est sur sciencemapping.com
if ($user!="root") mysql_query("SET NAMES utf8;");

$adresse_root= $_SERVER['DOCUMENT_ROOT'];
?>
