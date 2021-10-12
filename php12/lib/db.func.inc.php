<?php

$dbName = 'php12';
$dbHost = 'localhost';
$dbUsername = 'root';
$dbUserPassword = '';
$errors = [];

/**
 * Verbindung zur DB aufbauen
 * @return PDO (Verbindungsobjekt)
 */
function connect() {
    global $dbName, $dbHost, $dbUsername, $dbUserPassword;
    try {
        $conn = new PDO("mysql:host=" . $dbHost . ";" . "dbname=" . $dbName, $dbUsername, $dbUserPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

/**
 * Datensatz speichern
 * @param $name
 * @param $date
 * @param $bmi
 */
function save($name, $date, $bmi)
{
    $db = connect();
    $sql = "INSERT INTO bmi (name, date, bmi) values(?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($name, $date, $bmi));
}

/**
 * Auslesen aller Daten (als assoziatives Array)
 * @return array
 */
function getAll()
{
    $db = connect();
    $sql = 'SELECT * FROM bmi ORDER BY name ASC, date ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function validate($name,$messurementDate,$height,$weight){

    return validateName($name) & validateMessurmentDate($messurementDate) & validateHeight($height) & validateWeight($weight);
}


function validateName($name){

    global $errors;

    if(strlen($name) == 0){
        $errors['name'] = "Name darf nicht leer sein";
        return false;
    }else if (strlen($name) > 25){
        $errors['name'] = "Name zu lang";
        return false;
    }else{
        return true;
    }
}

function validateMessurmentDate($messurementDate){

    global $errors;

    try {
        if($messurementDate == ""){
            $errors['messurementDate'] = "Datum darf nicht leer sein!";
            return false;
        }else if (new DateTime($messurementDate) > new DateTime()){
            $errors['messurementDate'] = "Datum darf nicht in der Zukunft liegen!";
            return false;
        }else{
            return true;
        }

    }catch (Exception $e){
        $errors['messurementDate'] = "Datum ungültig";
        return false;
    }
}

function validateHeight($height){

    global $errors;

    if(!is_numeric($height) || $height < 100 || $height > 250){
        $errors['height'] = "Größe nicht gültig";
        return false;
    }else{
        return true;
    }
}

function validateWeight($weight){

    global $errors;

    if(!is_numeric($weight) || $weight < 40 || $weight > 150){
        $errors['weight'] = "Gewicht nicht gültig";
        return false;
    }else{
        return true;
    }
}


?>