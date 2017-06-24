<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Fh-counter
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'trainerlizenzImport' => 'system/modules/schiedsrichter/classes/trainerlizenzImport.php',
	'trainerlizenzExport' => 'system/modules/schiedsrichter/classes/trainerlizenzExport.php',
));
