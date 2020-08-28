<?php
	require_once "connectiondb.php";

	$name = ucfirst($_POST["name"]);
	$surname = ucfirst($_POST["surname"]);
	$email = ($_POST["email"]);
	$password = $_POST["password"];
	$conf_pass = $_POST["conf_pass"];
    $name_file = $_FILES['profileImg']['name'];
    
    if($name_file == ""){
    	$name_file = "default_acc.png";
    }else{
        $fileTMP = $_FILES['profileImg']['tmp_name'];
        $folder="../images/";
        move_uploaded_file($fileTMP, $folder.$name_file);
    }

    $name_file = "../images/".$name_file;

    //VALIDAZIONE FORM PHP
    $errorMessage = "";
    $query = "SELECT email FROM utente WHERE email='$email'";
   	$ret = pg_query($conn, $query);

    if(empty($email)){
            //email non inserito
            $errorMessage = "Non hai inserito l'email!";            
        }

	else if(pg_num_rows($ret) != 0){
		$errorMessage = "L'email è già presente!";
	}
    else if(empty($name)){
       //nome non inserito
       $errorMessage = "Non hai inserito il nome!";
            
        }
        else if(empty($surname)){
        	$errorMessage = "Non hai inserito il cognome";
        	
        }
        else if(empty($password)){
        	$errorMessage = "Non hai inserito la password";
        	        }
        else if(empty($_POST['conf_pass'])){
        	$errorMessage = "Non hai inserito nuovamente la password";
        	
        }
        else if(!($password == $conf_pass)){
        	$errorMessage = "Le password non coincidono!";
        }

 else{
 	$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
	$sql = "INSERT INTO utente(nome, cognome, email, password, immagine_profilo) 
			VALUES($1, $2, $3, $4, $5)";
					
	$ret = pg_prepare($conn,"InsertUtente",$sql); 
	if(!$ret) {
			echo pg_last_error($conn);
			exit;
		} 
			
				
		$ret = pg_execute($conn, "InsertUtente", array($name, $surname, $email, $password, $name_file));
		if(!$ret){
			echo pg_last_error($conn);
			exit;
			}
			pg_close($conn);
			header('Location: registrazione_success.php');
	}

	if(!empty($errorMessage)){
		session_start();
		$_SESSION['errorMessage'] = $errorMessage;
        $_SESSION['name'] = $name;
        $_SESSION['surname'] = $surname;
        $_SESSION['email'] = $email;
		header("Location: registrazione.php");
	}

?>