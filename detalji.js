var req; // deklarirana globalna varijabla
function komuniciraj(button) {

	var row = button.parentNode.parentNode;

	console.log(row.cells[0].innerHTML);

	var ime  = row.cells[0].innerHTML;

	var url = encodeURI("detalji.php?ime=" + ime +"&show=simple");
	console.log(url);
	 if (window.XMLHttpRequest) { // FF, Safari, Opera, IE7+
	 	req = new XMLHttpRequest(); // stvaranje novog objekta
	 } else if (window.ActiveXObject) { // IE 6+
	 	req = new ActiveXObject("Microsoft.XMLHTTP"); //ActiveX
	 }
	 if (req) { // uspješno stvoren objekt
		 req.onreadystatechange = doSomething;
		 req.open("GET", url, true); // metoda, URL, asinkroni način
		 req.send(null); //slanje (null za GET, podaci za POST)
		 document.getElementById("detalji").innerHTML = "processing...";
		 document.getElementById('loader').style.visibility= 'visible' ;

	 }

}


function doSomething(){
	if (req.readyState == 4) { // primitak odgovora
	 	if (req.status == 200) { // kôd statusa odgovora = 200 OK
	 		
	 		document.getElementById('detalji').innerHTML = req.responseText;
	 		//document.getElementById()



	 	} else { // kôd statusa nije OK
	 	alert("Nije primljen 200 OK, nego:\n" + req.statusText);
	 	}
	}
}


