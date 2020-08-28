<?php
	require_once "connectiondb.php";

	session_start();
	if(isset($_SESSION['id_utente'])){
		$recensione = "<p><b>" . ucfirst($_POST['titolo']). "</b></p>" . ucfirst($_POST['descrizione']);
		$rate = $_POST['rate']; 
		$foto = $_SESSION['foto_utente'];
		$user = $_SESSION['nome_utente'];
		$email =$_SESSION['email'];
		$result = pg_prepare($conn, "InsertRecensione", 'INSERT INTO Recensioni(email,Nome,recensione,star,foto) VALUES ($1, $2,$3,$4,$5);');
		$result = pg_execute($conn, "InsertRecensione", array($email, $user, $recensione,$rate,$foto));
		if ($result){
			$_SESSION['recensione'] = "1";//SETTO UNA VARIABILE FLAG PER AVVENUTA RECENSIONE 
			pg_close($conn);
			header("Location:index.php");
		}else {
			pg_last_error();
			exit;
		}
		
	}
  ?>