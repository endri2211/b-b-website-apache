
<!-- verifico se la sessione esiste,
nel caso in cui $_SESSION['id_utente'] non è settata significa che l'utente non 
ha effettuato il log in o comunque si sia stato qualche errore.
In caso contrario, l'utente ha effettuato correttamente il login.  -->
 <?php
  	session_start();
    if(!(isset($_SESSION['id_utente']))){
		$state  = "Log In";
		if(isset($_SESSION['error'])){
			$email = $_SESSION['email'];// nel caso di errore salvo la variabile email per 
										//conservarla nella stickyform
		}else {
			$email  = "";
		}
    }else{

    	$state = $_SESSION['nome_utente'];
    	if(isset($_SESSION['recensione'])){ // nel caso in cui è settata la variabile cio significa che ho appena lasciato una recesnione e il messaggio di alert mi avverte della corretta consegna di essa.
			echo <<<_HTML
					<script>
					alert("Recensione caricata con successo!");
					</script>;
					_HTML;
			unset($_SESSION['recensione']); //a questo punto si ha l'unset della variabile in quanto il suo scopo è terminato 
    	}
    }
  ?> 


<script type="text/javascript">


	
</script>

  
<header>

	<!--------LOGO DEL SITO------>
	<div class="logo">
		<a href="../html/index.php"><img id="logo" type="image/png" src="../images/logo_nav/cover.png"></a>
	</div>


	<!-----BARRA DI NAVIGAZIONE----->
	<nav class="navbar">
		<a class="bar" id="home" href="index.php">Home</a>
		<a class="bar" id="camere" href="camere.php">Le Camere</a>
      	<a class="bar" id="prenotazione" href="prenotazione.php">Prenotazione</a>
		<a class="bar" id="contatti" href="contatti.php">Contatti</a>	
		<?php  		
			if (!isset($_SESSION['id_utente'])){
				echo <<<_HTML
						<a class="bar" id="registrati" href="registrazione.php" >Registrati</a>
						_HTML;
			}
		?>

		<button class="access" id="login" name  ="login" onclick="showLoginForm(),showLogOutForm()"   ><?php echo $state?></button>  
		<!-- $state sarà uguale al nome dell'utente in caso di login effettuato -->
	</nav>

	<!------- LOG IN FORM -------->
	<!--div utile per generare la freccia di puntamento della login_form-->
	<div class="freccia" id="freccia" style="display: none"></div>
	

	<!--la login_form è nascosta, viene visualizzata all'atto di click sul button con id ="access -->	
	<div class="_form" id="login_form" style="display: none" >	
				
		<!--nella form vi sono tre fieldset per separare la parte dell'inserimento dati(id="inputs") 
			dalla parte di invio dei dati(id="action")-->
		<form id= "loginForm" method="POST" action="login.php" >
			<fieldset id="inputs">
				<input id="user" type="email" name="email" required placeholder="Inserisci l'email" autocomplete="true" onfocus="errorMessage()"
				
				 	value = <?php 
				 				if(isset($_SESSION['error'])){ //in caso di errore mi sarà mostrata solo per una volta l'ultima mail con cui si è tentato l'accesso
				 					echo $email;
				 					unset($_SESSION['email']);
				 				}
				 			?>
							>
				<input id="pwd" type="password" name="password" placeholder="Password" onfocus ="errorMessage()" required>
				<!-- questo div sarà visibile sono in caso in cui il login vada in errore -->
				<div id="pwd_or_email_error" style="visibility: hidden;margin-top: 15px;">
					Email o Password Errati !
				</div>
				
			</fieldset>

			<fieldset id="action">
				<input type="submit" id="subLogIn" name="start_s" value="Log In" >
			</fieldset>
		</form>


	</div>

	<!----------- LOG OUT FORM  ------------>

	<div class = "_form" id="logout_form" style="display: none" >
		
		<?php 
			if(isset($_SESSION['id_utente'])){
				echo <<<_HTML
						<img class = "acc_foto_out"src = "
					
						_HTML;
				if($_SESSION['foto_utente'] == "../images/default_acc.png"){
					echo "../images/default_acc_red.png";
				}else{
					echo $_SESSION['foto_utente'];
				}
				echo <<<_HTML
						">
						<b style ="font-size : 20px"> Benvenuto &nbsp
						_HTML;
				echo $_SESSION['nome_utente'];
				echo "</b>";
			}
		?>

		<form method="POST" action="logout.php">
			<input type="submit" id="subLogOut" name="close_s" value="Log Out" >
		</form>

	</div>



	<!-- script eseguit nel caso di click sul button per effettuare il logout  -->
	<script type="text/javascript">

		// 	 script utilizzato per mostrare o meno la finsetra di login 
		// richiamta al click del button nella navbar "LogIn" 

		function showLoginForm(){
			var logform = document.getElementById("login_form");
			var arrow = document.getElementById("freccia");
			<?php if($state === "Log In"){ ?>
				if ((logform.style.display === "block")&(arrow.style.display === "block")){
					logform.style.display = "none";
					arrow.style.display = "none";	

				} else {
					logform.style.display = "block";
					arrow.style.display = "block";
				}
			
			<?php } ?>
		}

		

		function showLogOutForm(){
			var outform = document.getElementById("logout_form");
			var arrow = document.getElementById("freccia");
				<?php 
				if(!($state === "Log In")){ ?>
					if ((outform.style.display === "none")&(arrow.style.display === "none")){
						arrow.style.display = "block";
						outform.style.display = "block";
					} else{
						outform.style.display = "none";
						arrow.style.display = "none";
					}
				<?php } ?>
		}
		
		
		//js che nasconde il codice di errore dopo la prima visualizzazione 
		function errorMessage(){
			document.getElementById("pwd_or_email_error").style.visibility = "hidden";
			document.getElementById("subLogIn").style.marginTop = "0px";
		}


		// NEL CASO IN CUI VI SIA UN ERRORE DI EUTENTICAZIONE 
		// MOSTRA IL CONTENUTO DI UN DIV NASCOSTO E MOSTRA LA FINESTRA DI LOGIN 
		// ALLA FINE UNSET DELLA VARIBILE DI SESSIONE 
		<?php 
			if(isset($_SESSION['error'])){
					?>
				document.onload = showLoginForm();
				document.getElementById("pwd_or_email_error").style.visibility = "visible";
				document.getElementById("subLogIn").style.marginTop="16px";

		<?php 	
				unset($_SESSION['error']);
			} 
		?>
 		

	</script>
								
</header>