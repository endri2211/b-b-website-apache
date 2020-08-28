<!DOCTYPE html>
<html>
<head>
	<title>Registrazione</title>
	<meta charset="utf-8">
	<meta name="author" content="Gruppo9">
	<meta name="keywords" content="hotel,b&b,bedandbreakfast,soggiorno,san marzano sul sarno, pagani,campania,pompei,lastminute,offerte">
	<link rel="stylesheet" type="text/css" href="../css/registrazione.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">
	<link rel="icon" type="image/ico" href="../images/icon.ico">
</head>
<body>
	<?php include "header.php"?>

	<?php 
		if(isset($_SESSION['errorMessage'])){
			$name = $_SESSION['name'];
			$surname = $_SESSION['surname'];
			$email = $_SESSION['email'];
			unset($_SESSION['name']);
			unset($_SESSION['surname']);
			unset($_SESSION['email']);
		}else{
			$name = "";
			$surname = "";
			$email = "";
		}


	?>

  <div class="container">  	

  	<div class="form-box">
			<p class="title"><h3>Compilare i campi per effettuare la registrazione!</h3></p>

			<form name="form" onsubmit="return verificaModulo(this) " method="POST" action="registrazione_db.php" enctype="multipart/form-data" class="input-group">
				<div class="form-control">
					<label for="name">Nome</label>
					<input type="text" name="name" id="name" placeholder="Inserisci un nome" value="<?php echo $name?>" onfocus="resetControl()">
					<img src="../images/vero.png" id="check1" class="icon">
					<img src="../images/falso.png" id="exclamation1" class="icon">
					<span id="errorName"></span>
				</div>

				<div class="form-control">
					<label for="surname">Cognome</label>
					<input type="text" name="surname" id="surname" placeholder="Inserisci un cognome" value="<?php echo $surname?>" onfocus="resetControl()">
					<img src="../images/vero.png" id="check2" class="icon">
					<img src="../images/falso.png" id="exclamation2" class="icon">
					<span id="errorSurname"></span>
				</div>

				<div class="form-control">
					<label for="email">E-mail</label>
					<input type="email" name="email" id="email" placeholder=".....@email.com" value="<?php echo $email ?>" onfocus="resetControl()">
					<img src="../images/vero.png" id="check3" class="icon">
					<img src="../images/falso.png" id="exclamation3" class="icon">
					<span id="error_email"></span>
				</div>

				<div class="form-control">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" placeholder="********"onfocus="resetControl()">
					<input type="button" class="bottone" id="botton1" onclick="showPassword()" value="Mostra">
					<img src="../images/vero.png" id="check4" class="icon">
					<img src="../images/falso.png" id="exclamation4" class="icon">
					<span id="errorPass"></span>
				</div>

				<div class="form-control">
					<label for="conf_pass">Conferma Password</label>
					<input type="password" name="conf_pass" id="conf_pass" placeholder="********"onfocus="resetControl()">
					<input type="button" id="botton2" class="bottone" onclick="showPassword2()" value="Mostra">
					<img src="../images/vero.png" id="check5" class="icon">
					<img src="../images/falso.png" id="exclamation5" class="icon">
					<span id="error_confpass"></span>
				</div>

				<div class="form-control">
					<label for="profileImg">Immagine del Profilo</label>
					<input type="file" name="profileImg" id="profileImg" class="input-field" accept="image/*">
				</div>

				<div class="form-control">
					<label for="consenso"><small>
						Do il consenso per il trattamento dei dati: <input type="checkbox" name="consenso" id="consenso" required>
						<a href="https://protezionedatipersonali.it/informativa" target="_blang">Informativa sulla privacy</a></small>
					</label>
				</div>
				<button type="submit" class="registrati">Registrati</button>
			</form>
		</div>

<script type="text/javascript">

	 	//script per mostrare o nascondere password
		function showPassword(){
			var input = document.getElementById('password');
			var button = document.getElementById('botton1')
			if(input.type == "text"){
				input.type = "password";
				button.value = "Mostra";
			}
			else{
				input.type = "text";
				button.value = "Nascondi";
			}
		}
	

		//script per mostrare o nascondere password
		function showPassword2(){
			var input = document.getElementById('conf_pass');
			var button = document.getElementById('botton2')
			if(input.type == "text"){
				input.type = "password";
				button.value = "Mostra";
			}
			else{
				input.type = "text";
				button.value = "Nascondi";
			}
		}
	
	 //verifica modulo prima di inviarlo
		function verificaModulo(form){
			var i = 0;
			var nome = document.getElementById('name');
			var cognome = document.getElementById('surname');
			var e_mail = document.getElementById('email');
			var pass = document.getElementById('password');
			var confpass = document.getElementById('conf_pass');

			if(nome.value == ""){ //controllo sul nome
				var error_Name= document.getElementById('errorName');
				var image = document.getElementById('exclamation1');
				error_Name.style.visibility = "visible";
				error_Name.textContent = "Non hai inserito il nome!";
				nome.style.border = "2px solid red";
				image.style.visibility = "visible";
				i = ++i;
			}else{
				var image = document.getElementById('check1');
				var im = document.getElementById('exclamation1');
				nome.style.border = "2px solid green";
				image.style.visibility = "visible";
				im.style.visibility = "hidden";
			}

			if(cognome.value == "") { //controllo cognome 
				var error_Surname = document.getElementById('errorSurname');
				var image2 = document.getElementById('exclamation2');
				error_Surname.style.visibility = "visible";
				error_Surname.textContent = "Non hai inserito il cognome!";
				cognome.style.border = "2px solid red";
				image2.style.visibility = "visible";
				i = ++i;
			}else{
				var image2 = document.getElementById('check2');
				var im = document.getElementById('exclamation2');
				cognome.style.border = "2px solid green";
				image2.style.visibility = "visible";
				im.style.visibility = "hidden";
			}

			if(e_mail.value == ""){ //controllo email
				var err_email = document.getElementById('error_email');
				var image3 = document.getElementById('exclamation3');
				err_email.textContent = "Non hai inserito l'email!";
				err_email.style.visibility = "visible";
				e_mail.style.border = "2px solid red";
				image3.style.visibility = "visible";
				i = ++i;
			}else{
				var image3 = document.getElementById('check3');
				var im = document.getElementById('exclamation3');
				e_mail.style.border = "2px solid green";
				image3.style.visibility = "visible";
				im.style.visibility = "hidden";
			}

			if(pass.value == ""){ //controllo password vuota
				var error_pass = document.getElementById('errorPass');
				var image4 = document.getElementById('exclamation4'); 
				error_pass.textContent = "Non hai inserito la password!";
				error_pass.style.visibility = "visible";
				pass.style.border = "2px solid red";
				image4.style.visibility = "visible";
				i = ++i;
			}else if(pass.value.length < 8){ //controllo password minore di 8 caratteri
				var error_pass = document.getElementById('errorPass');
				var image4 = document.getElementById('exclamation4'); 
				error_pass.textContent = "La password deve essere lunga almeno 8 caratteri";
				error_pass.style.visibility = "visible";
				pass.style.border = "2px solid red";
				image4.style.visibility = "visible";
				i = ++i;
			}else{
				var image4 = document.getElementById('check4');
				var im = document.getElementById('exclamation4');
				pass.style.border = "2px solid green";
				image4.style.visibility = "visible";
				im.style.visibility = "hidden";
			}

			if(confpass.value == ""){ //controllo conferma password vuoto
				var err_conf_pass = document.getElementById('error_confpass');
				var image5 = document.getElementById('exclamation5');
				err_conf_pass.textContent = "Non hai inserito nuovamente la password!";
				err_conf_pass.style.visibility = "visible";
				confpass.style.border = "2px solid red";
				image5.style.visibility = "visible";
				i = ++i;
			}else if(confpass.value.length < 8){ //controllo password minore di 8 caratteri
				var err_conf_pass = document.getElementById('error_confpass');
				var image5 = document.getElementById('exclamation5'); 
				err_conf_pass.textContent = "La password deve essere lunga almeno 8 caratteri";
				err_conf_pass.style.visibility = "visible";
				confpass.style.border = "2px solid red";
				image5.style.visibility = "visible";
				i = ++i;
			}else if(!(confpass.value == pass.value)){ //controllo se pass e confpass sono uguali
				var err_conf_pass = document.getElementById('error_confpass');
				var image5 = document.getElementById('exclamation5');
				err_conf_pass.textContent = "Non hai inserito la stessa password!";
				err_conf_pass.style.visibility = "visible";
				confpass.style.border = "2px solid red";
				image5.style.visibility = "visible";
			}else{
				var image5 = document.getElementById('check5');
				var im = document.getElementById('exclamation5');
				confpass.style.border = "2px solid green";
				image5.style.visibility = "visible";
				im.style.visibility = "hidden";
			}
			if (i > 0) {
				return false;
			}else{
				return true;
			}

		}

		function resetControl(){
			var nome = document.getElementById('name');
			var cognome = document.getElementById('surname');
			var e_mail = document.getElementById('email');
			var pass = document.getElementById('password');
			var confpass = document.getElementById('conf_pass');
			var error_Name= document.getElementById('errorName');
			var error_Surname = document.getElementById('errorSurname');
			var err_email = document.getElementById('error_email');
			var error_pass = document.getElementById('errorPass');
			var err_conf_pass = document.getElementById('error_confpass');
			for(i = 1; i<=5 ; i++){
				img = 'exclamation'+i;
				ck = 'check'+i;
			var im = document.getElementById(img);
			var image = document.getElementById(ck);
				im.style.visibility = "hidden";
				image.style.visibility = "hidden";
			}
				error_Name.style.visibility = "hidden";
				nome.style.border = "";
				error_Surname.style.visibility = "hidden";
				cognome.style.border = "";
				error_email.style.visibility = "hidden";
				email.style.border = "";
				error_pass.style.visibility = "hidden";
				pass.style.border = "";
				err_conf_pass.style.visibility = "hidden";
				confpass.style.border = "";
				
		}
	</script>

</div>

<?php
  if(isset($_SESSION['errorMessage'])){
		$msg = $_SESSION['errorMessage'];
		//echo "$msg";
		echo "<script>
		alert(\"$msg\");
		</script>";

		unset($_SESSION['errorMessage']);
	}
	?>

  <?php include "footer.html" ;?>
</body>
</html>