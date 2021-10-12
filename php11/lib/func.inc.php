<?php

$errors = [];

function validate($name, $email, $examDate, $subject, $grade){


    return validateName($name) & validateEmail($email) & validateExamDate($examDate) & validateSubject($subject) & validateGrade($grade);
}


function validateName($name){

    global $errors;

    if (strlen($name) == 0){
        $errors['name'] = "Name darf nicht leer sein";
        return false;
    }elseif (strlen($name) > 20){
        $errors['name'] = "Name zu lang";
        return false;
    }else{
        return true;
    }
}

function validateExamDate($examDate){

    global $errors;

    try {
        if ($examDate == "") {
            $errors['examDate'] = "Prüfungsdatum darf nicht leer sein";
            return false;
        } elseif (new DateTime($examDate) > new DateTime()) {
            $errors['examDate'] = "Prüfungsdatum darf nicht in der Zukunft leigen";
            return false;
        } else {
            return true;
        }
    }catch (Exception $e){
        $errors['examDate'] = "Prüfungdatum ungültig";
        return false;
    }
}

function validateSubject($subject){

    global $errors;

    if ($subject == 'm' && $subject == 'd' && $subject == 'e'){
        $errors['subject'] = "fach ungültig";
        return false;
    }else{
        return true;
    }
}

function validateGrade($grade){

    global $errors;

    if (!is_numeric($grade) || $grade < 1 || $grade > 5){
        $errors['grade'] = "Note ungültig";
        return false;
    } else {
        return true;
    }
}

function validateEmail($email){

    global $errors;

    if ($email != "" && !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Email ungültig";
        return false;
    }else{
        return true;
    }
}