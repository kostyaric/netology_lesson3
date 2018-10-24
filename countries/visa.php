<?php


	if ($argc !== 2) {
		echo "Неправильное количество параметров";
		exit;
	}

	$country = $argv[1];

	$file = fopen('https://data.gov.ru/opendata/7704206201-country/data-20180609T0649-structure-20180609T0649.csv?', 'r');

	if ($file !== FALSE) {
		
		while (($rowarray = fgetcsv($file)) !== FALSE) {
			if ($rowarray[1] == $country) {
				$visa_procedure = $rowarray[4];
			}

		}

		echo $visa_procedure;

		if (isset($visa_procedure)) {
			echo $country . ': ' . $visa_procedure;
		}
		else {
			echo "Указанная страна не найдена в файле";
		}

		fclose($file);
	}

	else {
		echo "Не удалось открыть файл";
	}

?>