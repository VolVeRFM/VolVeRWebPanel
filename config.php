<?php
	error_reporting(-1);
	
	$dblocation = "localhost";        // Имя сервера
	$dbuser = "volver_coin";          // Логин
	$dbpasswd = "I&5RBQ";             // Пароль
	$dbname  = "volver_coin";         // Имя базы    

	$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd); 
	
	if (!$dbcnx) 
	{
		  echo ("<P>Server unavailable</P>");
		  exit();
	}


	if (!@mysql_select_db($dbname, $dbcnx)) 
	{
		  echo( "<P>Server is not available now</P>" );
		  exit();
	}
	
	mysql_set_charset('utf8');
?>