$(document).ready(function() {
    $("#getData").click(function() {
        $.ajax({  //create an ajax request to display.php
            type: "GET",
            url: "getvaloricomparatie/1",
            success: function (data) {
                $("#ingredient1").text(data);
            }
        });
    });
});


$('#ingredient1').change(function() {
    $.ajax({  //create an ajax request to display.php
        type: "GET",
        url: "getvaloricomparatie/"+$(this).val(),



        success: function (data) {
            data=JSON.parse(data);
            $("#lista1").text("");
            var totaldr=0;

            for(let i=0;i<data.length;i++){

                let elem=data[i].split(',');
                if(elem[0]==="Proteina" || elem[0]==="Grasime" || elem[0]==="Carbohidrat" || elem[0]==="Alcool")
                    totaldr=totaldr+parseInt(elem[1])*parseInt(elem[2]);


                $("#lista1").append('<li id="' + elem[0].toString() + '" class="list-group-item">' + elem[0] + ':' + elem[1] + elem[3] + '</li>');
            }
            $("#lista1").append('<li id="Calorii1" class="list-group-item">Calorii:<div id="totalcalorii1">'+totaldr+ '</div>kcal/100gr</li>');
            if($("#totalcalorii2").length){
                let varcalorii2=parseInt($("#totalcalorii2").text());
                let varcalorii1=parseInt($("#totalcalorii1").text());
                if(varcalorii2>varcalorii1) {
                    $("#totalcalorii1").css("background-color", "green");
                    $("#totalcalorii2").css("background-color","red");
                }
                else if(varcalorii2<varcalorii1) {
                    $("#totalcalorii1").css("background-color","red");
                    $("#totalcalorii2").css("background-color","green");
                }
                else{
                    $("#totalcalorii1").css("background-color","gray");
                    $("#totalcalorii2").css("background-color","gray");
                }
            }

        }



    });
});


$('#ingredient2').change(function() {
    $.ajax({  //create an ajax request to display.php
        type: "GET",
        url: "getvaloricomparatie/"+$(this).val(),



        success: function (data) {
            data=JSON.parse(data);
            $("#lista2").text("");
            var totaldr=0;

            for(let i=0;i<data.length;i++){

                let elem=data[i].split(',');
                if(elem[0]==="Proteina" || elem[0]==="Grasime" || elem[0]==="Carbohidrat" || elem[0]==="Alcool")
                totaldr=totaldr+parseInt(elem[1])*parseInt(elem[2]);


                $("#lista2").append('<li id="' + elem[0].toString() + '" class="list-group-item">' + elem[0] + ':' + elem[1] + elem[3] + '</li>');
            }
            $("#lista2").append('<li id="Calorii2" class="list-group-item">Calorii: <div id="totalcalorii2">'+totaldr+ '</div>kcal/100gr</li>');

            if($("#totalcalorii1").length){
                let varcalorii2=parseInt($("#totalcalorii2").text());
                let varcalorii1=parseInt($("#totalcalorii1").text());
                if(varcalorii2>varcalorii1) {
                    $("#totalcalorii1").css("background-color", "green");
                    $("#totalcalorii2").css("background-color","red");
                }
                else if(varcalorii2<varcalorii1) {
                    $("#totalcalorii1").css("background-color","red");
                    $("#totalcalorii2").css("background-color","green");
                }
                else{
                    $("#totalcalorii1").css("background-color","gray");
                    $("#totalcalorii2").css("background-color","gray");
                }
            }
        }



    });
});
