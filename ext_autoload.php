<?php
/*
 * Register necessary class names with autoloader
 *
 * $Id: ext_autoload.php 56532 2012-01-21 17:03:15Z francois $
 */
$extensionPath = t3lib_extMgm::extPath('displaycontroller_kintdebug');
return array(
	'tx_displaycontrollerkintdebug_service_debug' => $extensionPath . 'Classes/Service/Debug.php',
);
?>
