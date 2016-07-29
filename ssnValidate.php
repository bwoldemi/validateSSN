<?php

/**
 * 
 * Berekt Kahsay Woldemicael 
 * bereketka@gmail.com
 * 
 * Reference: http://id-check.artega.biz/info-fi.php
 */

header("Content-type: text/plain");

$ssn = htmlspecialchars($_GET["ssn"]);

if(!isContainValidDigits($ssn)){
    echo "false:";
    var_dump(http_response_code(200));
}else if(!isValidDate($ssn)){
    echo "false:";
    var_dump(http_response_code(200));
}else if(!isValidCenturyIdent($ssn)){
     echo "false:";
     var_dump(http_response_code());
}else if (!isValidChecksum($ssn)) {
     echo "false:";
     var_dump(http_response_code(200));
}else {
    echo "true:";
    var_dump(http_response_code(200));
}



/**
 *  Check wheter SSN contains the correct digits 
 * @param type $date
 */
function isContainValidDigits($ssn) {
    
    // check whether it contains the correct number of digits 
    $param = strlen($ssn) == 11 ? TRUE : FALSE;
    if(!$param){
       
        return $param;
    }
    // check whether birth date is numeric 
    if(!is_numeric(substr($ssn, 0,6))){
        
        return FALSE;
    }
    // check whether the identyty code is numeric  
    if(!is_numeric(substr($ssn, -4,3))){
       
        return FALSE;
    }
    
    return TRUE;
}

/**
 * 
 * @param type $date
 * @return boolean
 * Checks the validty of date 
 */
function isValidDate($ssn) {
    $ssnArray = str_split($ssn);
    // convert DDMMYY to DDMMYYYY
    $day = $ssnArray[0] * 10 + $ssnArray[1] * 1;
    $month = $ssnArray[2] * 10 + $ssnArray[3] * 1;
    $year = $ssnArray[4] * 10 + $ssnArray[5] * 1;

    $century = substr($ssn, -5 ,1);;
    
    if ($century == '-') {
        $year = $year + 1900;
    } else if ($century == '+') {
        $year = $year + 1800;
    } else if ($century == 'A' || $century == 'a') {
        $year = $year + 2000;
    }
     
    
    return checkdate($month, $day, $year);
}

/**
 * validate the century identifier
 * @param type $ssn
 * @return boolean
 */
function isValidCenturyIdent($ssn) {
    $century = substr($ssn, -5 ,1);
    if ($century == "+" || $century =='-' || $century == 'A' || $century == "a") {
        return TRUE;
    } else {
        return FALSE;
    }
}

/**
 * Validate checksum number 
 * @param type $ssn
 * @return boolean
 */
function isValidChecksum($ssn) {    
    $checksumString = str_split("0123456789ABCDEFHJKLMNPRSTUVWXY");
    $num= substr($ssn, 0, 6).substr($ssn, -4, 3);
    $cheksumNum=$num%31;
    $cheksum = $checksumString[$cheksumNum];
    if(strcasecmp($cheksum, substr($ssn, -1))==0){
        return TRUE;
    }  else {
        return FALSE;
    }
}
