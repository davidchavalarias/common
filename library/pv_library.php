<?php
function decimal_converter($var){
    $var=trim(str_replace(',','.', $var));
    if (strcmp(strrchr($var,'.'),'.')==0){
        $var=substr($var,0,-1);
    }
    //pt($var);
        // plain
    preg_match_all("/[0-9][0-9]*[\,|\.][0-9][0-9]*(\s)*/", $var, $matches);
    //print_r(strcmp($var, trim($matches[0][0])));
    if (strcmp($var, trim($matches[0][0]))==0) {
        return  array($matches[0][0],'plain');
    }

    // detection of percentage
    preg_match_all("/[0-9][0-9]*\.?[0-9]*(\s)*\%/", $var, $matches);
    //print_r(strcmp($var, trim($matches[0][0])));
    if (strcmp($var, trim($matches[0][0]))==0) {
        preg_match_all("/[0-9][0-9]*[\,|\.]?[0-9]*/", $var, $dec);
        //print_r($dec);
        return  array(trim($dec[0][0])/100,'perc');
    }

    // detection of 10 power
    preg_match("/[0-9]*\.?[0-9]*(\s)*(([x]?(\s)*[0-9]*\s*10\s*(exp|E|e|Exp)?\s*((\(\s*-\s*[0-9]*\s*\))|(\s*-\s*[0-9]*))))/", $var, $matches);
    if (strcmp($var, trim($matches[0]))==0) {
        preg_match("/[x]?\s*10\s*(exp|E|e|Exp)?\s*((\(\s*-\s*[0-9]*\s*\))|(\s*-\s*[0-9]*))/", $var, $pow);
        preg_match("/-\s*[0-9]*/", $pow[0], $exponent);
        $num_part=substr($var, 0,strpos($var, $pow[0]));
        if ($num_part==0){
            return  array(pow(10, $exponent[0]),'10exp');
        }
        return  array($num_part*pow(10, $exponent[0]),'10exp');
    }
    
 
    preg_match("/[0-9]*\.?[0-9]*(\s)*(([x]?(\s)*[0-9]*\s*(exp|E|e|Exp)\s*((\(\s*-\s*[0-9]*\s*\))|(\s*-\s*[0-9]*))))/", $var, $matches);
    //pt($matches[0]);
    if (strcmp($var, trim($matches[0]))==0) {
        preg_match("/(([x]?\s*(exp|E|e|Exp)\s*((\(\s*-\s*[0-9]*\s*\))|(\s*-\s*[0-9]*))))/", $var, $pow);
        //pt($pow[0]);
        preg_match("/-\s*[0-9]*/", $pow[0], $exponent);
        //pt($exponent[0]);
        $num_part=substr($var, 0,strpos($var, $pow[0]));
        //pt($num_part*pow(10, $exponent[0]));
        return  array($num_part*pow(10, $exponent[0]),'exp');
    }


    // correction of errors
    preg_match_all("/[0-9][0-9]*/", $var, $matches);
    //print_r(strcmp($var, trim($matches[0][0])));
    if (strcmp($var, trim($matches[0][0]))==0) {
        return  array($matches[0][0]/10,'.int');
    }else{
        return array('NaN','exception');
    }

    //    if (preg_match("/\s[Pp]{1}(\s|-)*(value)?(\s)*[=<>≤≥]+(\s)*[0-9][0-9]*[\,|\.]?[0-9]*(\s)*((\%)|([x]?(\s)*[0-9]*(\s)*(exp|E|e)?(\s)*(\(((\s)*-?(\s)*[0-9]*(\s)*\))|((\s)*-?(\s)*[0-9]*))))/", $ABString, $matches)) {
}

function drop_table($tablename){
    try{
    $sql="DROP TABLE ".$tablename;
    $resultat=mysql_query($sql);
    pt('table '.$tablename.' dropped');}
    catch (Exception $e){
        echo 'no table to drop';

    }
}

function pt($string){
    echo $string.'<br/>';
}
function dg($string){
    // affiche pour le debug
    echo $string.'<br/>';
}

function getField($ligne) {
// done le descripteur du champ Medline ou retourne 0
    if (strcmp($ligne[0],' ')==0) {
        return 'suite';
    }else {
        $pos=stripos($ligne,'-');
        return trim(substr($ligne,0,$pos));
    }
}
function getLineValue($ligne) {
// done la valueur correspondant au descripteur du champ Medline
    $pos=stripos($ligne,'-');
    return substr($ligne,$pos+2);
}
?>
