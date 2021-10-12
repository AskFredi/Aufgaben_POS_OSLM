function initialize() {
    document.getElementsByName("weight")[0].onkeyup = calculateBmi;
    document.getElementsByName("height")[0].onkeyup = calculateBmi;
}

function calculateBmi() {
    var weight = parseInt(document.getElementsByName("weight")[0].value);
    var height = parseInt(document.getElementsByName("height")[0].value);

    console.log("weight: " + weight);
    console.log("height: " + height);

    if (isNaN(weight) || isNaN(height)) {
        document.getElementById("ampel").innerHTML = "";
    } else {
        height /= 100; // cm -> m
        var bmi = weight / (height * height);
        console.log("bmi: " + bmi);

        document.getElementById("ampel").innerHTML = getAmpelImage(bmi);
    }
}

function getAmpelImage(bmi) {
    if (bmi < 18.5) {
        return "<img src='images/ampel_gelb.png'/>";
    } else if (bmi < 25) {
        return "<img src='images/ampel_gruen.png'/>";
    } else if (bmi < 30) {
        return "<img src='images/ampel_gelb.png'/>";
    } else {
        return "<img src='images/ampel_rot.png'/>";
    }
}

function validateMessurementDate(elem){

    let today = new Date();
    today.setHours(0,0,0,0);

    let messDate = new Date(elem.value);
    messDate.setHours(0,0,0,0);

    <!-- CSS Vorgabe -->
    if(messDate <= today){
        elem.classList.add("is-valid");
        elem.classList.remove("is-invalid");
    }else{
        elem.classList.add("is-invalid");
        elem.classList.remove("is-valid");
    }
}
