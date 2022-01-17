function startchart(calorii, proteine, grasimi, carbo){

    console.log(" merge");
    console.log(carbo);
var colors=['#ffa64d','#0066ff','#ff3333'];

carbo=carbo*100/calorii*4;
carbo=(Math.round(carbo * 100) / 100).toFixed(2);
proteine=proteine*100/calorii*4;
proteine=(Math.round(proteine * 100) / 100).toFixed(2);
grasimi=grasimi*100/calorii*9;
grasimi=(Math.round(grasimi * 100) / 100).toFixed(2);
console.log(carbo+" "+proteine+" "+grasimi);

var setare = {
    cutoutPercentage: 70,
    legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true, fontColor:"black"}}
};

var dateChart = {
    labels: ['Carbohidrati(%)', 'Proteine(%)', 'Grasimi(%)'],
    datasets: [
        {
            backgroundColor: colors.slice(0,3),
            borderWidth: 0,
            data: [carbo, proteine, grasimi]
        }
    ]
};

var chDonut1 = document.getElementById("procente");
if (chDonut1) {
    new Chart(chDonut1, {
        type: 'pie',
        data: dateChart,
        options: setare
    });
}


else console.log("Nu merge");
// calnut*100/caltotal


}


function aratacalorii(calorii, proteine, grasimi, carbo){

    console.log(" merge");
    console.log(carbo);
    var colors=['#ffa64d','#0066ff','#ff3333'];


    var setare = {
        legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true, fontColor:"black"}}
    };

    var dateChart = {
        labels: ['Carbohidrati (kcal/zi)', 'Proteine (kcal/zi)', 'Grasimi (kcal/zi)'],
        datasets: [
            {
                backgroundColor: colors.slice(0,3),
                borderWidth: 0,
                data: [carbo, proteine, grasimi]
            }
        ]
    };

    var chDonut1 = document.getElementById("procente");
    if (chDonut1) {
        new Chart(chDonut1, {
            type: 'pie',
            data: dateChart,
            options: setare
        });
    }


    else console.log("Nu merge");
// calnut*100/caltotal


}
