<?php
/**
 * Created by PhpStorm.
 * User: dpaz
 * Date: 2/19/18
 * Time: 11:23 AM
 */

namespace dpazuic;

abstract class allowedAttributes extends \dpazuic\utilities\BasicEnum {
    const ou = 'ou';
    const uid = 'uid';
    const displayname = 'displayname';
    const givenname = 'givenname';
    const sn = 'sn';
    const mail = 'mail';
    const title = 'title';
    const facsimiletelephonenumber = 'facsimiletelephonenumber';
    const telephonenumber = 'telephonenumber';
    const postaladdress = 'postaladdress';
}