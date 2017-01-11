$(function(){
    var dropDownP1 = document.getElementById("up-probeID");
    var dropDownP2 = document.getElementById("upl-probeID");

    $.ajax({url:'scripts/php/addProbeCheck.php',
	   dataType:'json',
	   success: function(data){
		   for(var i = 0; i < data.length; i++){
				var option = document.createElement("option");
		   	    var option1 = document.createElement("option");
	            option.text = data[i][0];
                option1.text = data[i][0];
				dropDownP1.add(option);
				dropDownP2.add(option1);
		   }
	   },
	   error:function(error){
		   console.log(error.responseText);
	   }
	   });    
});

function addProbe(){
    var probeID = $('#add-probeID').val();
    var devID = $('#add-devID').val();
    var accToken = $('#add-accToken').val();
    var desc = $('#add-desc').val();

	$.ajax({url:'scripts/php/addProbeCheck.php',
	   dataType:'json',
	   success: function(data){
		   for(var i = 0; i < data.length; i++){
		   	    if (probeID == data[i][0]) {
                    alert("Probe ID must be unique.");
                    return 0;
                } else if (accToken == data[i][1]) {
                    alert("Access token must be unique.");
                    return 0;
                }
                 
		   }
	   },
	   error:function(error){
		   console.log(error.responseText);
	   }
	   });

    $.ajax({url:'scripts/php/addProbe.php',
                    type: "POST",
                    data: {probeID: probeID, devID: devID, accToken: accToken, desc: desc},
                    success: function(receivedData){
                        alert("Probe added");
                    }, 
                error:function(error){
                    console.log(error.responseText);
                }
        });
}

function updateProbe(){
    var probeID = $('#up-probeID').val();
    var devID = $('#up-devID').val();
    var accToken = $('#up-accToken').val();
    var desc = $('#up-desc').val();
    console.log(probeID);
    console.log(devID);
    console.log(accToken);
    console.log(desc);
	var flag = 0;

    $.ajax({url:'scripts/php/addProbeCheck.php',
	   dataType:'json',
	   success: function(data){
		   for(var i = 0; i < data.length; i++){		   	     
               if (probeID == data[i][0]) {
                    flag = 1;
                } else if (accToken == data[i][1]) {
                    alert("Access token already exists");
                    return;
                }
                 
		   }
	   },
	   error:function(error){
		   console.log(error.responseText);
	   }
	   });
    

    $.ajax({url:'scripts/php/updateProbe.php',
                    type: "POST",
                    data: {probeID: probeID, devID: devID, accToken: accToken, desc: desc},
                    success: function(receivedData){
                    alert("Probe updated");
               }, 
                error:function(error){
                    console.log(error.responseText);
                }
        });
}

function updateProbeLoc(){
    var probeID = $('#upl-probeID').val();
    var eLocID = $('#el-locID').val();
    var eRoom = $('#el-room').val();
    var nLocID = $('#nl-locID').val();
    var nName = $('#nl-name').val();
    var nRoom = $('#nl-room').val();
    var nType = $('#nl-type').val();
    var nLat = $('#nl-lat').val();
    var nLng = $('#nl-lng').val();
    var nDesc = $('#nl-desc').val();
    console.log(probeID);
    console.log(eLocID);
    console.log(eRoom);
    console.log(nLocID);
    console.log(nRoom);
    console.log(nType);
    console.log(nLat);
    console.log(nLng);
    console.log(nDesc);

    if (eLocID != "" && nLocID != "") {
        alert("You can only add a probe to 1 location at once");
    } else if (eLocID != "") {
        nLocID = "";
    } else if (nLocID != "") {
        eLocID = "";
    }

    $.ajax({url:'scripts/php/updateLocation.php',
                    type: "POST",
                    data: {probeID: probeID, eLocID: eLocID, nName: nName, eRoom: eRoom, nLocID: nLocID, nRoom: nRoom, nType: nType, nLat: nLat, nLng: nLng, nDesc: nDesc},
                    success: function(receivedData){
                        alert("Probe location Updated");
               }, 
                error:function(error){
                    console.log(error.responseText);
                }
        });
}


