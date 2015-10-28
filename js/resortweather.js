/*$(document).ready(function() {
			 
			$.ajax({
				type: "POST",
				url: "./modules/resortweather/resortweather_getData_ajax.php",
				data: {resort : 'uac=87pCXsmTJU&uref=b744c427-18f9-4217-b760-05173aab737f'},
				dataType: "json",
				success: function( data ) {
					//affichage date
					console.log(data);
						var day0 = data.weather.forecast[0];
						var day1 = data.weather.forecast[1];
						var wind0 = day0.day[0].wind[0];
						var wind1 = day1.day[0].wind[0];
						var date0 = day0.date.split('-');
						var date1 = day1.date.split('-');
						var desc_img = checkWeather(element.day[0].weather_code);
						var wind_dir = wind_el.dir_degree;
						$('#meteo').append('<div class="col-md-2 one_meteo"><div class="date">Météo du '+date[2]+' '+date[1]+' '+date[0]+'</div><div class="meteo_icon" data-icon="'+desc_img.img+'"></div><div class="weather_text">'+desc_img.desc+'</div><div class="temp">Min : '+element.night_min_temp +'°'+ element.temp_unit + ' / Max : ' + element.day_max_temp +'°'+ element.temp_unit + '<div class="wind_div"><div class="wind'+nb_day+' vent"><em class="icon-long-arrow-up"></em></div><div class="wind_speed">'+ wind_el.speed+wind_el.wind_unit+'</div></div>');
						$('.wind'+nb_day).css({"-webkit-transform": "rotate("+wind_dir+"deg)", "-moz-transform" : "rotate("+wind_dir+"deg)", "-ms-transform" : "rotate("+wind_dir+"deg)", "-o-transform" : "rotate("+wind_dir+"deg)", "transform" : "rotate("+wind_dir+"deg)"});
					
				}
			});
}); // JavaScript Document

function checkWeather(code){
			// Assign handlers immediately after making the request,
			// and remember the jqxhr object for this request
			
			// img : pluie1, pluie2, nuage, neige1, neige2, soleil, soleilnuage 
			var dataWeather = new Array() ;
			dataWeather[-999]= { "desc": "N/A", "img": "soleil.png" };
			
			dataWeather[0]= { "desc": "ensoleillé", "img": "B" };
			dataWeather[1]= { "desc": "partiellement nuageux", "img": "G" };
			dataWeather[2]= { "desc": "nuageux", "img": "Y" };
			dataWeather[3]= { "desc": "couvert", "img": "N" };
			dataWeather[10]= { "desc": "brouillard", "img": "M" };
			dataWeather[21]= { "desc": "pluie probable", "img": "Q" };
			dataWeather[22]= { "desc": "neige probable", "img": "U" };
			dataWeather[23]= { "desc": "neige probable", "img": "U" };
			dataWeather[24]= { "desc": "gel probable", "img": "V" };
			dataWeather[29]= { "desc": "orageux", "img": "P" };
			dataWeather[38]= { "desc": "poudrerie", "img": "M" };
			dataWeather[39]= { "desc": "blizzard", "img": "F" };
			dataWeather[45]= { "desc": "brouillard", "img": "M" };
			dataWeather[49]= { "desc": "brouillard givrant", "img": "M" };
			dataWeather[50]= { "desc": "faible pluie", "img": "Q" };
			dataWeather[51]= { "desc": "pluie fine", "img": "Q" };
			dataWeather[56]= { "desc": "pluie verglaçante", "img": "Q" };
			dataWeather[57]= { "desc": "pluie verglaçante", "img": "Q" };
			dataWeather[60]= { "desc": "faible pluie", "img": "Q" };
			dataWeather[61]= { "desc": "faible pluie", "img": "Q" };
			dataWeather[62]= { "desc": "pluie modérée", "img": "Q" };
			dataWeather[63]= { "desc": "pluie modérée", "img": "Q" };
			dataWeather[64]= { "desc": "fortes précipitations", "img": "R" };
			dataWeather[65]= { "desc": "fortes précipitations", "img": "R" };
			dataWeather[66]= { "desc": "pluie verglaçante", "img": "Q" };
			dataWeather[67]= { "desc": "pluie verglaçante", "img": "Q" };
			dataWeather[68]= { "desc": "grésil", "img": "V" };
			dataWeather[69]= { "desc": "grésil", "img": "V" };
			dataWeather[70]= { "desc": "averses de neige", "img": "W" };
			dataWeather[71]= { "desc": "averses de neige", "img": "W" };
			dataWeather[72]= { "desc": "averses de neige", "img": "W" };
			dataWeather[73]= { "desc": "averses de neige", "img": "W" };
			dataWeather[74]= { "desc": "averses de neige", "img": "W" };
			dataWeather[75]= { "desc": "averses de neige", "img": "W" };
			dataWeather[79]= { "desc": "grêle", "img": "X" };
			dataWeather[80]= { "desc": "pluie", "img": "R" };
			dataWeather[81]= { "desc": "fortes pluies", "img": "R" };
			dataWeather[82]= { "desc": "pluies torrentielles", "img": "R" };
			dataWeather[83]= { "desc": "averses de neige", "img": "W" };
			dataWeather[84]= { "desc": "averses de neige", "img": "W" };
			dataWeather[85]= { "desc": "averses de neige", "img": "W" };
			dataWeather[86]= { "desc": "averses de neige", "img": "W" };
			dataWeather[87]= { "desc": "grêle", "img": "X" };
			dataWeather[88]= { "desc": "grêle", "img": "X" };
			dataWeather[91]= { "desc": "tempête", "img": "R" };
			dataWeather[92]= { "desc": "tempête", "img": "R" };
			dataWeather[93]= { "desc": "tempête", "img": "W" };
			dataWeather[94]= { "desc": "tempête", "img": "W" };
		
			return {"desc" : dataWeather[code].desc, "img" : dataWeather[code].img};
}*/