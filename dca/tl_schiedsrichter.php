<?php

/**
* Contao Open Source CMS
*
* Copyright (c) 2005-2014 Leo Feyer
*
 */


/**
 * Table tl_schiedsrichter 
 */
$GLOBALS['TL_DCA']['tl_schiedsrichter'] = array
(
	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'switchToEdit'                => true,
		'sql' => array
		(
			'keys' => array
			(
				'id'             => 'primary',
				'klasse'         => 'index',
				'nr'             => 'index',
				'name'           => 'index'
			)
		)
	),
	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 2,
			'fields'                  => array('name ASC', 'vorname ASC'),
			'flag'                    => 11,
			'panelLayout'             => 'filter;search,sort,limit',
		),
		'label' => array
		(
			'fields'                  => array('name', 'vorname', 'klasse', 'nr', 'ausbdat', 'prue_datum'),
			'showColumns'             => true,
			'label_callback'          => array('tl_schiedsrichter', 'convertDate') 
		),
		'global_operations' => array
		(
			//'import' => array
			//(
			//	'label'               => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['import'],
			//	'href'                => 'key=import',
			//	'icon'                => 'system/modules/schiedsrichter/assets/images/importCSV.gif',
			//	'attributes'          => 'onclick="Backend.getScrollOffset();"'
			//),
			//'export' => array
			//(
			//	'label'               => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['export'],
			//	'href'                => 'key=export',
			//	'icon'                => 'system/modules/schiedsrichter/assets/images/exportCSV.gif',
			//	'attributes'          => 'onclick="Backend.getScrollOffset();"'
			//),
			//'exportXLS' => array
			//(
			//	'label'               => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['exportXLS'],
			//	'href'                => 'key=exportXLS',
			//	'icon'                => 'system/modules/schiedsrichter/assets/images/exportEXCEL.gif',
			//	'attributes'          => 'onclick="Backend.getScrollOffset();"'
			//),
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif',
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_schiedsrichter', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),
	// Palettes
	'palettes' => array
	(
		'default'                     => '{person_legend},anrede,titel,name,vorname,geb_datum,geburtsort;{adresse_legend:hide},strasse,plz,ort;{kontakt_legend:hide},telefon,telefon2,fax,faxk1,faxk2,email,mobil;{lizenz_legend:hide},k,klasse,nr,ausbdat,prue_datum,bestanden;{verein_legend:hide},verband,verein,aktiv,passnr,pkz;{diverses_legend:hide},wahl,rds_d,rds_k,dwz_d,dwz_k,verein_kur,sel,funktion,l,los,pn,tagg,nn_vn,ls,lsr;{fide_legend:hide},fide_id,ro,country,title;{hinweise_legend:hide},bemerkung;{published_legend},published'
	),

	// Base fields in table tl_schiedsrichter
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['tstamp'],
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		// K
		'k' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['k'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(19) NOT NULL default ''",
			'eval'                    => array
			(
				'mandatory'           => false,
				'tl_class'            => 'w50'
			)
		),
		// Anrede
		'anrede' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['anrede'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(26) NOT NULL default ''",
			'eval'                    => array
			(
				'mandatory'           => false,
				'tl_class'            => 'w50'
			)
		),
		// Vorname
		'vorname' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['vorname'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(30) NOT NULL default ''",
			'eval'                    => array
			(
				'mandatory'           => true,
				'tl_class'            => 'w50'
			)
		),
		// Nachname
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['name'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(30) NOT NULL default ''",
			'eval'                    => array
			(
				'mandatory'           => true,
				'tl_class'            => 'w50'
			)
		),
		// Titel
		'titel' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['titel'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(22) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		// Geburtstag
		'geb_datum' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['geb_datum'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'filter'                  => false,
			'eval'                    => array
			(
				'tl_class'            => 'w50 wizard',
				'rgxp'                => 'date',
				'datepicker'          => true
			),
			'sql'                     => "int(10) unsigned NOT NULL default '0'" 
		),
		// Geburtsort
		'geburtsort' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['geburtsort'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(30) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		// Straße
		'strasse' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['strasse'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(30) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		// PLZ
		'plz' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['plz'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(10) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50 clr'
			)
		),
		// Ort
		'ort' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['ort'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(30) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		// Email
		'email' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['email'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(50) NOT NULL default ''",
			'eval'                    => array
			(
				'rgxp'                => 'email',
				'tl_class'            => 'w50'
			)
		),
		// Telefon 1
		'telefon' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['telefon'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(30) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		// Telefon 2
		'telefon2' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['telefon2'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(30) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		// Fax
		'fax' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['fax'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(30) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		// Fax
		'faxk1' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['faxk1'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(30) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		// Fax
		'faxk2' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['faxk2'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(30) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		// Fax
		'mobil' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['mobil'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(30) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		// Verein
		'verein' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['verein'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(30) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		// Verband
		'verband' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['verband'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 12,
			'filter'                  => true,
			'sql'                     => "varchar(30) NOT NULL default ''",
			'eval'                    => array
			(
				'mandatory'           => false,
				'tl_class'            => 'w50'
			)
		),
		// PKZ
		'pkz' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['pkz'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(9) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50',
			)
		),
		// Aktiv
		'aktiv' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['aktiv'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(1) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		// Klasse
		'klasse' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['klasse'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(3) NOT NULL default ''",
			'eval'                    => array
			(
				'mandatory'           => false,
				'tl_class'            => 'w50'
			)
		),
		// NR
		'nr' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['nr'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(8) NOT NULL default ''",
			'eval'                    => array
			(
				'mandatory'           => false,
				'tl_class'            => 'w50'
			)
		),
		// Ausbildungsdatum
		'ausbdat' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['ausbdat'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'filter'                  => true,
			'eval'                    => array
			(
				'tl_class'            => 'w50 wizard',
				'rgxp'                => 'date',
				'datepicker'          => true
			),
			'sql'                     => "int(10) unsigned NOT NULL default '0'" 
		),
		// Prüfungsdatum 
		'prue_datum' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['prue_datum'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'filter'                  => false,
			'eval'                    => array
			(
				'tl_class'            => 'w50 wizard',
				'rgxp'                => 'date',
				'datepicker'          => true
			),
			'sql'                     => "int(10) unsigned NOT NULL default '0'" 
		),
		// Passnummer
		'passnr' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['passnr'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(9) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		// Wahl
		'wahl' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['wahl'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(1) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		// rds_d
		'rds_d' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['rds_d'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(10) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		'rds_k' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['rds_k'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(1) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		'dwz_d' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['dwz_d'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(10) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		'dwz_k' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['dwz_k'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(10) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		'verein_kur' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['verein_kur'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(4) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		'bestanden' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['bestanden'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(2) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		'sel' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['sel'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(2) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		'funktion' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['funktion'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(1) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		'l' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['l'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(11) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		'los' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['los'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "int(11) unsigned NOT NULL default '0'",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		'nn_vn' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['nn_vn'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(40) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		'pn' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['pn'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "varchar(5) NOT NULL default ''",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		'tagg' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['tagg'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'default'                 => true,
			'filter'                  => true,
			'eval'                    => array('tl_class' => 'w50','isBoolean' => true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'ls' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['ls'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'default'                 => true,
			'filter'                  => true,
			'eval'                    => array('tl_class' => 'w50','isBoolean' => true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'lsr' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['lsr'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'default'                 => true,
			'filter'                  => true,
			'eval'                    => array('tl_class' => 'w50','isBoolean' => true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'ro' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['ro'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'default'                 => true,
			'filter'                  => true,
			'eval'                    => array('tl_class' => 'w50','isBoolean' => true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'fide_id' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['fide_id'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'filter'                  => false,
			'sql'                     => "int(11) unsigned NOT NULL default '0'",
			'eval'                    => array
			(
				'tl_class'            => 'w50'
			)
		),
		'country' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['country'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'default'                 => true,
			'filter'                  => true,
			'eval'                    => array('tl_class' => 'w50','isBoolean' => true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['title'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'default'                 => true,
			'filter'                  => true,
			'eval'                    => array('tl_class' => 'w50','isBoolean' => true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'bemerkung' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['bemerkung'],
			'inputType'               => 'textarea',
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => false,
			'filter'                  => false,
			'eval'                    => array
			(
				'tl_class'            => 'long',
				'rte'                 => 'tinyMCE', 
				'cols'                => 80,
				'rows'                => 5, 
				'style'               => 'height: 80px'
			),
			'sql'                     => "text NULL"
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_schiedsrichter']['published'],
			'inputType'               => 'checkbox',
			'exclude'                 => true,
			'default'                 => true,
			'filter'                  => true,
			'eval'                    => array('tl_class' => 'w50','isBoolean' => true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
	),
);

class tl_schiedsrichter extends \Backend
{

	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		$this->import('BackendUser', 'User');

		if (strlen($this->Input->get('tid')))
		{
			$this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 0));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_schiedsrichter::published', 'alexf'))
		{
			return '';
		}

		$href .= '&amp;id='.$this->Input->get('id').'&amp;tid='.$row['id'].'&amp;state='.$row[''];

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}

	public function toggleVisibility($intId, $blnPublished)
	{
		// Check permissions to publish
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_schiedsrichter::published', 'alexf'))
		{
			$this->log('Kein Zugriffsrecht für Aktivierung Datensatz ID "'.$intId.'"', 'tl_schiedsrichter toggleVisibility', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}
		
		$this->createInitialVersion('tl_schiedsrichter', $intId);
		
		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_schiedsrichter']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_schiedsrichter']['fields']['published']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnPublished = $this->$callback[0]->$callback[1]($blnPublished, $this);
			}
		}
		
		// Update the database
		$this->Database->prepare("UPDATE tl_schiedsrichter SET tstamp=". time() .", published='" . ($blnPublished ? '' : '1') . "' WHERE id=?")
					   ->execute($intId);
		$this->createNewVersion('tl_schiedsrichter', $intId);
	}

	/**
	 * Add an image to each record
	 * @param array         $row (Assoziatives Array mit allen Werten des aktuellen Datensatzes)
	 * @param string        $label (Wert des erstes sichtbaren Wertes des aktuellen Datensatzes)
	 * @param DataContainer $dc
	 * @param array         $args (Numerisches Array mit den sichtbaren Werten des aktuellen Datensatzes)
	 *
	 * @return array
	 */
	public function convertDate($row, $label, DataContainer $dc, $args)
	{

		for($x=0;$x<count($args);$x++)
		{
			$args[$x] = \Samson\Helper::getDate($args[$x]);
		}
		return $args; 
	} 
	
}