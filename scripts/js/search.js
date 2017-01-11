 $(function(){

        //Finds the mindate and maxdate element on the HTML file and make it into datetimepicker object
        $("#mindate").datetimepicker();
        $("#maxdate").datetimepicker();

        //This code finds the search_table table on the HTML file, make it into dataTable.
        var searchTable = $('#search_table').dataTable();


        //Sends AJAX request to the server
        $.ajax({url:'scripts/php/search.php',
        dataType:'json',
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
     
        drawTemp();
        drawLight();
        drawHumidity();
});

//This function filters the data based on the value specified in the input field of search.html document. This function is called when the user clicks on 'Apply Filter' button on the search.html page.
function filter(){

    //This code finds the search_table table on the HTML file, make it into dataTable.
    var searchTable = $('#search_table').dataTable();

    //This code is filtering through the data inside the searchTable.
    $.fn.dataTableExt.afnFiltering.push(
        function(settings, data, dataIndex){

        //Get the value from the input fields
        var probeID = $('#probeID').val();
        var min = new Date($('#mindate').find("input").val());
        var max = new Date($('#maxdate').find("input").val());

        //console.log("default max value: " + $('#maxdate').find("input").val());
        //console.log("default date: " + data[1]);

        //The value of the data from the table
        var dataDate = new Date(data[1]);
        var dataProbeID = data[0];

        //Chek on all possible form conditions. Then filter the data accordingly.
        if(probeID == "" && min == "Invalid Date" && max == "Invalid Date"){
            return true;
        } else if(probeID == "" && min == "Invalid Date" && max != "Invalid Date"){
            if(dataDate <= max){
                return true
            }
            return false;
        } else if(probeID == "" && min != "Invalid Date" && max == "Invalid Date"){
            if(dataDate >= min){
                return true
            }
            return false;
        } else if(probeID == "" && min != "Invalid Date" && max != "Invalid Date"){
            if(dataDate >= min && dataDate <= max){
                return true
            }
            return false;
        } else if(probeID != "" && min == "Invalid Date" && max == "Invalid Date"){
            if(probeID == dataProbeID){
                return true
            }
            return false;
        } else if(probeID != "" && min == "Invalid Date" && max != "Invalid Date"){
            if(probeID == dataProbeID && dataDate <= max){
                return true
            }
            return false;
        } else if(probeID != "" && min != "Invalid Date" && max == "Invalid Date"){
            if(probeID == dataProbeID && dataDate >= min){
                return true
            }
            return false;
        } else{
            if(probeID == dataProbeID && dataDate <= max && dataDate >=min){
                return true;
            }
            return false;
        }
    });

    //Apply the filter to the searchTable
    searchTable.fnFilter();

}

//This function is called when the user clicks on 'Reset Filter' button on the search.html page
function resetFilter(){
    //reload the page to reset the filter
    location.reload();
}

function drawTemp(){

	console.log("drawGraph is called");
    var min = $('#mindate').find("input").val();
    var max = $('#maxdate').find("input").val()
    var probeID = $('#probeID').val();

	console.log("min: " + min);
	console.log("max: " + max);
    $.ajax({url:'scripts/php/filter_graph.php',
        type: "POST",
        data: {min: min, max: max, probeID: probeID},
        success: function(receivedData){
            var JSONdata = JSON.parse(receivedData);
			var date = [];
			var temp = [];
            console.log(receivedData);
            console.log("------");
            console.log(JSONdata);
			console.log("------");
			console.log(JSONdata[0][1]);
			console.log(JSONdata[0][2]);
			console.log(JSONdata[0][3]);
			console.log("------");
			console.log(Object.keys(JSONdata).length);
			for(var i = 0; i < Object.keys(JSONdata).length; i++) {
				date.push(JSONdata[i][1]);
				temp.push(JSONdata[i][2]);
			}


             var lineChartData = {
	            labels: date,
	            datasets: [{
	                label: 'Temp',
	                fillColor: "rgba(220,220,220,0)",
	                strokeColor: "rgba(220,180,0,1)",
	                pointColor: "rgba(220,180,0,1)",
	                data: temp
	            }]

	        }

	        var ctx = document.getElementById("skills1").getContext("2d");
	        var LineChartDemo = new Chart(ctx).Line(lineChartData, {
				responsive: true,
				pointDotRadius: 2,
	            bezierCurve: false,
	            scaleShowVerticalLines: false,
	            scaleGridLineColor: "rgb(212,212,212)"
	        });
        },
        error:function(error){
            console.log(error.responseText);
        }
        });
}

function addComment(){

	console.log("comment is called");
    var min = $('#mindate').find("input").val();
    var max = $('#maxdate').find("input").val()
    var probeID = $('#probeID').val();
    var commentRaw = $('#commentInput').val();

	console.log(commentRaw);
    $.ajax({url:'scripts/php/addComments.php',
        type: "POST",
        data: {min: min, max: max, probeID: probeID, comment: commentRaw},
        success: function(receivedData){
            console.log("echooooo");
        },
        error:function(error){
            console.log(error.responseText);
        }
        });
}

function drawLight(){

	console.log("drawGraph is called");
    var min = $('#mindate').find("input").val();
    var max = $('#maxdate').find("input").val()
    var probeID = $('#probeID').val();

	console.log("min: " + min);
	console.log("max: " + max);
    $.ajax({url:'scripts/php/filter_graph.php',
        type: "POST",
        data: {min: min, max: max, probeID: probeID},
        success: function(receivedData){
            var JSONdata = JSON.parse(receivedData);
			var date = [];
			var light = [];
            console.log(receivedData);
            console.log("------");
            console.log(JSONdata);
			console.log("------");
			console.log(JSONdata[0][1]);
			console.log(JSONdata[0][2]);
			console.log(JSONdata[0][3]);
			console.log("------");
			for(var i = 0; i < Object.keys(JSONdata).length; i++) {
				date.push(JSONdata[i][1]);
				light.push(JSONdata[i][3]);
			}


             var lineChartData = {
	            labels: date,
	            datasets: [{
	                label: 'Light',
	                fillColor: "rgba(220,220,220,0)",
	                strokeColor: "rgba(220,180,0,1)",
	                pointColor: "rgba(220,180,0,1)",
	                data: light
	            }]

	        }

	        var ctx = document.getElementById("skills2").getContext("2d");
	        var LineChartDemo = new Chart(ctx).Line(lineChartData, {
				responsive: true,
				pointDotRadius: 2,
	            bezierCurve: false,
	            scaleShowVerticalLines: false,
	            scaleGridLineColor: "rgb(212,212,212)"
	        });
        },
        error:function(error){
            console.log(error.responseText);
        }
        });
}


function drawHumidity(){

	console.log("drawGraph is called");
    var min = $('#mindate').find("input").val();
    var max = $('#maxdate').find("input").val()
    var probeID = $('#probeID').val();

	console.log("min: " + min);
	console.log("max: " + max);
    $.ajax({url:'scripts/php/filter_graph.php',
        type: "POST",
        data: {min: min, max: max, probeID: probeID},
        success: function(receivedData){
            var JSONdata = JSON.parse(receivedData);
			var date = [];
			var humidity = [];
            console.log(receivedData);
            console.log("------");
            console.log(JSONdata);
			console.log("------");
			console.log(JSONdata[0][1]);
			console.log(JSONdata[0][2]);
			console.log(JSONdata[0][3]);
			console.log("------");
			console.log(Object.keys(JSONdata).length);
			for(var i = 0; i < Object.keys(JSONdata).length; i++) {
				date.push(JSONdata[i][1]);
				humidity.push(JSONdata[i][4]);
			}


             var lineChartData = {
	            labels: date,
	            datasets: [{
	                label: 'Humidity',
	                fillColor: "rgba(220,220,220,0)",
	                strokeColor: "rgba(220,180,0,1)",
	                pointColor: "rgba(220,180,0,1)",
	                data: humidity
	            }]

	        }

	        var ctx = document.getElementById("skills3").getContext("2d");
	        var LineChartDemo = new Chart(ctx).Line(lineChartData, {
				responsive: true,
				pointDotRadius: 2,
	            bezierCurve: false,
	            scaleShowVerticalLines: false,
	            scaleGridLineColor: "rgb(212,212,212)"
	        });
        },
        error:function(error){
            console.log(error.responseText);
        }
        });
}

function showComment(){
    $('#comment').slideToggle(500, function () {
        if ($('#comment').is(":visible")) {
            $('.comBtn').html('<span class="glyphicon glyphicon-comment"></span> Hide Comment Results');
        } else {
            $('.comBtn').html('<span class="glyphicon glyphicon-comment"></span> Comment Results');
        }
    });
}
