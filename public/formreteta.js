var nr=1;
var nrpas=1;
var form;
var divingredient=$("#ingrediente").html();
var divpas=$("#pasi").html();
var divpasbun=divpas.replaceAll("pas1","pas"+(nrpas+1));
divpasbun=divpasbun.replaceAll("Pasul 1","Pasul "+(nrpas+1));
var divbun=divingredient.replaceAll("ingredient1","ingredient"+(nr+1));
divbun = divbun.replaceAll("cantitatei1","cantitatei"+(nr+1));

function addIngredient(){
        diving = $("<div>", {});
        diving.append(divbun);
        nr = nr + 1;
        divbun = divbun.replaceAll("ingredient" + nr, "ingredient" + (nr + 1));
        console.log("Ingredientul " + nr + " este inlocuit de ingredientul " + (nr + 1));
        divbun = divbun.replaceAll("cantitatei" + nr, "cantitatei" + (nr + 1));
        $("#ingrediente").append(diving);
        $("#nring").val(nr);
        console.log($("#nring").val());
}


function addPas(){
    divstep = $("<div>", {});
    divstep.append(divpasbun);
    nrpas = nrpas + 1;
    divpasbun = divpasbun.replaceAll("pas" + nrpas, "pas" + (nrpas + 1));
    console.log("Pasul " + nrpas + " este inlocuit de pasul " + (nrpas + 1));
    divpasbun = divpasbun.replaceAll("Pasul " + nrpas, "Pasul " + (nrpas + 1));
    $("#pasi").append(divstep);
    $("#nrpas").val(nrpas);
    console.log($("#nrpas").val());
}

function test(){
    formul=$("#test");
    $("#ingredient").append(formul);
}


