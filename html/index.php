<!DOCTYPE html>


<html lang="it">
<head>
	<title>Home Page</title>
	<meta charset="utf-8">
	<meta name="author" content="gruppo9">
	<meta name="keywords" content="hotel,b&b,bedandbreakfast,soggiorno,san marzano sul sarno, pagani,campania,pompei,lastminute,offerte">
	<link rel="stylesheet" type="text/css" href="../css/index.css">
  <link rel="stylesheet" type="text/css" href="../css/header.css">
  <link rel="stylesheet" type="text/css" href="../css/footer.css">
	<link rel="icon" type="image/ico" href="../images/icon.ico">

</head>




<body>
  <!-- richiedo il file che contine lo script per la connsessione al database-->
	<?php require_once "connectiondb.php";?>

    <!--includo il file contente l'header-->
  <?php include 'header.php';?>

  <div class="slideshow-container">

  <!-- SliderShow  -->
    <div class="slides fade">
      <img src="../images/home1.jpg" style="width:100%">
      <div class="text"> La Struttura </div>
    </div>

    <div class="slides fade">
      <img src="../images/home2.jpg" style="width:100%">
      <div class="text">La Struttura</div>
    </div>

    <div class="slides fade">
      <img src="../images/home3.jpg" style="width:100%">
      <div class="text"> Pompei </div>
    </div>

   <div class="slides fade">
      <img src="../images/home4.jpg" style="width:100%">
      <div class="text">Pompei</div>
    </div>

    <div class="slides fade">
      <img src="../images/home5.jpg" style="width:100%">
      <div class="text"> Amalfi Coast</div>
    </div>
    
    <div class="slides fade">
      <img src="../images/home6.png" style="width:100%">
      <div class="text">Amalfi Coast</div>
    </div>
  </div>
    
    
  <div style="text-align:center">
    <span class="dot" ></span>
    <span class="dot" ></span>
    <span class="dot" ></span>
    <span class="dot" ></span>
    <span class="dot" ></span>
    <span class="dot" ></span>
  </div>


  
  <!---------DESCRIZIONE STRUTTURA-->
  <div class="presentation">
    <h1 class="title-container">La Struttura</h1>
    <p >
      Il B&B D'Avino è situato a San Marzano sul Sarno
      immerso nel verde<br>
      e poco distante dal centro cittadino. 
      Posizionato in una zona strategica,<br> 
      nelle vicinanze di lughi di interesse storico e culturale quali gli scavi di Pompei, <br>
      è ideale per chi vuole scappare dal caos cittadino.<br>
      Il giardino esterno alla struttura riservato agli ospiti offre<br> 
      l’opportunità di rilassarsi, passeggiare e ammirare tramonti all'ombra dei nostri alberi.<br>
      Le camere sono dotate di ogni comfort con angolo business per lavorare<br> 
      in piena tranquillità e totale riservatezza.<br>
      Inoltre tutte le camere hanno un bagno privato.<br>
      La struttura offre una ricca colazione continentale per tutti i palati.<br>
      Non manca un vasto parcheggio gratuito e custodito.<br> 
    </p>
  </div> 


  <!-----VISUALE DELLE MIGLIORI RECENSIONI----->
  <!-- queesta sezione della pagina web contiene un'anteprima 
  	delle  migliori recensioni lasciate dagli utenti e caricate sul db-->
  <div id="recensioni">
    <h1 class="title-container">Le vostre Recensioni</h1>
    <?php  
      $sql = "SELECT * FROM recensioni ORDER BY dd DESC"; 
      if (!($ret = pg_query($conn,$sql))) {  //controllo sull'avvenuta connesiona al db, in caso di problemi restituisce la strina contenente l'errore;
          echo "Errore Query" . pg_last_error($conn);
          exit;
      } else { 
          $count = 0; //variabile contatore poiche all'raggiungimento di quattro recensioni(in quanto è lo spazio dedicato alle recensioni ) che soddisfano i requisiti il ciclo while che estrae i dei dati dal db deve terminare; 
          while ($row = pg_fetch_array($ret)){
                //accesso all'array associativo 
          		$foto = $row["foto"]; 
                $nome = $row["nome"];
                $recensione = $row["recensione"];
                $star = $row["star"];
                $data = $row["dd"];
                if ($star ==="4"){ //criterio di selezione delle recensioni migliori 
                echo <<<_HTML
                      <div class="recens-container" id = "rec$count">
                          <img class = "acc_foto"src = "$foto">
                          <p class = "nomeRecensore"> " $nome "</p>
                          <p class = "recens" > $recensione </p>
                      _HTML;
                for ($i=0; $i < 5; $i++) { //ciclo utilizzato per stampare il voto della recensione 
                    echo <<<_HTML
                          <img class = "vote" src = "../images/star_fill.png" >
                        _HTML;
                }
                  echo <<<_HTML
                          <p class = "data" > $data </p> 
                      </div>
                      _HTML;
                $count ++; // il contatore viene incrementato solo se trova una recensione utile alla stampa
              }
              if ($count == 4){ //quando ne sono state stampate 4 esso si ferma 
                break;
              }
          }
      }
     ?>  
 
  </div>

    

  <!-- div per l'inserimento di una recensione sul database -->
  <div class="insert-container">
  	<h1 class="title-container">Lascia la tua Recensione</h1>
  	<form class="form_rec" method="POST" action="recensione.php">
 		    <input id="titolo" type="text" name="titolo" required="true" placeholder="Inserisci il Titolo " maxlength="30">
     		<textarea id="descrizione" name="descrizione" required="true" placeholder="Inserisci la tua Recensione " onkeyup="counter()" maxlength="180"></textarea>
     		<span id="char"><span id="caratteri">0</span>/180</span>
     		
        <div id="vote_rec">

     			<?php
    				for ($i=0; $i < 5; $i++) { 
    				  //utilizzo dello starrating per la valutazione della struttura 
    					echo <<<_HTML
                      <input style= "display:none" type="radio" id="check_star$i" value ="$i" name ="rate" required= "true">
                      <label style ="display:inline-block"for = "check_star$i" onclick="showstarfill($i)" >
                      <img class = "vote" id = "star$i" src = "../images/star_empty.png" >
                      </label> 
                      _HTML;
    				}
           		?>
        </div>
        
        <input id="carica_rec" type="submit" name="invio_rec" value="Invio" title ="Per inviare la tua recensione esegui il Log In" >

  	</form>
 	</div>
    <!-- la recensione può essere lasciata solamente da utenti registrati -->
  	<?php 
  		if(!isset($_SESSION['id_utente'])){
  			echo <<<_HTML
					<script>
					document.getElementById('carica_rec').disabled ="true";
					var notlogged = document.getElementById('titolo');
										notlogged.onclick  = function() {alertfunc()}
					
					function alertfunc(){
						alert("Per lasciare una recensione sei invitato ad eseguire il Log In.");
					}
					</script>
				_HTML;
      }else if(!isset($_SESSION['soggiorno'])){
        echo <<<_HTML
          <script>
          document.getElementById('carica_rec').disabled ="true";
          var notlogged = document.getElementById('titolo');
                    notlogged.onclick  = function() {alertfunc()}
          
          function alertfunc(){
            alert("Per lasciare una recensione devi aver pernottato nella nostra struttura.");
          }
          </script>
        _HTML;
      }
  	?>
    
  <script>
    // slide show temporizzato
    var slideIndex = 0;
    showSlides();
      
        function showSlides() {
         
          var i;
          var slides = document.getElementsByClassName("slides");
          var dots = document.getElementsByClassName("dot");
          for (i = 0; i < slides.length; i++) {
              slides[i].style.display = "none";  
          }
          for (i = 0; i < dots.length; i++) {
              dots[i].className = dots[i].className.replace(" active", "");
          }
          
          if (slideIndex>=slides.length){
              slideIndex=0;
          }
          slides[slideIndex].style.display = "block";  
          dots[slideIndex].className += " active";
          slideIndex++;
          setTimeout(showSlides,6000);

        }

      //funzione che in base alla votazione scelta alla Recensione, restitusce l'immagine di una stella fill or empty
    function showstarfill(n){
        for (var i=0; i<=n; i++){
          document.getElementById('star'+i).src = "../images/star_fill.png"; 
        }
        for (var i=(n+1); i<=4; i++){
          document.getElementById('star'+i).src = "../images/star_empty.png";
          
        }
    }

      //  conteggio dei caratteri della recensione 
  	function counter(){
      	var desc = document.getElementById('descrizione').value;
      	document.getElementById('caratteri').innerHTML = desc.length; 	
  	}
  	
  </script>

  <!--includo il file contenente il footer-->
  <?php include 'footer.html'?>

</body>
</html>

