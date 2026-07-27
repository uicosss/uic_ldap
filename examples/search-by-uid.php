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
    $ldap = new UicLdap("uid");

    // Searching by UID
    print_r($ldap->search("hugot"));
} catch (Exception $e){
    print_r($e->getMessage());
    echo PHP_EOL;
}
