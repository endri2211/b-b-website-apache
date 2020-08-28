<?php require_once "connectiondb.php";?>

<!DOCTYPE html>
<html>
<head>
	
	<title>Prenotazione</title>
	
	<meta name="author" content="gruppo9">
	<meta name="keywords" content="hotel,b&b,bedandbreakfast,soggiorno,san marzano sul sarno, pagani,campania,pompei,lastminute,offerte">
	<link rel="icon" type="image/ico" href="../images/icon.ico">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">
	<link rel="stylesheet" type="text/css" href="../css/prenotazione.css">
	<meta charset="utf-8">
	

</head>
<body>

	<?php include "header.php" ?> 


	<?php //Sticky form
		if(isset($_POST['dataArrivo']) and isset($_POST['dataPartenza'])){
			$dataArrivoSticky = $_POST['dataArrivo'];
			$dataPartenzaSticky = $_POST['dataPartenza'];
		}
		else{
			$dataPartenzaSticky = "";
			$dataArrivoSticky = "";
		}
	?>
	
	<div id="container">

		<div id="formPre">
			<form  method="POST" name="formPrenotazione" >

				<div id="checkIn" class="formP">
					<label for="dataArrivo" > Check-in </label>
					<input type="date" name="dataArrivo" id="dataArrivo" placeholder="aaaa-mm-gg" value="<?php echo $dataArrivoSticky ?>">
				</div>
				
				<div id="checkOut" class="formP">
					<label for="dataPartenza"> Check-out </label>
					<input type="date" name="dataPartenza" id="dataPartenza"placeholder="aaaa-mm-gg" value="<?php echo $dataPartenzaSticky ?>">
				</div>
				
				<div id="buttonForm" class="formP">
					<input type="button" class="buttonCss" value="Verifica disponibilità" onclick="verificaFormPrenotazione() " >
				</div>	

			</form>
		</div>
		<?php
			
			if(!empty($_POST["dataArrivo"])){
				$error_message="";
				$dataArrivo = $_POST["dataArrivo"];
				$dataPartenza = $_POST["dataPartenza"];
						
				//Otteniamo il numero di millisecondi dal 1 Gennaio 1970 
				$timeStampArrivo = strtotime($dataArrivo);
				$timeStampPartenza = strtotime($dataPartenza);
				$Oggi = date('Y-m-d'); 
				$timeStampOggi = strtotime($Oggi);
				
				//Otteniamo il numero di notti della prenotazione come intero		
				$data1 = date_create($dataArrivo);
				$data2 = date_create($dataPartenza);
				$diff = $data2->diff($data1)->format("%a");
				$diffDays= intval($diff);
						

				//Controlli lato Server
				if($timeStampArrivo < $timeStampOggi){
					$error_message = "Data arrivo non valida";
				}else if($timeStampPartenza < $timeStampArrivo){
							$error_message = "Data partenza non valida";
						}else{
							//Query per selezionare le camere disponibili nel periodo selezionato dall'utente
							$sql = "SELECT * 
					                FROM camere cam
					                WHERE not exists(SELECT *
									                 FROM prenotazioni pre                                                 
									                 WHERE cam.numero = pre.numeroCamera AND (pre.arrivo < '$dataPartenza' AND pre.partenza >  '$dataArrivo'));";
							$ret = pg_query($conn, $sql); 

							if(!$ret) {
								echo "ERRORE QUERY: " . pg_last_error($conn);
							}

							if(pg_num_rows($ret)!=0 ){
								echo "<p class=\"disponibilità\">Disponibilità dal " . date('d-m-Y',$timeStampArrivo) ." al " . date('d-m-Y',$timeStampPartenza)."</p>";

								echo "<form action=".$_SERVER['PHP_SELF']." method=\"POST\">";
								while($row = pg_fetch_array($ret)){
									$numeroCamera = $row['numero']; 
									$tipoCamera = $row['tipo'];
									$prezzoNotte = $row['prezzo'];
									//Prezzo totale della prenotazione di una singola camera
									$prezzo["$numeroCamera"] = ($prezzoNotte * $diffDays);

									$prezzoP = $prezzo["$numeroCamera"];
										
									echo "<p class=\"camDisponibile\">
										  
										  <label for=\"$numeroCamera\">
										  Camera: $numeroCamera, Tipo: $tipoCamera, Prezzo a notte: $prezzoNotte €, N° notti: $diffDays Totale: $prezzoP € 
										  </label>
										  
										  <input class=\"camere\" type=\"checkbox\" id=\"$numeroCamera\" name=\"camera[]\" value=\"$numeroCamera\"  onclick=\"
										  buttonPrenota()\">
												
										   </p>";
								}
								
								//dataArrivo_ ha un nome diverso da dataArrivo per non farlo rientrare in tutto questo if
								
								echo <<<_HTML
										<input type="hidden" name="dataArrivo_" id="dataArrivo_" value="$dataArrivo">
										<input type="hidden" name="dataPartenza_" id=\dataPartenza_" value="$dataPartenza" >
										<div id ="divCostoButton">
											<div id="divCostoTotale">Costo Totale:</div>
											<div id="costoTotale"> </div>
											<div id="divButtonPrenota"><input type="submit" class="buttonCss" value="Prenota" id = "ButtonPrenota" style="visibility: hidden" ></div>
										</div>
										</form>
									_HTML;

							}else{
								echo "<p class=\"disponibilità\"> Ci dispiace la disponibilità delle nostre camere è esaurita.</p>";
							}


						}
						if(!empty($error_message)){
						echo "<p>$error_message</p>";
					}
			}
		?>



		<?php 
		 if (!empty($_POST['camera'])) {
			 	
			$camere=$_POST['camera'];
			$dataArrivo = $_POST["dataArrivo_"];
			$dataPartenza = $_POST["dataPartenza_"];
			$utente =$_SESSION['id_utente'];
							
			$data1 = date_create($dataArrivo);
			$data2 = date_create($dataPartenza);
			$diff = $data2->diff($data1)->format("%a");
			$diffDays= intval($diff);

			foreach ($camere as $camera) {
				
				//calcoliamo il prezzo totale della prenotazione per una singola camera
				$sql1 = "SELECT prezzo FROM camere WHERE numero = $camera";
				$ret1 = pg_query($conn, $sql1);
				$row = pg_fetch_row($ret1);
				$prezzo = ($row[0])*$diffDays;
					
				$sql = "INSERT INTO prenotazioni(utente,arrivo,partenza,numeroCamera,prezzo) 
						VALUES($1, $2, $3, $4, $5)";
				$ret = pg_prepare($conn,"InsertPrenotazione$camera",$sql); 
				

				$ret = pg_execute($conn, "InsertPrenotazione$camera", array($utente,$dataArrivo,$dataPartenza,$camera,$prezzo));
				if(!$ret) {
					echo pg_last_error($conn); 
				} 
			}
			
			echo "<SCRIPT type=\"text/javascript\">
			   			alert(\"Prenotazione effettuata\"); 
			 	   </SCRIPT>";
		}
		?>

	</div>

<?php include "footer.html" ?>



<!--JAVASCRIPT-->
<script type="text/javascript">
	
	//Abilita il tasto prenota e calcola il totale della prenotazione
	function buttonPrenota(){ 
				
		var checkCamera = document.getElementsByClassName("camere");
		var costo = <?php echo json_encode($prezzo); ?>;
		var isCheck = false;
		var totale = 0;
				
		for(var i = 0; i < checkCamera.length; i++){
			if (checkCamera[i].checked){
				isCheck = true;
				var numCamera = checkCamera[i].getAttribute("value");
				totale += costo[numCamera];
			}
		}
		
		document.getElementById("costoTotale").innerHTML = totale + " €";

		var butPre = document.getElementById("ButtonPrenota");
			
		if(isCheck){
			butPre.style.visibility = "visible";
			<?php
				if(!isset($_SESSION['id_utente'])){
					echo " butPre.disabled = true;
						   butPre.onmouseover = alert(\" Per prenotare esegui il log-in oppure registrati \");";
				}
			?>
				
		}else {
			butPre.style.visibility = "hidden";
		}

	}

</script>

	<script type="text/javascript">
		//Effettua i controlli lato client prima di inviare la form
	function verificaFormPrenotazione() {
		var a = document.formPrenotazione.dataArrivo.value;
		var p = document.formPrenotazione.dataPartenza.value;

		if(a==""){
			alert("Inserire la data di arrivo");
		}else if(p==""){
					alert("Inserire la data di partenza");
				}else{ 
					//creazione array [0]aaaa-[1]mm-[2]gg
					var arrivo = a.split("-"); 
					var partenza = p.split("-");
				
					//ricaviamo la data odierna
					var data = new Date();
					var og = new Date(data.getFullYear(),data.getMonth(),data.getDate());

					//istanziamo oggetti date
					var ar = new Date(arrivo[0],arrivo[1]-1,arrivo[2]);
					var pa = new Date(partenza[0],partenza[1]-1,partenza[2]);

					//ricaviamo le variabili per il confronto
					var checkIn = ar.getTime(); 
					var checkOut = pa.getTime();
					var oggi = og.getTime();
				
		            //CONTROLLI
					if (checkIn < oggi){
						alert("Inserire una data di arrivo valida");
					}else if(checkIn >= checkOut){
							alert("Inserire una data di partenza valida");
						}else{
							document.formPrenotazione.action = "prenotazione.php";
							document.formPrenotazione.submit();
						}
			    }
	}
	</script>

</body>
</html>