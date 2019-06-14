			  

			   	<?php
			   			//print_r("tu sam");
			   			//
			   			sleep(2);

			   			/*print_r( "<script type='text/javascript'>
				            document.getElementById('loader').style.visibility= 'hidden' ;
				            </script>
				        ");
				        */
			   			header('Content-Type: text/html; UTF-8');
			   			$ime = $_REQUEST['ime'];
			   			$dom = new DOMDocument();
			   			$dom->load("podaci.xml");
			   			$xp = new DOMXPath($dom);
			   			$rezidencije = $xp->query('/rezidencije/rezidencija');
			   			foreach ($rezidencije as $rezidencija) {
			   				# ...
				   			if ($rezidencija->getAttribute('ime')==$ime){
				 			print_r("<div id ='tablica'><table ><tr>");
				 			print_r("<td>Godina kraja izgradnje</td>");		 				
							print_r("<td>");
					 		print_r($rezidencija->getElementsByTagName( 'izgradnja' )->item(0)->getElementsByTagName('razdoblje')->item(0)->getAttribute('godina'));
					 		print_r("</td>");
				 			print_r("</tr>");


				 			print_r("<tr>");
				 			print_r("<td>Arhitekt</td>");		 				
							print_r("<td>");
					 		print_r($rezidencija->getElementsByTagName( 'izgradnja' )->item(0)->getElementsByTagName('arhitekt')->item(0)->nodeValue);
					 		print_r("</td>");

					 		
				 			print_r("</tr>");


				 			print_r("<tr>");
				 			print_r("<td>Veličina u m^2</td>");		 				
							print_r("<td>");
					 		print_r($rezidencija->getElementsByTagName( 'izgradnja' )->item(0)->getElementsByTagName('velicina')->item(0)->getElementsByTagName("*")->item(0)->nodeName);
					 		print_r("</td>");

					 		/*
				 			print_r("</tr>");


				 			print_r("<tr>");
				 			print_r("<td>Lokacija</td>");		 				
							print_r("<td>");
					 		$response =  file_get_contents("https://en.wikipedia.org/w/api.php?action=query&prop=revisions&rvprop=content&rvsection=0&titles=".$title.$rezidencija->getAttribute('wiki')."&format=json");
					 					#print($response);
					 					#preg_match_all('/\[\[[^\]]*\]\]/', $response, $polje);
					 					#print_r($polje);
					 					$pos1 = strpos($response, "address");
					 					$pos2 = strpos($response, '\n', $pos1 + strlen("address"));
	                                    $lok = substr($response, $pos1+strlen("address"), $pos2-$pos1-strlen("address"));
	                                    
	                                    if (strlen($lok)>300){
	                                    	$pos1 = strpos($response, "location");
					 						$pos2 = strpos($response, '\n', $pos1 + strlen("location"));
	                                    	$lok = substr($response, $pos1+strlen("location"), $pos2-$pos1-strlen("location"));
	                                    }
	                                    if (strlen($lok)>300)
	                                    	print_r("ne mogu pristupit");
	                                    else{
		                                    $lok = parsiraj($lok);
						 					print_r($lok);
					 					}
					 		print_r("</td>");

					 		
				 			print_r("</tr>");


*/

				 			print_r("<tr>");
				 			print_r("<td>Lokacija nominatim</td>");		 				
							print_r("<td>");
					 		ini_set('user_agent', 'nikola.tomazin@fer.hr');
					 					$location = str_replace('_',' ',$rezidencija->getAttribute('wiki'));
					 					$nominatim = 'http://nominatim.openstreetmap.org/search?q=' .urlencode($location)  . '&format=xml';
					 					#user_agent
					 					#print_r($nominatim);
					 					$simplexml = simplexml_load_file($nominatim);
	                                    $json = json_encode($simplexml);
	                                    $xml = json_decode($json, TRUE);


										print_r("<div id = 'lat_nom'>".$xml['place'][0]['@attributes']['lat']."</div> \n");
					 					print_r("<div id = 'lon_nom'>".$xml['place'][0]['@attributes']['lon']."</div>\n");
					 					//print_r(number_format($xml['place'][0]['@attributes']['lat'],2)." \n");
					 					//print_r(number_format($xml['place'][0]['@attributes']['lat'],2)."\n");

	
					 					
	

					 		print_r("</td>");
					 		print_r("</tr>");




					 		print_r("<tr>");
				 			print_r("<td>Lokacija</td>");		 				
							print_r("<td>");
					 		ini_set('user_agent', 'nikola.tomazin@fer.hr');
					 					$response =  json_decode(file_get_contents("https://en.wikipedia.org/api/rest_v1/page/summary/".$rezidencija->getAttribute('wiki')),true);
					 					$lat = $response['coordinates']['lat'];
					 					$lon = $response['coordinates']['lon'];
					 					print_r("<div id = 'lat'>".$lat."</div>");
					 					print_r("<div id = 'lon'>".$lon."</div>");

	
					 					
	

					 		print_r("</td>");
					 		print_r("</tr>");


				 			



					 		print_r("<tr>");
					 		print_r("<td>Temperatura</td>");
				 			print_r("<td>");

				 			//https://samples.openweathermap.org/data/2.5/find?q=Zagreb&units=metric&appid=b6907d289e10d714a6e88b30761fae22
				 					$nesto = "https://api.openweathermap.org/data/2.5/weather?q=".urlencode($rezidencija->getElementsByTagName( 'lokacija' )->item(0)->getAttribute('grad')).",&units=metric&appid=b83ad63bccbaff27735e0d17bdadb99c";
				 					//print_r($nesto);
				 					$response =  json_decode(file_get_contents($nesto),true);
				 					print_r($response["list"][0]["main"]["temp"]);
				 					
				 			print_r("</td>");
							print_r("</tr>");


				 			print_r("<tr>");
					 		print_r("<td>Prognoza</td>");
				 			print_r("<td>");

				 			//https://samples.openweathermap.org/data/2.5/find?q=Zagreb&units=metric&appid=b6907d289e10d714a6e88b30761fae22
				 					$nesto = "https://api.openweathermap.org/data/2.5/weather?q=".urlencode($rezidencija->getElementsByTagName( 'lokacija' )->item(0)->getAttribute('grad')).",&units=metric&appid=b83ad63bccbaff27735e0d17bdadb99c";
				 					//print_r($nesto);
				 					$response =  json_decode(file_get_contents($nesto),true);
				 					print_r($response["weather"][0]["main"]);
				 					
				 					print_r("</td>");


							print_r("</tr></table></div>");
							echo '<script type="text/javascript">',
							     'showMap();',
							     '</script>'
							;

				 		}
			 	}

			 		?>	

			 		