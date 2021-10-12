<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>BMIRechner</title>
    <script type="text/javascript" src="js/ampel.js"></script>
</head>
<body>




<div class="container">
<h1 class="mt-5 mb-3"> BMI Rechner</h1> <!-- margin top = mt , margin bottom = mb -->

    <!-- PHP Interpretter -->
    <?php

    require "lib/db.func.inc.php";

    $name ='';
    $messurementDate ='';
    $height ='';
    $weight ='';

    if(isset($_POST['submit'])){
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $messurementDate = isset($_POST['messurementDate']) ? $_POST['messurementDate'] : '';
        $height = isset($_POST['height']) ? $_POST['height'] : '';
        $weight = isset($_POST['weight']) ? $_POST['weight'] : '';


        if(validate($name,$messurementDate,$height,$weight)){
            echo "<p class='alert alert-success'>Die Eingabe der Daten sind in Ordnung!</p>";
        }else{
            echo "<div class='alert alert-danger'><p>Die Eingabe der Daten sind nicht in Ordnung!</p><ul>";
        }

        foreach ($errors as $key => $value) {
            echo "<li>" . $value . "</li>";
        }
        echo "</ul> </div>";

    }



    ?>

    <form id="form_grade" action="index_statistik.php" method="post">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-8 form-group">
                        <label for="name">Name*</label>
                        <input
                                id="name"
                                type="text"
                                name="name"
                                class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                                maxlength="25"
                                value="<?= htmlspecialchars($name) ?>"
                                required
                        />
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="messurementDate">Messdatum*</label> <br>
                        <input
                                id="messurementDate"
                                type="date"
                                name="messurementDate"
                                class="form-control <?= isset($errors['messurementDate']) ? 'is-invalid' : '' ?>"
                                onchange="validateMessurementDate(this)"
                                required
                                value="<?= htmlspecialchars($messurementDate) ?>"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="height">Größe(cm)*</label> <br>
                        <input
                                id="height"
                                class="form-control <?= isset($errors['height']) ? 'is-invalid' : '' ?>"
                                type="number"
                                name="height"
                                min="100"
                                max="250"
                                onchange="calculateBmi()"
                                required
                                value="<?= htmlspecialchars($height) ?>"
                        />
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="weight">Gewicht(kg)*</label> <br>
                        <input
                                id="weight"
                                class="form-control <?= isset($errors['weight']) ? 'is-invalid' : '' ?>"
                                type="number"
                                name="weight"
                                min="40"
                                max="150"
                                onchange="calculateBmi()"
                                required
                                value="<?= htmlspecialchars($weight) ?>"
                        />
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h3> Info zum BMI</h3>
                <p>
                    Unter 18.5 Untergewichtig <br>
                    18.5 > 24.9 Normalgewichtig <br>
                    25.0 > 29.9 Übergewichtig <br>
                    30.0 und darüber Adipositas <br>
                </p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-3 mb-3">
                <input type="submit"
                       name="submit"
                       class="btn btn-primary btn-block"
                       value="Validieren" />
            </div>
            <div class="col-sm-3">
                <!-- Zum Löschen wird der Trick mit dem Link verwendet. -->
                <a href="index_statistik.php" class="btn btn-secondary btn-block">Löschen</a>
            </div>

            <?php

            if (isset($_POST['submit'])) {
                (float)$bmi = (int)$weight / (((int)$height / 100) * ((int)$height / 100));
                $bmi = number_format($bmi, 1);
                if (isset($bmi)) {
                    $output = "Ihr BMI ist: " . (float)$bmi . ". ";

                    if ($bmi < 18.5) {
                        echo "<div class='alert alert-warning'> Sie sind untergewichtig!</div>";
                    } else if ($bmi >= 18.5 && $bmi < 25) {
                        echo "<div class='alert alert-success'> Ihr Gewicht ist normal!</div>";
                    } else if ($bmi >= 25 && $bmi < 30) {
                        echo "<div class='alert alert-warning'> Sie sind übergewichtig!</div>";
                    } else {
                        echo "<div class='alert alert-danger'> Sie haben Adipositas</div>";
                    }
                }
            }
            ?>

        </div>
    </form>
</div>


</body>
</html>
