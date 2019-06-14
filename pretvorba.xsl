<?xml version="1.0"?>

<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">


<xsl:template match="/">
	<html xmlns="http://www.w3.org/1999/xhtml" lang="hr">
	<head>

	    <title>Predsjedničke rezidencije</title>
	    <meta charset="UTF-8"/>

	    <link rel = "stylesheet" type = "text/css"
	        title="Stil" href = "dizajn.css"/>

	</head>

	<body>

	    <div id="header">
	    	<a href="index.html">
	    		<img id="logo1" src="logo.jpg" alt="logo"/>
	    		<img id="logo2" src="logo.jpg" alt="logo"/>
	    	</a>
	        <h1 >Predsjedničke rezidencije</h1>
	    </div>
	    <div id = "body">
		    <div id ="nav">
			    <ul id = "navLista">
			      <li><a href="index.html">Početna</a></li>
			      <li><a href="obrazac.html">Pretraživanje</a></li>
			      <li><a href="podaci.xml">Podaci</a></li>
			      <li><a href="https://www.fer.unizg.hr/predmet/or">Otvoreno računarstvo</a></li>
			      <li><a href="http://www.fer.unizg.hr/">FER</a></li>
			      <li><a href="mailto:nt49878@fer.hr">Nikola Tomažin</a></li>
			    </ul>
		    </div>

		    <div id="sredina">
		    	<div id = "slike">
			    	<img src="kremlin.jpg" alt = "Kremlin" style="width:33%"/>
			    	<img src="germ.jpg" alt = "Bellevue Palace" style="width:34%"/>
			    </div>
				<div id = "tablica">
		  			<table>
			 			<tr>
			 				<th>Rezidencija</th>
			 				<th>Država</th>
			 				<th>Grad</th>
			 				<th>Predsjednik</th>
			 				<th>Godina kraja izgradnje</th>
			 				<th>Arhitekt</th>
			 				<th>Veličina u m^2</th>
			 			</tr>
			 			<xsl:for-each select = "rezidencije/rezidencija">
				 			<tr>
				 				<td><xsl:value-of select = "@ime"/></td>
				 				<td><xsl:value-of select = "name(lokacija/drzava/*)"/></td>
				 				<td><xsl:value-of select = "lokacija/@grad"/></td>
				 				<td><xsl:value-of select = "@trenutni_predsjednik"/></td>
				 				<td><xsl:value-of select = "izgradnja/razdoblje/@godina"/></td>
				 				<td>
				 					<xsl:for-each select = "izgradnja/arhitekt">
				 						<p><xsl:value-of select="."/></p>
				 					</xsl:for-each>
				 				</td>
				 				<td><xsl:value-of select = "name(izgradnja/velicina/*)"/></td>
				 			</tr>
			 			</xsl:for-each>
			 		</table>
			 	</div>


			</div>
		</div>

		<div id = "footer">
	        @Autor : Nikola Tomažin
	    </div>


		</body>
	</html>

</xsl:template>

</xsl:stylesheet>