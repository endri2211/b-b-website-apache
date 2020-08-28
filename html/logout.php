<?php
	session_start();
	$_SESSION = array(); //UNSET DI TUTTE LE VARIABILI DI SESSIONE 
	if (session_id() != "" || isset($_COOKIE[session_name()])){
		//CANCELLA IL COOKIE CHE MEMORIZZA l'ID della sessione sul client
		setcookie(session_name(), '', time() - 2592000, '/'); /* 3) */
		session_destroy(); //DISTRUGGE LA SESSIONE 
		header("Location: index.php");
	}
?>