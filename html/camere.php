<!DOCTYPE html>
<html>
<head>
	<title>Le Camere</title>
	<link rel="icon" type="image/ico" href="../images/icon.ico">

	<link rel="stylesheet" type="text/css" href="../css/camere.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">
	

</head>
<body>

<?php include "header.php"; ?> 


<div id="container">

<div class="camera1">

	<div class="column_info">
		<h1>Camera <em>Singola</em></h1>
		<ul>
			<li>Wi-fi</li>
			<li>bagno privato con doccia</li>
			<li>TV schermo piatto</li>
			<li>Aria condizionata</li>
		</ul>
	</div>


	<div class="column_photo">
		<div class="slideshow-container">

			<div class="mySlides1 fade">
			  <img src="../images/imageCamere/camera_singola.jpg" >
			</div>

			<div class="mySlides1 fade">
			  <img src="../images/imageCamere/camera_singola4.jpg" >
			</div>

			<div class="mySlides1 fade">
			  <img src="../images/imageCamere/camera_singola3.jpg" >
			</div>

			<a class="prev" onclick="plusDivs(-1,0)">&#10094;</a>
			<a class="next" onclick="plusDivs(1,0)">&#10095;</a>

		</div>
	</div>
</div>


<div class="camera2">
	<div class="column_photo">
		<div class="slideshow-container">
			<div class="mySlides2 fade" >
			  <img src="../images/imageCamere/camera_matrimoniale.jpg" >
			</div>

			<div class="mySlides2 fade">
			  <img src="../images/imageCamere/bagno.jpg" >
			</div>

			<a class="prev" onclick="plusDivs(-1,1)">&#10094;</a>
			<a class="next" onclick="plusDivs(1,1)">&#10095;</a>
		</div>
	</div>


	<div class="column_info">
		<h1>Camera <em>Matrimoniale</em></h1>
		<ul>
			<li>Wi-fi</li>
			<li>bagno privato con vasca idromassaggio</li>
			<li>TV schermo piatto</li>
			<li>Aria condizionata</li>
			<li>mini-frigo</li>
		</ul>
	</div>
</div>



<div class="camera3">

	<div class="column_info">
		<h1>Camera <em>Tripla</em></h1>
		<ul>
			<li>Wi-fi</li>
			<li>bagno privato con doccia</li>
			<li>TV schermo piatto</li>
			<li>Aria condizionata</li>
			<li>mini-frigo</li>
		</ul>
	</div>


	<div class="column_photo">
		<div class="slideshow-container">

			<div class="mySlides3 fade">
			  <img src="../images/imageCamere/camera_tripla2.jpg" >
			</div>

			<div class="mySlides3 fade">
			  <img src="../images/imageCamere/camera_tripla3.jpg" >
			</div>

			<div class="mySlides3 fade">
			  <img src="../images/imageCamere/camera_tripla.jpg" >
			</div>

			<a class="prev" onclick="plusDivs(-1,2)">&#10094;</a>
			<a class="next" onclick="plusDivs(1,2)">&#10095;</a>

		</div>
	</div>
</div>



</div>


<!-- script per gli slideshow-->

<script>
var slideIndex = [1,1,1];
var slideId = ["mySlides1", "mySlides2","mySlides3"]
showDivs(1, 0);
showDivs(1, 1);
showDivs(1,2);

// funzione per passare da un immagine all'altra

function plusDivs(n, no) {
  showDivs(slideIndex[no] += n, no);
}

// funzione per mostrare l'immagine attuale

function showDivs(n, no) {
  var i;
  var x = document.getElementsByClassName(slideId[no]);
  if (n > x.length) {
  	slideIndex[no] = 1;
  }
  if (n < 1) {
  	slideIndex[no] = x.length;
  }
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex[no]-1].style.display = "block";  
}
</script>

<?php include "../html/footer.html"; ?>

</body>
</html>


