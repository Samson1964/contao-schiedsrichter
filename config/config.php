<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @package   bdf
 * @author    Frank Hoppe
 * @license   GNU/LGPL
 * @copyright Frank Hoppe 2014
 */

/**
 * Backend-Bereich DSB anlegen, wenn noch nicht vorhanden
 */
if(!$GLOBALS['BE_MOD']['dsb']) 
{
	$dsb = array(
		'dsb' => array()
	);
	array_insert($GLOBALS['BE_MOD'], 0, $dsb);
}

$GLOBALS['BE_MOD']['dsb']['schiedsrichter'] = array
(
	'tables'         => array('tl_schiedsrichter'),
	'icon'           => 'system/modules/schiedsrichter/assets/images/icon.png'
);

$GLOBALS['BE_MOD']['dsb']['schiedsrichter']['export'] = array('trainerlizenzExport', 'exportTrainer');
$GLOBALS['BE_MOD']['dsb']['schiedsrichter']['exportXLS'] = array('trainerlizenzExport', 'exportXLSTrainer');
$GLOBALS['BE_MOD']['dsb']['schiedsrichter']['import'] = array('trainerlizenzImport', 'importTrainer'); 

// Konfiguration für ProSearch
$GLOBALS['PS_SEARCHABLE_MODULES']['schiedsrichter'] = array(
	'icon'           => 'system/modules/schiedsrichter/assets/images/icon.png',
	'title'          => array('name'),
	'searchIn'       => array('vorname','name', 'email', 'lizenznummer'),
	'tables'         => array('tl_schiedsrichter'),
	'shortcut'       => 'tlizenzen'
);

