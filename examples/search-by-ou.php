<?php
/**
 * Created by PhpStorm.
 * User: dpaz
 * Date: 2/19/18
 * Time: 11:30 AM
 */

use Uicosss\UicLdap;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    // Instantiate LDAP
    $ldap = new UicLdap("ou");

    // Search by matching OU
    print_r($ldap->search("Lares*"));
} catch (Exception $e){
    print_r($e->getMessage());
    echo PHP_EOL;
}
