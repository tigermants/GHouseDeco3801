$(function(){
    console.log("Function is called when the document's ready!");
    
    var overviewTable = $('#overview_table').dataTable();
    
    console.log("After the table assignment.");
    
    $.ajax({url:'scripts/php/view.php',
    dataType:'json',
    success: function(data){
        console.log("Successful");
        console.log(data);
        for(var i = 0; i < data.length; i++){
            console.log("loop is called:" + i);
            overviewTable.fnAddData(
                [data[i][0], data[i][1], data[i][2],
                data[i][3], data[i][4], data[i][5]]
            );
        }
    },
    error:function(error){
        console.log(error.responseText);
    }
    });
});


