<!DOCTYPE html>

<html lang="hr">


<style>
#loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>


	<head>
		<?php
			include( 'funkcije.php' );
		?>
	    <title>Predsjedničke rezidencije</title>
	    <meta charset="UTF-8"/>
	   	<script src="detalji.js"></script>
	   	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
    integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="crossorigin=""></script>


	    <link rel = "stylesheet" type = "text/css"
	        title="Stil" href = "dizajn.css"/>

	</head>

	<body>
	    <div id="header">
	    	<a href="index.html">
	    		<img id="logo1" src="images/logo.jpg" alt="logo"/>
	    		<img id="logo2" src="images/logo.jpg" alt="logo"/>
	    	</a>
	        <h1 >Predsjedničke rezidencije</h1>
	    </div>
	    <div id = "body">

	    	<?php
					$dom = new DOMDocument();
					$dom->load('podaci.xml');
					$_rezidencije = $dom->documentElement;
					$rezidencije = $_rezidencije->getElementsByTagName('rezidencija');

					$xpath = new DOMXPath($dom);
					

					if(!empty($_REQUEST['ime'])){
						$rezidencije = ime($rezidencije, $_REQUEST['ime']);
						//echo $_REQUEST['ime'];
					}

					if(!empty($_REQUEST['drzava'])){
						
						$drzava = $xpath->query("/rezidencije/rezidencija/lokacija/drzava");
					}

					if(!empty($_REQUEST['grad'])){
						$rezidencije = grad($rezidencije, $_REQUEST['grad']);
					}

					if(!empty($_REQUEST['pbr'])){
						$rezidencije = adresa($rezidencije, $_REQUEST['pbr'], "pbr");
					}

					if(!empty($_REQUEST['ulica'])){
						$rezidencije = adresa($rezidencije, $_REQUEST['ulica'], "ulica");
					}

					if(!empty($_REQUEST['broj'])){
						$rezidencije = adresa($rezidencije, $_REQUEST['broj'], "broj");
					}

					if(!empty($_REQUEST['narucitelj'])){
						$rezidencije = narucitelj($rezidencije, $_REQUEST['narucitelj']);
					}

					if(!empty($_REQUEST['arhitekt'])){
						$rezidencije = arhitekt($rezidencije, $_REQUEST['arhitekt']);
					}

					if(!empty($_REQUEST['godina'])){
						$rezidencije = godina($rezidencije, $_REQUEST['godina']);
					}

					if(!empty($_REQUEST['predsjednik'])){
						$rezidencije = predsjednik($rezidencije, $_REQUEST['predsjednik']);
					}

					if(!empty($_REQUEST['drzava'])){
						$rezidencije = drzava($rezidencije, $_REQUEST['drzava']);
					}

					if(!empty($_REQUEST['velicina'])){
						$rezidencije = velicina($rezidencije, $_REQUEST['velicina']);
					}

					if(!empty($_REQUEST['brkat'])){
						$rezidencije = brkat($rezidencije, $_REQUEST['brkat']);
					}

					if(!empty($_REQUEST['multi'])){
						$rezidencije = stil($rezidencije, $_REQUEST['multi']);
					}
				


				?>


		    <div id ="nav">
			    <ul id = "navLista">
			      <li><a href="index.html">Početna</a></li>
			      <li><a href="obrazac.html">Pretraživanje</a></li>
			      <li><a href="podaci.xml">Podaci</a></li>
			      <li><a href="https://www.fer.unizg.hr/predmet/or">Otvoreno računarstvo</a></li>
			      <li><a href="http://www.fer.unizg.hr/">FER</a></li>
			      <li><a href="mailto:nt49878@fer.hr">Nikola Tomažin</a></li>
			    </ul>


			   <div id='detalji'>

			   		
			  
			   </div>

			   <div id="loader"></div>

			   			  

	    							   			  	    	<div id = "mapid"></div>



		    </div>


		    <div id="sredina">
		    	<div id = "slike">
			    	<img src="images/kremlin.jpg" alt = "Kremlin" style="width:33%"/>
			    	<img src="images/germ.jpg" alt = "Bellevue Palace" style="width:34%"/>
			    </div>
			    
			    <?php

			    	if(count($rezidencije) == 0){
			 					print_r("<h1>");
			 					print_r("Nažalost nema poklapanja.");
			 					print_r("</h1>");
			 					print_r("<a href = "."obrazac.html".">Povratak</a>");
			 				}
			 				else{
			 	?>

				<div id = "tablica" style = "width:85%; align:right; float:right;">
		  			<table>
			 			<tr>
			 				<th>Rezidencija</th>
			 				<th>Država</th>
			 				<th>Grad</th>
			 				<th>Predsjednik</th>
			 				<th>Sažetak</th>
			 				<th>Slika</th>	
			 				<th>Detalji</th>			 					


			 			</tr>
			 			<?php

			 				#foreach ($drzava as $key) {
			 				#	print_r($;
			 				#	break;
			 				#}

				 				foreach($rezidencije as $rezidencija){
				 					print_r("<tr onmouseover='promijeniBoju(this)' onmouseout='vratiBoju(this)'>");
				 					print_r("<td>");
				 					print_r($rezidencija->getAttribute('ime'));
				 					print_r("</td>");

				 					print_r("<td>");
				 					print_r($rezidencija->getElementsByTagName( 'lokacija' )->item(0)->getElementsByTagName('drzava')->item(0)->getElementsByTagName("*")->item(0)->nodeName);
				 					print_r("</td>");

				 					print_r("<td>");
				 					print_r($rezidencija->getElementsByTagName( 'lokacija' )->item(0)->getAttribute('grad'));
				 					print_r("</td>");

				 					print_r("<td>");
				 					print_r($rezidencija->getAttribute('trenutni_predsjednik'));
				 					print_r("</td>");
		 					


				 					print_r("<td>");
				 					$response =  json_decode(file_get_contents("https://en.wikipedia.org/api/rest_v1/page/summary/".$rezidencija->getAttribute('wiki')),true);
				 					print_r($response['extract']);
				 					print_r("</td>");



				 					print_r("<td>");
				 					$response =  json_decode(file_get_contents("https://en.wikipedia.org/api/rest_v1/page/summary/".$rezidencija->getAttribute('wiki')),true);
				 					$image_URL = $response['originalimage']['source'];
				 					print_r("<img class = \"thumb\" src = \"" . $image_URL . "\"/>");
				 					print_r("</td>");

/*				 					


				 				

*/

				 					print_r("<td>");
				 					#ime = urlencode($rezidencija->getAttribute('wiki'));
				 					#$naziv = '<input type="button" id="detalji" value="Više o..." onclick="komuniciraj(\''.$ime.'\')"/>';
				 					print_r('<input type="image" id="detalji" onclick="komuniciraj(this);show()" src="Info-button.png" height = "40"/>');
				 					print_r("</td>");


				 					print_r("</tr>");
				 				}
				 			}
			 			?>
			 		</table>
			 	</div>

			</div>


		</div>



		<div id = "footer">
	        @Autor : Nikola Tomažin
	    </div>  	

<script type="text/javascript">
	
	function promijeniBoju(red_tablice){
	red_tablice.style.backgroundColor= "#e6e6fa";
}

function vratiBoju(red_tablice){
	red_tablice.style.backgroundColor= "#f2f2f2";
}





function show(){
	
	function showMap() {
		document.getElementById('loader').style.visibility= 'hidden' ;

//		console.log("tu sam");
		var lat = document.getElementById("lat_nom").innerText;
		var lon = document.getElementById("lon_nom").innerText;

		var lat2 = document.getElementById("lat").innerText;
		var lon2= document.getElementById("lon").innerText;

		//console.log(nom);
		var lat1 = lat.split(' ');
		var lon1 = lon.split(' ');
		var lat3 = lat2.split(' ');
		var lon3 = lon2.split(' ');

		/*
	var map = L.map('mapid').setView([51.505, -0.09], 13);

   L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);


}	
    
    map.addLayer(layer_OSMStandard_0);

	layer_OSMStandard_0;
	console.log(lat1[0]);
	//console.log(lat[1]);
	var marker1 = L.marker([lat1[0], lon1[0]]).addTo(map);


	marker1.bindPopup('Koordinate: ' + '<br>' + lat1[0] + ', ' + lon1[0]).openPopup();
	var marker2 = L.marker([lat3[0], lon3[0]]).addTo(map);

	marker2.bindPopup('Koordinate: ' + '<br>' + lat3[0] + ', ' + lon3[0]).openPopup();

	const coordinates = [
		[lat1[0], lon1[0]],
		[lat3[0], lon3[0]]
	];
	//console.log(coordinates);

	const configObject = {
		color: 'red'
	};
	var polyline = L.polyline(coordinates, configObject).addTo(map);
	map.fitBounds(polyline.getBounds());

	*/
console.log(lat1);
var map = L.map('mapid').setView([lat1[0], lon1[0]], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);



	var marker1 = L.marker([lat1[0], lon1[0]]).addTo(map);
    marker1.bindPopup('Koordinate: ' + '<br>' + lat1[0] + ', ' + lon1[0]).openPopup();
	var marker2 = L.marker([lat3[0], lon3[0]]).addTo(map);

	marker2.bindPopup('Koordinate: ' + '<br>' + lat3[0] + ', ' + lon3[0]).openPopup();


	
	const coordinates = [
		[lat1[0], lon1[0]],
		[lat3[0], lon3[0]]
	];
	//console.log(coordinates);

	const configObject = {
		color: 'red'
	};
	var polyline = L.polyline(coordinates, configObject).addTo(map);
	map.fitBounds(polyline.getBounds());


}	







setTimeout(showMap, 4000);


	}




</script>
		</body>
	</html>