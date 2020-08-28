<?php  
 	require_once "connectiondb.php";
 	//LEGGO I VALORI PASSATI TRAMITE METODO POST 
 	$email = $_POST["email"];
 	$pwd  =  $_POST["password"];
 	//VERIFICO SE I DATTI TROVANO RISCONTRO SUL DATABASE 
 	$sql= "SELECT id, nome , email, password, immagine_profilo FROM utente WHERE email = '$email' ";
 	$ret = pg_query($conn, $sql);
 	if (!$ret){
 		echo "Errore Query ". pg_last_error($conn);
 		exit;
 	}else {
 		//IN CASO POSITIVO AVVIO LA SESSIONE E SALVO TUTTI I DATI IN ESSA 
 		$row = pg_fetch_array($ret);
 		if((pg_num_rows($ret) == 1) &(password_verify ($pwd , $row['password'] ))){
 			session_start();
 			$_SESSION['id_utente'] = $row['id'];
 			$id_utente = $_SESSION['id_utente'];
 			$_SESSION['nome_utente'] = $row['nome'];
 			$_SESSION['foto_utente'] = $row['immagine_profilo'];
 			$_SESSION['email'] = $email;
 			$sql = "SELECT id FROM prenotazioni WHERE utente = $id_utente AND partenza <= current_date ";
 			$ret = pg_query($conn, $sql );
 			if (!$ret){
		 		echo "Errore Query ". pg_last_error($conn);
		 		exit;
		 	}else if(pg_num_rows($ret) != 0 ){
		 		$_SESSION['soggiorno'] = "TRUE";//se la variabile di sessione viene settata cio indica che l'utente ha gia soggiornato nella struttura 
		 	}
		 	pg_close($conn);
 			header("Location:index.php");//REDIRECTING
 		} else {
 			//IN CASO CONTRARIO AVVIO LA SESSIONE PER RESTITUIRE ALLA HOMPAGE L'ERORE DI AUTENTICAZIONE 
 			session_start();
 			$_SESSION['email'] = $email;
 			$_SESSION['error'] = "1";
 			pg_close($conn);
 			header("Location:index.php");
 		}
 	}
 	
?>