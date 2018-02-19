<?php
/**
 * Created by PhpStorm.
 * User: dpaz
 * Date: 2/19/18
 * Time: 11:30 AM
 */

include_once(__DIR__ . '/../vendor/autoload.php');


try {

    // Instantiate LDAP
    $ldap = new \dpazuic\uic_ldap("ou");

    // Search by matching OU
    print_r($ldap->search("Lares*"));

} catch (Exception $e){

    print_r($e->getMessage());
    echo PHP_EOL;

}

