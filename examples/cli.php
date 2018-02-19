<?php
/**
 * Created by PhpStorm.
 * User: Daniel-Paz-Horta
 * Date: 9/22/17
 * Time: 10:27 AM
 */

try {

    include_once(__DIR__ . '/../vendor/autoload.php');

    // Attribute to query
    if(empty($argv[1])){

        throw new \Exception("Error: LDAP Query attribute was not stated. Attribute must be a string of value: uid, ou, displayname, givenname, sn, mail, title, 
facsimiletelephonenumber, telephonenumber or postaladdress");

    }

    // Value to query
    if(empty($argv[2])){

        throw new \Exception("Error: Value to query LDAP must be specified. Can either be single string or comma delimited list without spaces, eg. \"dpaz,sparky.\"");
        echo PHP_EOL;

    }

    // Instantiate LDAP
    $ldap = new \dpazuic\uic_ldap($argv[1]);

    // Check to see if $argv[2] is a comma delimited list
    $valueArary = explode(",", $argv[2]);

    echo PHP_EOL;
    echo PHP_EOL;
    print_r($valueArary);
    echo PHP_EOL;
    echo PHP_EOL;


    if(count($valueArary) > 1) {

        echo "IN HERE" . PHP_EOL;

        // By Multiple values
        print_r($ldap->multiSearch($valueArary));

    } else {

        echo "OUT THERE" . PHP_EOL;

        // By a single value
        print_r($ldap->search($argv[2]));

    }


} catch (\Exception $e){

    print_r($e->getMessage());
    echo PHP_EOL;
    echo PHP_EOL;

}