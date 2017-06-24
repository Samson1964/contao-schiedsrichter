<?php

ini_set('memory_limit', '1024M');
set_time_limit(0);

$inputFile = '000.xls';
$fileDate = mktime(23, 14, 0, 5, 24, 2017); // Datum Kohlstädt-Mail Std., Min., Sek., Mon., Tag, Jahr

$srArr = array(); // Nimmt die Exceldaten für die weitere Verarbeitung auf
$colTitle = array(); // Nimmt die Spaltenüberschriften auf

// Exceldatei einlesen
require_once 'excel_reader2.php';
$data = new Spreadsheet_Excel_Reader($inputFile);

$anzahlzeilen = $data->rowcount($sheet_index = 0); 
$anzahlspalten = $data->colcount($sheet_index = 0);
$row = 0;

for($zeile = 1; $zeile <= $anzahlzeilen; $zeile++) 
{
	for($spalte = 1; $spalte <= $anzahlspalten; $spalte++ ) 
	{
		if($zeile == 1)
		{
			// Spaltenüberschriften merken
			$colTitle[$spalte] = $data->val($zeile, $spalte);
		}
		else
		{
			// Datenarray füllen
			$srArr[$row][$colTitle[$spalte]] = $data->val($zeile, $spalte);
		}
	}
	if($zeile > 1) $row++;
}

// SQL-Import erstellen
$fp = fopen("tl_schiedsrichter.sql", 'w');

foreach($srArr as $row)
{
	fputs($fp, 'INSERT INTO tl_schiedsrichter (tstamp, k, klasse, nr, anrede, titel, name, vorname, strasse, ort, plz, telefon, telefon2, fax, faxk1, faxk2, email, mobil, verband, verein, geb_datum, ausbdat, aktiv, geburtsort, passnr, pkz, wahl, rds_d, rds_k, dwz_d, dwz_k, verein_kur, prue_datum, bestanden, sel, funktion, l, los, pn, tagg, nn_vn, ls, lsr, fide_id, ro, country, title, published) VALUES (');
  	fputs($fp, $fileDate . ', ');
	fputs($fp, "'" . addslashes($row['K']) . "', ");
	fputs($fp, "'" . addslashes($row['KLASSE']) . "', ");
	fputs($fp, "'" . addslashes($row['NR']) . "', ");
	fputs($fp, "'" . addslashes($row['ANREDE']) . "', ");
	fputs($fp, "'" . addslashes($row['TITEL']) . "', ");
	fputs($fp, "'" . addslashes($row['NAME']) . "', ");
	fputs($fp, "'" . addslashes($row['VORNAME']) . "', ");
	fputs($fp, "'" . addslashes($row['STRASSE']) . "', ");
    // PLZ und Ort trennen
	$found = strpos($row['ORT'], ' ');
	if($found)
	{
		$ort = substr($row['ORT'], $found + 1);
		$plz = substr($row['ORT'], 0, $found);
	}
	else
	{
		$ort = $row['ORT'];
		$plz = '';
	}
   	fputs($fp, "'" . addslashes($ort). "', ");
	fputs($fp, "'" . addslashes($plz). "', ");
	fputs($fp, "'" . addslashes($row['TELEFON']) . "', ");
	fputs($fp, "'" . addslashes($row['TELEFON2']) . "', ");
	fputs($fp, "'" . addslashes($row['FAX']) . "', ");
	fputs($fp, "'" . addslashes($row['FAXK1']) . "', ");
	fputs($fp, "'" . addslashes($row['FAXK2']) . "', ");
	fputs($fp, "'" . addslashes($row['EMAIL']) . "', ");
	fputs($fp, "'" . addslashes($row['MOBIL']) . "', ");
	fputs($fp, "'" . addslashes($row['VERBAND']) . "', ");
	fputs($fp, "'" . addslashes($row['VEREIN']) . "', ");
	$datum = mktime(0, 0, 0, substr($row['GEB_DATUM'], 0, 2), substr($row['GEB_DATUM'], 3, 2), substr($row['GEB_DATUM'], 6, 4));
	fputs($fp, $datum . ", ");
	$datum = mktime(0, 0, 0, substr($row['AUSBDAT'], 0, 2), substr($row['AUSBDAT'], 3, 2), substr($row['AUSBDAT'], 6, 4));
	fputs($fp, $datum . ", ");
	fputs($fp, "'" . addslashes($row['AKTIV']) . "', ");
	fputs($fp, "'" . addslashes($row['GEBURTSORT']) . "', ");
	fputs($fp, "'" . addslashes($row['PASSNR']) . "', ");
	fputs($fp, "'" . addslashes($row['PKZ']) . "', ");
	fputs($fp, "'" . addslashes($row['WAHL']) . "', ");
	fputs($fp, "'" . addslashes($row['RDS_D']) . "', ");
	fputs($fp, "'" . addslashes($row['RDS_K']) . "', ");
	fputs($fp, "'" . addslashes($row['DWZ_D']) . "', ");
	fputs($fp, "'" . addslashes($row['DWZ_K']) . "', ");
	fputs($fp, "'" . addslashes($row['VEREIN_KUR']) . "', ");
	$datum = mktime(0, 0, 0, substr($row['PRUE_DATUM'], 0, 2), substr($row['PRUE_DATUM'], 3, 2), substr($row['PRUE_DATUM'], 6, 4));
	fputs($fp, $datum . ", ");
	fputs($fp, "'" . addslashes($row['BESTANDEN']) . "', ");
	fputs($fp, "'" . addslashes($row['SEL']) . "', ");
	fputs($fp, "'" . addslashes($row['FUNKTION']) . "', ");
	fputs($fp, "'" . addslashes($row['L']) . "', ");
	$row['LOS'] = $row['LOS'] + 0;
	fputs($fp, $row['LOS'] . ', ');
	fputs($fp, "'" . addslashes($row['PN']) . "', ");
	fputs($fp, "'" . addslashes($row['TAGG']) . "', ");
	fputs($fp, "'" . addslashes($row['NN_VN']) . "', ");
	fputs($fp, "'" . addslashes($row['LS']) . "', ");
	fputs($fp, "'" . addslashes($row['LSR']) . "', ");
	$row['FIDE_ID'] = $row['FIDE_ID'] + 0;
	fputs($fp, $row['FIDE_ID'] . ', ');
	fputs($fp, "'" . addslashes($row['RO']) . "', ");
	fputs($fp, "'" . addslashes($row['COUNTRY']) . "', ");
	fputs($fp, "'" . addslashes($row['TITLE']) . "', ");
	fputs($fp, '1');
	fputs($fp, ");\n");
}
fclose($fp);

echo 'Fertig';
