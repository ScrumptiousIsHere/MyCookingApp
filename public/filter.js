var _token,kw,lista;

$(document).ready(function() {
    $("#butonfiltru").click(function() {
            $.ajax({  //create an ajax request to display.php
                type: "GET",
                url: "filtreazadupaingredient",
                data: {
                    _token: $("#token").text(),
                    kw: $("#filtruingredient").val(),
                    lista: $("#detalii").text(),
                    dela:$("#dela").text(),
                    panala:$("#panala").text(),
                },
                success: function (data) {
                    $("#mesaj").text("");
                    console.log(data);
                    lista=JSON.parse($("#detalii").text())
                    let databuna=JSON.parse(data[0]);
                    let finallist=[];
                    let k=0;
                    for(let i=0;i<lista.length;i++) {
                    console.log('da');
                        let ok = 1;
                        for (let j = 0; j < data.length; j++)
                            if (lista[i] == data[j])
                                ok = 0;

                        if(ok==1)
                            $("#"+lista[i].toString()).hide();
                        if(ok==0)
                            finallist.push(lista[i]);
                    }
                    console.log(data);
                    console.log(lista);
                    console.log(finallist);
                    if($("#dela").length){
                        var dl=$("#dela").val();

                        for(let i=0;i<finallist.length;i++) {
                            console.log($("#caloriireteta" + finallist[i]).text());
                            console.log($("#dela").val());
                            var pscalret=parseInt($("#caloriireteta" + finallist[i]).text());
                            var psdela=parseInt($("#dela").val());
                            if (pscalret < psdela) {
                                $("#" + finallist[i]).hide();
                                console.log('WOW');
                            }
                        }
                    }


                    if($("#panala").length){
                        var dl=$("#panala").val();

                        for(let i=0;i<finallist.length;i++) {
                            console.log($("#caloriireteta" + finallist[i]).text());
                            console.log($("#panala").val());
                            var pscalret=parseInt($("#caloriireteta" + finallist[i]).text());
                            var psdela=parseInt($("#panala").val());
                            if (pscalret > psdela) {
                                $("#" + finallist[i]).hide();
                                console.log('WOW');
                            }
                        }
                    }
                },
                error:function(){
                    $("#mesaj").text("Nu am gasit niciun rezultat!");
                }
            });
    });

});


function reseteazaFiltre(){
    console.log("Salut");
    lista=JSON.parse($("#detalii").text())
    for(let i=0;i<lista.length;i++) {
        $("#"+lista[i].toString()).show();
    }
}
