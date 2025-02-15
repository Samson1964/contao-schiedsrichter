<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');


/**
 * Class dsb_trainerlizenzExport
  */
class trainerlizenzExport extends \Backend
{

	/**
	 * Return a form to choose a CSV file and import it
	 * @param object
	 * @return string
	 */

	public function exportTrainer(DataContainer $dc)
	{
		if ($this->Input->get('key') != 'export')
		{
			return '';
		}

		$arrExport = $this->getRecords($dc); // Lizenzen auslesen

		$exportFile =  'DSB-Trainerlizenzen-Export' . date("Ymd-Hi");
		
		header('Content-Type: application/csv');
		header('Content-Transfer-Encoding: binary');
		header('Content-Disposition: attachment; filename="' . $exportFile .'.csv"');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Expires: 0');

		$output = '';
		foreach ($arrExport as $export) 
		{
			$output .= '"' . join('";"', $export).'"' . "\n";
		}

		echo $output;
		exit;
	}

	public function exportXLSTrainer(DataContainer $dc)
	{
		if ($this->Input->get('key') != 'exportXLS')
		{
			return '';
		}

		$arrExport = $this->getRecords($dc); // Lizenzen auslesen
		
		// Excel-Export
		if (file_exists(TL_ROOT . "/system/modules/xls_export/vendor/xls_export.php")) 
		{
			include(TL_ROOT . "/system/modules/xls_export/vendor/xls_export.php");
			$xls = new \xlsexport();
			$sheet = 'Trainerlizenzen';
			$xls->addworksheet($sheet);

			// Spaltenbreite setzen
			for ($c = 1; $c <= 22; $c++)
			{
				switch($c)
				{
					case 17: // Veröffentlicht
						$breite = 1000;
						break;
					case 8: // PLZ
					case 18: // Titel
					case 21: // ID
						$breite = 1500;
						break;
					case 4: // Lizenz
						$breite = 2000;
						break;
					case 5: // Gültig bis
					case 6: // Geburtsdatum
					case 10: // Erwerb
					case 11: // Verlängerung 1
					case 12: // Verlängerung 2
					case 13: // Verlängerung 3
					case 14: // Verlängerung 4
					case 15: // Letzte Änderung
						$breite = 3500;
						break;
					case 1: // Vorname
					case 2: // Name
					case 3: // Lizenznummer
					case 16: // Bemerkung
					case 19: // Emailadresse
					case 20: // Verband
						$breite = 4000;
						break;
					case 9: // Ort
					case 22: // Zeitstempel
						$breite = 4500;
						break;
					case 7: // Straße
						$breite = 5000;
						break;
					default:
						$breite = 4000;
				}
				$xls->setcolwidth ($sheet,$c-1,$breite);
			}
			
			// Daten schreiben
			$row = 0;
			foreach($arrExport as $data)
			{
				$col = 0;
				foreach($data as $key => $value) 
				{
					if($row == 0)
					{
						$xls->setcell(array("sheetname" => $sheet,"row" => $row, "col" => $col, 'fontweight' => XLSFONT_BOLD, 'hallign' => XLSXF_HALLIGN_CENTER, "data" => $value));
					}
					else
					{
						$xls->setcell(array("sheetname" => $sheet,"row" => $row, "col" => $col, 'hallign' => XLSXF_HALLIGN_LEFT, "data" => $value));
					}
					$col++;
				}
				$row++; // Zeilenzähler modifizieren
			}
			$xls->sendFile($sheet . '_' . date("Ymd-Hi") . ".xls");
		} 
		else 
		{
			echo "<html><head><title>Need extension xls_export</title></head><body>"
			    ."Please install the extension 'xls_export' 3.x.<br /><br />"
			    ."Bitte die Erweiterung 'xls_export' 3.x installieren.<br /><br />"
			    ."Installer l'extension 'xls_export' 3.x s'il vous plaît."
			    ."</body></html>";
		}
	}

	public function getRecords(DataContainer $dc)
	{
		// Liest die Datensätze der Trainerlizenzen in ein Array

		// Suchbegriff in aktueller Ansicht laden
		$search = $dc->Session->get('search');
		$search = $search[$dc->table]; // Das Array enthält field und value
		//if($search['field']) $sql = " WHERE ".$search['field']." LIKE '%%".$search['value']."%%'"; // findet auch Umlaute, Suche nach "ba" findet auch "bä"
		if($search['field'] && $search['value']) $sql = " WHERE LOWER(CAST(".$search['field']." AS CHAR)) REGEXP LOWER('".$search['value']."')"; // Contao-Standard, ohne Umlaute, Suche nach "ba" findet nicht "bä"
		else $sql = '';

		// Filter in aktueller Ansicht laden
		$filter = $dc->Session->get('filter');
		$filter = $filter[$dc->table]; // Das Array enthält limit (Wert meistens = 0,30) und alle Feldnamen mit den Werten
		foreach($filter as $key => $value)
		{
			if($key != 'limit')
			{
				($sql) ? $sql .= ' AND' : $sql = ' WHERE';
				$sql .= " ".$key." = '".$value."'";
			}
		}
		$sql .= ' ORDER BY name,vorname ASC';

		//echo "|$sql|";
		//exit;
		// Datensätze laden
		$records = \Database::getInstance()->prepare('SELECT * FROM tl_trainerlizenzen'.$sql)
										   ->execute();

		// Datensätze umwandeln
		$arrExport = array();
		// Kopfzeile anlegen
		$arrExport[0]['vorname'] = 'Vorname';
		$arrExport[0]['name'] = 'Name';
		$arrExport[0]['lizenznummer'] = 'Lizenznummer';
		$arrExport[0]['lizenz'] = 'Lizenz';
		$arrExport[0]['gueltigkeit'] = utf8_decode('Gültig bis');
		$arrExport[0]['geburtstag'] = 'Geburtsdatum';
		$arrExport[0]['strasse'] = 'Strasse';
		$arrExport[0]['plz'] = 'PLZ';
		$arrExport[0]['ort'] = 'Ort';
		$arrExport[0]['erwerb'] = 'Lizenzerwerb';
		$arrExport[0]['verlaengerung1'] = utf8_decode('Verlängerung (1)');
		$arrExport[0]['verlaengerung2'] = utf8_decode('Verlängerung (2)');
		$arrExport[0]['verlaengerung3'] = utf8_decode('Verlängerung (3)');
		$arrExport[0]['verlaengerung4'] = utf8_decode('Verlängerung (4)');
		$arrExport[0]['letzteAenderung'] = utf8_decode('Letzte Änderung');
		$arrExport[0]['bemerkung'] = 'Bemerkung';
		$arrExport[0]['published'] = utf8_decode('Veröffentlicht');
		$arrExport[0]['titel'] = 'Titel';
		$arrExport[0]['email'] = 'Emailadresse';
		$arrExport[0]['verband'] = 'Verband';
		$arrExport[0]['id'] = 'ID';
		$arrExport[0]['tstamp'] = 'Zeitstempel';
		$x = 1;
		if($records->numRows)
		{
			while($records->next()) 
			{
				$arrExport[$x]['vorname'] = utf8_decode($records->vorname);
				$arrExport[$x]['name'] = utf8_decode($records->name);
				$arrExport[$x]['lizenznummer'] = $records->lizenznummer;
				$arrExport[$x]['lizenz'] = $records->lizenz;
				$arrExport[$x]['gueltigkeit'] = $this->getDate($records->gueltigkeit);
				$arrExport[$x]['geburtstag'] = $this->getDate($records->geburtstag);
				$arrExport[$x]['strasse'] = utf8_decode($records->strasse);
				$arrExport[$x]['plz'] = $records->plz;
				$arrExport[$x]['ort'] = utf8_decode($records->ort);
				$arrExport[$x]['erwerb'] = $this->getDate($records->erwerb);
				$arrExport[$x]['verlaengerung1'] = $this->getDate($records->verlaengerung1);
				$arrExport[$x]['verlaengerung2'] = $this->getDate($records->verlaengerung2);
				$arrExport[$x]['verlaengerung3'] = $this->getDate($records->verlaengerung3);
				$arrExport[$x]['verlaengerung4'] = $this->getDate($records->verlaengerung4);
				$arrExport[$x]['letzteAenderung'] = $this->getDate($records->letzteAenderung);
				$arrExport[$x]['bemerkung'] = utf8_decode($records->bemerkung);
				$arrExport[$x]['published'] = $records->published;
				$arrExport[$x]['titel'] = $records->titel;
				$arrExport[$x]['email'] = $records->email;
				$arrExport[$x]['verband'] = utf8_decode($records->verband);
				$arrExport[$x]['id'] = $records->id;
				$arrExport[$x]['tstamp'] = date("d.m.Y H:i:s",$records->tstamp);
				$x++;
			}
		}
		return $arrExport;
	}

	/**
	 * Datumswert aus Datenbank umwandeln
	 * @param mixed
	 * @return mixed
	 */
	public function getDate($varValue)
	{
		$laenge = strlen($varValue);
		$temp = '';
		
		if(is_numeric($varValue))
		{
			switch($laenge)
			{
				case 10: // TT.MM.JJJJ (altes Format)
					$temp = $varValue;
					break;
				case 8: // JJJJMMTT
					$temp = substr($varValue,6,2).'.'.substr($varValue,4,2).'.'.substr($varValue,0,4);
					break;
				case 6: // JJJJMM
					$temp = substr($varValue,4,2).'.'.substr($varValue,0,4);
					break;
				case 4: // JJJJ
					$temp = $varValue;
					break;
				case 1: // Ziffer 0?
					$temp = '';
					break;
				default: // anderer Wert
					$temp = $varValue;
			}
		}
		else
		{
			return $varValue;
		}

		return $temp;
	}

}
?>