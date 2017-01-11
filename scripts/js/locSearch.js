 $(function(){        

        //This code finds the search_table table on the HTML file, make it into dataTable.
        var searchTable = $('#search_table').dataTable();   

	var url = window.location.href;
	var queryStart = url.indexOf("=") + 1;
        var queryEnd  = url.length + 1;
        var query = url.slice(queryStart, queryEnd - 1);
	
	$.ajax({url:'scripts/php/getLocInfo.php', async: false, cache: false, type:'POST', data: {"location": query},  dataType:'json',
        success: function(data){	
		console.log(data);
		$('#locTitle').html(data[0][2]);
		google.maps.event.addDomListener(window, 'load', init_map(data[0][2], data[0][3], data[0][4]));
	}
	});
	
        //Sends AJAX request to the server
        $.ajax({url:'scripts/php/locSearch.php', async: false, cache: false, type:'POST', data: {"location": query}, dataType:'json',
        success: function(data){
            //For each data in the json received, add the data to the table.
	for(var i = 0; i < data.length; i++){
                searchTable.fnAddData(
                    [data[i][0], data[i][1], data[i][2],
                    data[i][3], data[i][4], data[i][5]]
                );

                var date = new Date(data[i][1]);
            }
        },
        error:function(error){
            console.log(error.responseText);
        }
        });

});


function init_map(name, lat, lng){
	var myOptions = {
		zoom:17,
		center:new google.maps.LatLng(lat,lng),
		mapTypeId: google.maps.MapTypeId.ROADMAP};
        map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
		marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(lat,lng)});
		infowindow = new google.maps.InfoWindow({content:name});
	google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});
	infowindow.open(map,marker);
}


