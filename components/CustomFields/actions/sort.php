<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   SOFTLAB24 LIMITED, COMMERCIAL LICENSE  https://www.softlab24.com/license/commercial-license-v1
 * @link      https://www.softlab24.com/
 */

$init = new OssnComponents;
$ini = array(
			'sort' => input('data'),			 
);
if($init->setSettings('CustomFields', $ini)){
		echo 1;		
} else {
		echo 0;
}
exit;