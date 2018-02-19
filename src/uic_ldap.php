<?php
/**
 * Created by PhpStorm.
 * User: dpaz
 * Date: 2/19/18
 * Time: 11:09 AM
 */

namespace dpazuic;

class uic_ldap
{

    const DOMAIN_NAME = "ou=people,dc=uic,dc=edu";

    const LDAP_HOST = "ldap.uic.edu";

    private $attribute;

    /**
     * uic_ldap constructor.
     * @param $attribute
     * @throws \Exception
     */
    public function __construct($attribute)
    {

        // ensure the LDAP attribute submitted is valid
        if(\dpazuic\allowedAttributes::isValidName($attribute)) {

            // Set the Attribute type we are searching by
            $this->attribute = constant("\dpazuic\allowedAttributes::$attribute");

        } else {

            throw new \Exception("LDAP search by attribute '" . $attribute . "' is not allowed.");

        }

    }

    /**
     * Public method used to search UIC LDAP for a single entry
     *
     * @param null $query
     * @return array
     * @throws \Exception
     */
    public function search($query = null)
    {

        if (empty($query)) {

            throw new \Exception('Query value is empty.');

        }

        $dn = self::DOMAIN_NAME;
        $ds = ldap_connect(self::LDAP_HOST);

        // Empty array that will hold LDAP Data if found
        $array = array();
        $results = array();

        if ($ds) {
            $r = ldap_bind($ds);
            $sr = ldap_search($ds, $dn, "(|(" . $this->attribute . "=" . $query . "))");
            $info = ldap_get_entries($ds, $sr);

            //print_r($info);
            for ($i = 0; $i < $info["count"]; $i++) {

                $array[] = $info[$i];

            } //Close For Loop of Objects in Filter
        }

        ldap_close($ds);

        // Iterate over array of results and store cleaned data into $results
        for ($i = 0; $i < $info["count"]; $i++) {
            // Iterate over the elements for an individual result
            foreach ($array[$i] as $key => $val) {

                if (is_int($key) || ctype_digit($key)) {

                    $results[$i]['attribute_types'][] = $val;

                } else if ($key == 'count') {

                    $results[$i]['attribute_count'][$key] = $val;

                } else {

                    $results[$i]['attributes'][$key] = $val;

                }

            }
        }

        return $results;

    }

    /**
     * Public method used to query UIC LDAP using multiple queries as to avoid a QUERY limit
     *
     * @param null $queryArray
     * @return array
     * @throws \Exception
     */
    public function multiSearch($queryArray = null)
    {

        if (empty($queryArray)) {

            throw new \Exception('Query value is empty.');

        }

        if(!is_array($queryArray)){

            throw new \Exception("Query value is not an array.");

        }

        $dn = self::DOMAIN_NAME;
        $ds = ldap_connect(self::LDAP_HOST);

        // Empty array that will hold LDAP Data if found
        $array = array();
        $results = array();

        // Augmentor to go across multiple queries
        $j = 0;

        //'(|(ou=' . $ou . '))';

        // Iterate over each element in $queryArray
        foreach($queryArray as $query) {

            if ($ds) {
                $r = ldap_bind($ds);
                $sr = ldap_search($ds, $dn, "(|(" . $this->attribute . "=" . $query . "))");
                $info = ldap_get_entries($ds, $sr);

                // destroy the array if it's set
                if(isset($array)){
                    unset($array);
                }

                //print_r($info);
                for ($i = 0; $i < $info["count"]; $i++) {

                    $array[] = $info[$i];

                } //Close For Loop of Objects in Filter
            }

            // Iterate over array of results and store cleaned data into $results
            for ($i = 0; $i < $info["count"]; $i++) {
                // Iterate over the elements for an individual result
                foreach ($array[$i] as $key => $val) {

                    if (is_int($key) || ctype_digit($key)) {

                        $results[$j]['attribute_types'][] = $val;

                    } else if ($key == 'count') {

                        $results[$j]['attribute_count'][$key] = $val;

                    } else {

                        $results[$j]['attributes'][$key] = $val;

                    }

                }

                // Augment
                $j++;
            }

        }

        ldap_close($ds);

        return $results;

    }

}