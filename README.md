# uic_ldap

PHP Library for using UIC LDAP


## Usage
To use the library, you need to:

* Include library in your program 
```
require_once 'src/uic_ldap.php';
```
* or use composer `composer require uicosss\uic_ldap`
```
require_once 'vendor/autoload.php';
```
* Instantiate an object of class `Uicosss\UicLdap` and specify the LDAP attribute you want to query by:
  - uid
  - ou
  - displayname
  - givenname
  - sn
  - mail
  - title
  - facsimiletelephonenumber
  - telephonenumber
  - postaladdress
```
$ldap = new \Uicosss\UicLdap("uid");
```

* Use one of the public search methods on the object

### By Single attribute
```
require_once 'vendor/autoload.php';
$ldap = new \Uicosss\UicLdap("uid");
$ldap->search("dpaz");
```

### By Multiple attributes
```
require_once 'vendor/autoload.php';
$ldap = new \Uicosss\UicLdap("ou");
$ldap->search(array("Student Systems Services*", "Academic and Enrollm*"));
```

## Examples:
You can use the attached `examples/cli.php` file from the command line to test functionality.
`php cli.php uid dpaz`. Be sure to run `composer uicosss\uic_ldap` before attempting to run `cli.php`.