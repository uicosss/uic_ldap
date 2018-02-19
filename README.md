# uic_ldap

PHP Library for using the UIC LDAP


## Usage
To use the library, you need to:

* Include library in your program 
```
include_once('src/uic_ldap.php');
```
* or use composer `composer require dpazuic\uic_ldap`
```
include_once('vendor/autoload.php');
```
* Instantiate an object of class `dpazuic\uic_ldap` and specify the LDAP attribute you want to query by
```
// (uid|ou|displayname|givenname|sn|mail|title|
facsimiletelephonenumber|telephonenumber|postaladdress) allowed
$ldap = new \dpazuic\uic_ldap("uid");

```

* Use one of the public search methods on the object

### By Single attribute
```
include_once('vendor/autoload.php');
$ldap = new \dpazuic\uic_ldap("uid");
$ldap->search("dpaz");
```

### By Multiple attributes
```
include_once('vendor/autoload.php');
$ldap = new \dpazuic\uic_ldap("ou");
$ldap->search(array("Student Systems Services*", "Academic and Enrollm*"));
```

## Examples:
You can use the attached `examples/cli.php` file from the command line to test functionality.
`php cli.php uid dpaz`. Be sure to run `composer dpazuic\uic_ldap` before attempting attemping to run `cli.php`.