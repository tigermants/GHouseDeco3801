//Overview.js dynamically generates the overview page by pulling data from the database and displaying it.
$(function(){
	//Retrieves all the locations and thier names.
	$.ajax({url:'scripts/php/getLocs.php', async: false, type:'POST', dataType:'json',
		success: function(data){
			//for each location create a new display tile (div) and populate it with the correct name.
        		for(var i = 0; i < data.length; i++){
				var $div = $("<div>", {id: data[i][0], "class": "overviewTile", "onclick": "viewLocation()"});
				$("#content_wrapper").append($div);
				$("<h2></h2>").text(data[i][1]).appendTo("#"+data[i][0]);
				//Retrieves all the probes that are currently active and the locationed parsed to getLocProbes.php.
				$.ajax({url:'scripts/php/getLocProbes.php', async: false, cache: false, type:'POST', data: {"location": data[i][0]}, dataType:'json',
					success: function(dataa){
						//If there is no active probes, display the no data warning.
						if (dataa == null){
							$("<h2></h2>").text("No Active Probes.").appendTo("#"+data[i][0]);

						} else {
							var pRoom = null;
							var $table = $('<table>');
							//If some probes at the given location are not assigned a room. Display them first.
							if (dataa[0][1] == null) {
								$table.append('<tr><th>Probe</th><th>Light</th><th>Temp</th><th>Humidity</th></tr>');
							}
							//For each probe at the location, display it's latest data point on the display tile under it's correct heading.
							for(var j = 0; j < dataa.length; j++){
								if (dataa[j][1] == pRoom) {
									$table.append('<tr><td>'+dataa[j][0]+'</td><td>'+dataa[j][2]+'</td><td>'+dataa[j][3]+'</td><td>'+dataa[j][4]+'</td></tr>');
								} else {
									$table.append('</table>');
									$table.appendTo("#"+data[i][0]);
									$table = $('<table>');
									$table.append('<tr><th>Probe</th><th>Light</th><th>Temp</th><th>Humidity</th></tr>');
									$("<h3></h3>").text(dataa[j][1]).appendTo("#"+data[i][0]);
									$table.append('<tr><td>'+dataa[j][0]+'</td><td>'+dataa[j][2]+'</td><td>'+dataa[j][3]+'</td><td>'+dataa[j][4]+'</td></tr>');
									pRoom = dataa[j][1];
								}
								//On the last probe record finish and display the final table.
								if (j == dataa.length - 1){
									$table.append('</table>');
									$("#"+data[i][0]).append($table);
								}
							}
                            if ($("#"+data[i][0]).offsetHeight < $("#"+data[i][0]).scrollHeight) {
                                $("#"+data[i][0]).append('<span class="expand">&#8659;</span>');
                            } else {
                            }
							}
						}, error:function(error){
							console.log(error.responseText);
						}
					});
				}
			}, error:function(error){
				console.log(error.responseText);
			}
		});
        
        $('.overviewTile').on('click', function(){
            var str1 = "location.php?location=";
            var str2 = $(this).attr("id");
            var str3 = str1.concat(str2);
            window.location.href = str3;
        });

});
