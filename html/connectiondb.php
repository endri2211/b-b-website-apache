<?php
	require_once "../html/logindb.php"; //il file logindb che prepara la stringa di connessione viene richimato obbligatoriamente una sola volta 

	$conn = pg_connect($connection_string)or
	 	die('impossibile connettersi al database:'.pg_last_error);
	 //con pg_connect creo la connessione con il db
	 //in caso di errore viene stampata la stringa contentete l'errore 

  ?>